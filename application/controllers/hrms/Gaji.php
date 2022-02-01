<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_jabatan_model');
        $this->load->model('hrms/Hrms_model');
        $this->load->model('hrms/Tbl_pegawai_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        $this->id_klinik = $this->session->userdata('id_klinik');
    }

    public function index()
    {
        $data['title']='Gaji';
        $this->template->load('template','hrms/absensi/absensi_list', $data);
    }
    public function potongan()
    {
        $this->template->load('template','hrms/absensi/absensi_list');
    } 
    public function slip($id){
        $bulan=0;
        if ($this->input->post('bulan')) {
            $bulan=$this->input->post('tahun').'-'.$this->input->post('bulan');
        }elseif ($this->session->userdata('bulan')) {
            $bulan=$this->session->userdata('bulan');
        }else{
            $bulan=date('Y-m');
        }
        $cek_complete_gaji=$this->db->where('bulan', $bulan)->where('id_pegawai', $id)->get('tbl_history_gaji')->num_rows();
        
        $daftar_hari = array(
         'Sunday' => 'Minggu',
         'Monday' => 'Senin',
         'Tuesday' => 'Selasa',
         'Wednesday' => 'Rabu',
         'Thursday' => 'Kamis',
         'Friday' => 'Jumat',
         'Saturday' => 'Sabtu'
        );
        $newDate=explode('-', $bulan);
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $newDate[1], $newDate[0]);
        $jumlah_kehadiran=$jumlah_telat=$jumlah_denda=$jumlah_bolos=0;
        $dispensasi_denda=20000;
        $gaji=$this->Hrms_model->get_gaji_by_pegawai($id);
        if ($gaji == null ) {
            $this->session->set_flashdata('message_type', 'danger');
            $this->session->set_flashdata('message', 'Detail Gaji Pegawai Belum di Setting');
            redirect('hrms/set_gaji');
        }
        $detail=array();
        for ($i=1; $i <= $jumlah_hari ; $i++) { 
            $hari=(strlen($i) < 2 ? '0'.$i : $i);
            $date=$bulan.'-'.$hari;
            $absensi=$this->Hrms_model->get_absensi_pegawai_by_day($id, $date);
            $denda=$telat=0;
            $tgl_cuti=$alasan_denda="";
            if ($absensi != null) {
                $jam_masuk = strtotime('10:00:00');
                $jam_masuk_real   = strtotime($absensi->jam_datang);
                $diff  = $jam_masuk_real - $jam_masuk;
                $hours = floor($diff / (60 * 60));
                $minutes = $diff - $hours * (60 * 60);
                // $seconds = $diff % (60);
                // echo $value->jam_datang." ".floor($seconds/1);
                // echo 'Selisih Waktu: ' . $hours .  ' Jam, ' . floor( $minutes / 60 ) . ' Menit <br>';
                $selisih_datang=($hours * 60) + floor( $minutes / 60 );
                if ($selisih_datang > 0) {
                    $jumlah_telat++;
                    if ($jumlah_telat > 2) {
                        // $denda=floor($selisih_datang/10)*10000;
                        $denda=(floor($selisih_datang/10)+1)*10000;
                    }else{
                        $dendaAwal=(floor($selisih_datang/10)+1)*10000;
                        if($dendaAwal > 20000){
                            $denda=$dendaAwal-$dispensasi_denda;   
                        }else{
                            $denda=0;
                            $dispensasi_denda-=10000;
                        }
                    }
                    
                    // $denda=(floor($selisih_datang/10)+1)*10000;
                    $telat=$selisih_datang;
                    $alasan_denda="telat ".$telat." menit";
                }
                $jumlah_kehadiran++;
            }else{
                $nama_jabatan=strtolower($gaji->nama_jabatan);
                $cek_cuti=$this->Hrms_model->get_cuti_by_date($id, $date);
                $cek_ket=$this->Hrms_model->get_ket_absensi($id, $date);
                $cuti_bersama=$this->Hrms_model->cekCutiBersama($date);
                $keterangan=($cek_ket == null ? 'bolos' : ($cek_ket->ket == 'sakit' ? 'sakit' : 'bolos'));
                if ($cuti_bersama != null) {
                    $denda=0;
                    $alasan_denda=$cuti_bersama->nama;
                }else{
                    if ($cek_cuti == null) {
                        $cek_tanggal_merah=$this->Hrms_model->getHoliday($date);
                        if ($cek_tanggal_merah == null) {
                            $namahari = date('l', strtotime($date));
                            if ($namahari == 'Sunday' || $namahari == 'Saturday') {
                                $denda=$nama_jabatan == 'owner' || $nama_jabatan == 'kasir' || $nama_jabatan == 'cashier' ? ($keterangan == 'sakit' ? 0 : ($gaji->denda != 0 ? $gaji->denda : $gaji->denda_weekend)) : ($keterangan == 'sakit' ? 150000 : ($gaji->denda_weekend != 0 ? $gaji->denda_weekend : 200000));
                                $alasan_denda=($keterangan == 'sakit' ? 'Ijin Sakit' : 'Bolos')." hari ".$daftar_hari[$namahari];
                                $jumlah_bolos+=($keterangan == 'bolos' ? 1 : 0);
                            }else{
                                $denda=$nama_jabatan == 'owner' || $nama_jabatan == 'kasir' || $nama_jabatan == 'cashier' ? ($keterangan == 'sakit' ? 0 : ($gaji->denda != 0 ? $gaji->denda : $gaji->denda_weekday)) : ($keterangan == 'sakit' ? 75000 : ($gaji->denda_weekend != 0 ? $gaji->denda_weekday : 200000));
                                // $denda=$nama_jabatan == 'owner' ? $gaji->denda : ($keterangan == 'sakit' ? 75000 : 200000);
                                $alasan_denda=($keterangan == 'sakit' ? 'Ijin Sakit' : 'Bolos')." hari ".$daftar_hari[$namahari];
                                $jumlah_bolos+=($keterangan == 'bolos' ? 1 : 0);
                            }
                        }else{
                            $denda=$nama_jabatan == 'owner' || $nama_jabatan == 'kasir' || $nama_jabatan == 'cashier' ? ($keterangan == 'sakit' ? 0 : ($gaji->denda != 0 ? $gaji->denda : $gaji->denda_weekend)) : ($keterangan == 'sakit' ? 150000 : ($gaji->denda_weekend != 0 ? $gaji->denda_weekend : 200000));
                            $alasan_denda=($keterangan == 'sakit' ? 'Ijin Sakit ' : 'Bolos ').$cek_tanggal_merah->ket;
                            $jumlah_bolos+=($keterangan == 'bolos' ? 1 : 0);
                        }
                    }else{
                        $tgl_cuti=$date;
                        $namahari = date('l', strtotime($date));
                        $alasan_denda="Ijin Cuti";
                    }
                }
            }
            $jumlah_denda+=$denda;
            $detail[]=array('tanggal_cuti' => $tgl_cuti, 'alasan_denda' => $alasan_denda, 'menit_telat' => $telat, 'denda' => $denda,'tanggal' => $date);
        }

        $sum_komisi=$total_potong=0;
        if ($gaji->tipe_gaji == 4) {
            $id_pegawai=$this->db->where('id_pegawai', $id)->get('users')->row();
            $total_trx=$this->Hrms_model->cekKomisiPerTrx($id_pegawai->id, $bulan);
            foreach ($total_trx->result() as $key => $value) {
                $total_potong+=$value->quantity;
            }
            $sum_komisi=$total_potong * $gaji->kom_trx;
            $cek_komisi=$total_trx->result();
        }else{
            $cek_komisi=$this->Hrms_model->cekKomisiPerPotongPerProduct($id, $bulan);
            foreach ($cek_komisi as $key => $value) {
                $total_potong+=$value->quantity;
                if ($gaji->tipe_gaji == 2) {
                    $sum_komisi+=($value->commission * $value->quantity);
                }else if ($gaji->tipe_gaji == 3) {
                    if ($value->is_paket == 1) {
                        $sum_komisi+=($value->commission * $value->quantity);
                    }else{
                        if(strpos($value->name, 'Paket') !== false){
                            $sum_komisi+=($value->commission * $value->quantity);
                        }else if(strpos($value->name, 'Potong') !== false){
                            $sum_komisi+=($gaji->kom_min * $value->quantity);
                        }else{
                            $sum_komisi+=($value->commission * $value->quantity);
                        }
                    }
                }
            }
        }
        $durasi_lembur=$durasi_telat=0;
        $total_tepat_waktu=0;
        $potongan=$this->Hrms_model->get_potongan($id, $bulan);
        $data=array(
            'absensi'       => $this->Hrms_model->get_absensi_pegawai_by_month($id, $bulan),
            'gaji'          => $gaji,
            'bulan'         => $bulan,
            'uang_lembur'   => $this->Hrms_model->getUangLembur($id, $bulan)->uang_lembur,
            'detail_jasa'   => $cek_komisi,
            'komisiperpotong'=> $sum_komisi,
            'totalpotong'   => $total_potong,
            'komisi_langsung' => ($potongan != null ? $potongan->komisi_langsung : 0),
            'detail'        => $detail,
            'jumlah_denda'  => $jumlah_denda,
            'jumlah_kehadiran'=> $jumlah_kehadiran,
            'tepat_waktu'   => $total_tepat_waktu,
            'durasi_lembur' => $durasi_lembur,
            'durasi_telat'  => $durasi_telat,
            'cek_complete_gaji' => $cek_complete_gaji,
            'jumlah_bolos' => $jumlah_bolos,
            'title'         =>'Slip Gaji',
        );
        // header('Content-type: application/json');
        // echo json_encode($data);
        // exit();
        $this->template->load('template','hrms/gaji/detail_slip_gaji_pegawai', $data);
    }
    public function inputPotongan(){
       $id_pegawai=$this->input->post('id_pegawai');
       $bulan=$this->input->post('bulan');
       $komisi=$this->input->post('komisi');
       $row=$this->db->where('id_pegawai', $id_pegawai)->where('bulan', $bulan)->get('tbl_other_gaji')->row();
       if (count($row) == 0) {
           $data=array(
                'id_pegawai'        => $this->input->post('id_pegawai'),
                'komisi_langsung'   => $this->currency($komisi),
                'bulan'             => $this->input->post('bulan'),
           );
            $this->Hrms_model->insert_setting('tbl_other_gaji', $data);
       }else{
            $potongan = ($this->input->post('potongan') == '' ? $row->potongan_bpjs : $this->input->post('potongan'));
            $cicilan=($this->input->post('cicilan') == '' ? $row->cicilan : $this->input->post('cicilan'));
            $kasbon=($this->input->post('kasbon') == '' ? $row->kasbon : $this->input->post('kasbon'));
            $data=array(
                'komisi_langsung'   => $this->currency($komisi),
           );
            $where=array('id_potongan' => $row->id_potongan);
            $update=$this->Hrms_model->update($where, $data, 'tbl_other_gaji');
       }
       $data = array(
            'bulan' => $bulan
        );
        $this->session->set_userdata($data);
       redirect('hrms/gaji/slip/'.$this->input->post('id_pegawai'));
    }
    public function cetak_slip(){
        $id=$this->input->post('id_pegawai');
        $bulan=0;
        if ($this->input->post('bulan')) {
            $bulan=$this->input->post('tahun').'-'.$this->input->post('bulan');
        }elseif ($this->session->userdata('bulan')) {
            $bulan=$this->session->userdata('bulan');
        }else{
            $bulan=date('Y-m');
        }
        
        $daftar_hari = array(
         'Sunday' => 'Minggu',
         'Monday' => 'Senin',
         'Tuesday' => 'Selasa',
         'Wednesday' => 'Rabu',
         'Thursday' => 'Kamis',
         'Friday' => 'Jumat',
         'Saturday' => 'Sabtu'
        );
        $newDate=explode('-', $bulan);
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $newDate[1], $newDate[0]);
        $jumlah_kehadiran=$jumlah_telat=$jumlah_denda=$jumlah_bolos=0;
        $dispensasi_denda=20000;
        $gaji=$this->Hrms_model->get_gaji_by_pegawai($id);
        if ($gaji == null ) {
            $this->session->set_flashdata('message_type', 'danger');
            $this->session->set_flashdata('message', 'Detail Gaji Pegawai Belum di Setting');
            redirect('hrms/set_gaji');
        }
        $detail=array();
        for ($i=1; $i <= $jumlah_hari ; $i++) { 
            $hari=(strlen($i) < 2 ? '0'.$i : $i);
            $date=$bulan.'-'.$hari;
            $absensi=$this->Hrms_model->get_absensi_pegawai_by_day($id, $date);
            $denda=$telat=0;
            $tgl_cuti=$alasan_denda="";
            if ($absensi != null) {
                $jam_masuk = strtotime('10:00:00');
                $jam_masuk_real   = strtotime($absensi->jam_datang);
                $diff  = $jam_masuk_real - $jam_masuk;
                $hours = floor($diff / (60 * 60));
                $minutes = $diff - $hours * (60 * 60);
                // $seconds = $diff % (60);
                // echo $value->jam_datang." ".floor($seconds/1);
                // echo 'Selisih Waktu: ' . $hours .  ' Jam, ' . floor( $minutes / 60 ) . ' Menit <br>';
                $selisih_datang=($hours * 60) + floor( $minutes / 60 );
                if ($selisih_datang > 0) {
                    $jumlah_telat++;
                    if ($jumlah_telat > 2) {
                        // $denda=floor($selisih_datang/10)*10000;
                        $denda=(floor($selisih_datang/10)+1)*10000;
                    }else{
                        $dendaAwal=(floor($selisih_datang/10)+1)*10000;
                        if($dendaAwal > 20000){
                            $denda=$dendaAwal-$dispensasi_denda;   
                        }else{
                            $denda=0;
                            $dispensasi_denda-=10000;
                        }
                    }
                    // $denda=(floor($selisih_datang/10)+1)*10000;
                    $telat=$selisih_datang;
                    $alasan_denda="telat ".$telat." menit";
                }
                $jumlah_kehadiran++;
            }else{
                $nama_jabatan=strtolower($gaji->nama_jabatan);
                $cek_cuti=$this->Hrms_model->get_cuti_by_date($id, $date);
                $cek_ket=$this->Hrms_model->get_ket_absensi($id, $date);
                $cuti_bersama=$this->Hrms_model->cekCutiBersama($date);
                $keterangan=($cek_ket == null ? 'bolos' : ($cek_ket->ket == 'sakit' ? 'sakit' : 'bolos'));
                if ($cuti_bersama != null) {
                    $denda=0;
                    $alasan_denda=$cuti_bersama->nama;
                }else{
                    if ($cek_cuti == null) {
                        $cek_tanggal_merah=$this->Hrms_model->getHoliday($date);
                        if ($cek_tanggal_merah == null) {
                            $namahari = date('l', strtotime($date));
                            if ($namahari == 'Sunday' || $namahari == 'Saturday') {
                                $denda=$nama_jabatan == 'owner' || $nama_jabatan == 'kasir' || $nama_jabatan == 'cashier' ? ($keterangan == 'sakit' ? 0 : ($gaji->denda != 0 ? $gaji->denda : $gaji->denda_weekend)) : ($keterangan == 'sakit' ? 150000 : ($gaji->denda_weekend != 0 ? $gaji->denda_weekend : 200000));
                                $alasan_denda=($keterangan == 'sakit' ? 'Ijin Sakit' : 'Bolos')." hari ".$daftar_hari[$namahari];
                                $jumlah_bolos+=($keterangan == 'bolos' ? 1 : 0);
                            }else{
                                $denda=$nama_jabatan == 'owner' || $nama_jabatan == 'kasir' || $nama_jabatan == 'cashier' ? ($keterangan == 'sakit' ? 0 : ($gaji->denda != 0 ? $gaji->denda : $gaji->denda_weekday)) : ($keterangan == 'sakit' ? 75000 : ($gaji->denda_weekend != 0 ? $gaji->denda_weekday : 200000));
                                // $denda=$nama_jabatan == 'owner' ? $gaji->denda : ($keterangan == 'sakit' ? 75000 : 200000);
                                $alasan_denda=($keterangan == 'sakit' ? 'Ijin Sakit' : 'Bolos')." hari ".$daftar_hari[$namahari];
                                $jumlah_bolos+=($keterangan == 'bolos' ? 1 : 0);
                            }
                        }else{
                            $denda=$nama_jabatan == 'owner' || $nama_jabatan == 'kasir' || $nama_jabatan == 'cashier' ? ($keterangan == 'sakit' ? 0 : ($gaji->denda != 0 ? $gaji->denda : $gaji->denda_weekend)) : ($keterangan == 'sakit' ? 150000 : ($gaji->denda_weekend != 0 ? $gaji->denda_weekend : 200000));
                            $alasan_denda=($keterangan == 'sakit' ? 'Ijin Sakit ' : 'Bolos ').$cek_tanggal_merah->ket;
                            $jumlah_bolos+=($keterangan == 'bolos' ? 1 : 0);
                        }
                    }else{
                        $tgl_cuti=$date;
                        $namahari = date('l', strtotime($date));
                        $alasan_denda="Ijin Cuti";
                    }
                }
            }
            $jumlah_denda+=$denda;
            $detail[]=array('tanggal_cuti' => $tgl_cuti, 'alasan_denda' => $alasan_denda, 'menit_telat' => $telat, 'denda' => $denda,'tanggal' => $date);
        }
        
        $sum_komisi=$total_potong=0;
        if ($gaji->tipe_gaji == 4) {
            $id_pegawai=$this->db->where('id_pegawai', $id)->get('users')->row();
            $total_trx=$this->Hrms_model->cekKomisiPerTrx($id_pegawai->id, $bulan);
            foreach ($total_trx->result() as $key => $value) {
                $total_potong+=$value->quantity;
            }
            $sum_komisi=$total_potong * $gaji->kom_trx;
            $cek_komisi=$total_trx->result();
        }else{
            $cek_komisi=$this->Hrms_model->cekKomisiPerPotongPerProduct($id, $bulan);
            foreach ($cek_komisi as $key => $value) {
                $total_potong+=$value->quantity;
                if ($gaji->tipe_gaji == 2) {
                    $sum_komisi+=($value->commission * $value->quantity);
                }else if ($gaji->tipe_gaji == 3) {
                    if ($value->is_paket == 1) {
                        $sum_komisi+=($value->commission * $value->quantity);
                    }else{
                        if(strpos($value->name, 'Paket') !== false){
                            $sum_komisi+=($value->commission * $value->quantity);
                        }else if(strpos($value->name, 'Potong') !== false){
                            $sum_komisi+=($gaji->kom_min * $value->quantity);
                        }else{
                            $sum_komisi+=($value->commission * $value->quantity);
                        }
                    }
                }
            }
        }
        $durasi_lembur=$durasi_telat=0;
        $total_tepat_waktu=0;
        $potongan=$this->Hrms_model->get_potongan($id, $bulan);
        $data=array(
            'absensi'       => $this->Hrms_model->get_absensi_pegawai_by_month($id, $bulan),
            'gaji'          => $gaji,
            'bulan'         => $bulan,
            'uang_lembur'   => $this->Hrms_model->getUangLembur($id, $bulan)->uang_lembur,
            'detail_jasa'   => $cek_komisi,
            'komisiperpotong'=> $sum_komisi,
            'totalpotong'   => $total_potong,
            'komisi_langsung' => ($potongan != null ? $potongan->komisi_langsung : 0),
            'detail'        => $detail,
            'jumlah_denda'  => $jumlah_denda,
            'jumlah_kehadiran'=> $jumlah_kehadiran,
            'tepat_waktu'   => $total_tepat_waktu,
            'durasi_lembur' => $durasi_lembur,
            'durasi_telat'  => $durasi_telat,
            'jumlah_bolos' => $jumlah_bolos,
            'title'         =>'Slip Gaji',
        );
        // header('Content-type: application/json');
        // echo json_encode($data);
        // exit();
        $this->load->view('hrms/gaji/cetak_slip_gaji', $data);
    }
    private function currency($val){
        $data=explode('.', $val);
        $new=implode('', $data);
        return $new;
    }
    public function jurnal_gaji(){
        // $bulan=$this->input->post('bulan');
        // $newDate=date('m-Y', strtotime($bulan));
        // $data_trx=array(
        //                 'deskripsi'     => "Penggajian Karyawan an/ ".$this->input->post('nama_pegawai')." bulan ".$newDate,
        //                 'location_id'   => $this->input->post('location_id'),
        //                 'tanggal'       => date('Y-m-d'),
        //             );
        // $insert=$this->db->insert('tbl_trx_akuntansi', $data_trx);
        // $insert=1;
        // if ($insert == 1) {
        //     $id_last=$this->db->select_max('id_trx_akun')->from('tbl_trx_akuntansi')->get()->row();
            
        //     $data=array(
        //                 'id_trx_akun'   => $id_last->id_trx_akun,
        //                 'id_akun'       => 20,
        //                 'jumlah'        => $this->input->post('total_gaji'),
        //                 'tipe'          => 'KREDIT',
        //                 'keterangan'    => 'akun',
        //             );
        //     $this->db->insert('tbl_trx_akuntansi_detail', $data);
        //     $data=array(
        //                 'id_trx_akun'   => $id_last->id_trx_akun,
        //                 'id_akun'       => 43,
        //                 'jumlah'        => $this->input->post('total_gaji'),
        //                 'tipe'          => 'DEBIT',
        //                 'keterangan'    => 'lawan',
        //             );
        //     $this->db->insert('tbl_trx_akuntansi_detail', $data);
        // }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
}