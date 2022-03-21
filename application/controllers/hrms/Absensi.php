<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_jabatan_model');
        $this->load->model('hrms/Hrms_model');
        $this->load->model('hrms/Tbl_pegawai_model');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->location_id = $this->session->userdata('location_id');
    }

    public function index()
    {
        $data['title']='Daftar Hadir';
        $this->template->load('template','hrms/absensi/absensi_list', $data);
    } 

    public function month()
    {
        $date=date('Y-m');
        $id_pegawai=1;
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        if (isset($_POST['id_pegawai'])) {
            $id_pegawai=$this->input->post('id_pegawai');
            $tahun=$this->input->post('tahun');
            $bulan=$this->input->post('bulan');
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        }else{
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['pegawai_option'] = array();
        $data['pegawai_option'][''] = 'Pilih Pegawai';
        $pegawai=$this->Tbl_pegawai_model->get_all($this->location_id);
        foreach ($pegawai as $pegawai){
            $data['pegawai_option'][$pegawai->id_pegawai] = $pegawai->nama_pegawai;
        }
        $data1=array();
        $absensi=array();
        $month='';
        if ($id_pegawai != 0) {
            $data1=array();
            for ($i=1; $i <= $jumlah_hari; $i++) { 
                $month=$tahun.'-'.$bulan.'-'.$i;
                // echo $month;
                $absensi_pegawai=$this->Hrms_model->get_absensi_pegawai_by_day($id_pegawai, $month);
                // print_r($absensi_pegawai);
                $row=array();
                $day=(strlen($i) == 1 ? '0'.$i : $i);
                $newMonth=(strlen($bulan) == 1 ? '0'.$bulan : $bulan);
                $row['tanggal']= $day.'-'.$newMonth.'-'.$tahun;
                $row['date']= $month;
                if ($absensi_pegawai != null) {
                    $row['id_pegawai']= $absensi_pegawai->id_pegawai;
                    $row['nama_pegawai']= $absensi_pegawai->nama_pegawai;
                    $row['jam_datang']= ($absensi_pegawai->jam_datang != null ? $absensi_pegawai->jam_datang : '');
                    $row['jam_pulang']= ($absensi_pegawai->jam_pulang != null ? $absensi_pegawai->jam_pulang : '');   
                }else{
                    $row['jam_datang']= '';
                    $row['jam_pulang']= '';   
                }
                $row['action']       = anchor(site_url('hrms/set_gaji/update/').($pegawai != null ? $pegawai->id_pegawai : ''),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-success btn-sm"')." 
                    ".anchor(site_url('hrms/set_gaji/delete/').($pegawai != null ? $pegawai->id_pegawai : ''),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                $data1[]=$row;
            }
            $absensi=array('nama_pegawai'=>($pegawai != null ? $pegawai->nama_pegawai : ''), 'data'=>$data1);
        }
        $data['absensi']=$absensi;
        $data['jumlah_hari']=$jumlah_hari;
        $data['id_pegawai']=$id_pegawai;
        $data['tanggal']=$date;
        $data['title']='List Absensi Per Bulan';

        $this->template->load('template','hrms/absensi/absensi_list_month', $data);
    } 
    
    public function json() {
        $date=date('Y-m-d');
        if (isset($_POST['date'])) {
            $date=$_POST['date'];
        }
        $data1=array();
        foreach ($this->Tbl_pegawai_model->get_all($this->location_id) as $pegawai){
            $absensi_pegawai=$this->db->where('tanggal', $date)->where('id_pegawai', $pegawai->id_pegawai)->get('tbl_absensi_pegawai')->row();
            $row=array();
            $row['id_pegawai']= $pegawai->id_pegawai;
            $row['nama_pegawai']= $pegawai->nama_pegawai;
            $row['tanggal']= $date;
            if ($absensi_pegawai != null) {
                $row['jam_datang']= ($absensi_pegawai->jam_datang != null ? $absensi_pegawai->jam_datang : '');
                $row['jam_pulang']= ($absensi_pegawai->jam_pulang != null ? $absensi_pegawai->jam_pulang : '');   
            }else{
                $row['jam_datang']= '';
                $row['jam_pulang']= '';   
            }
            $row['action']       = anchor(site_url('hrms/set_gaji/update/').$pegawai->id_pegawai,'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-success btn-sm"')." 
                ".anchor(site_url('hrms/set_gaji/delete/').$pegawai->id_pegawai,'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
            $data1[]=$row;
        }
        $output = array(
                        "draw" => 0,
                        "recordsTotal" => count($data1),
                        "recordsFiltered" => count($data1),
                        "data" => $data1,
                );
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/jabatan/create_action'),
            'id_jabatan' => set_value('id_jabatan'),
            'nama_jabatan' => set_value('nama_jabatan'),
    );
        $this->template->load('template','hrms/absensi/tbl_jabatan_create', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
        );

            $this->Tbl_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('hrms/absensi'));
        }
    }
    
    public function update($id, $date) 
    {
        $cek = $this->Hrms_model->get_absensi_by_id_pegawai($id, $date);
        
        if ($cek == null) {
            $data_insert=array('id_pegawai'=>$id, 'tanggal'=>$date);
            if ($date != '00:00:00') {
                # code...
                $this->db->insert('tbl_absensi_pegawai',$data_insert);
            }
        }
        $row = $this->Hrms_model->get_absensi_by_id_pegawai($id, $date);
        $data = array(
            'button' => 'Update',
            'action' => site_url('hrms/absensi/update_action'),
            'id_absensi' => set_value('id_absensi', $row->id_absensi),
            'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
            'nama_pegawai' => set_value('nama_pegawai', $row->nama_pegawai),
            'tanggal' => set_value('tanggal', $row->tanggal),
            'jam_datang' => set_value('jam_datang', ($row->jam_datang == null ? '00:00:00' : $row->jam_datang)),
            'jam_pulang' => set_value('jam_pulang', ($row->jam_datang == null ? '00:00:00' : $row->jam_pulang)),
            'ket' => set_value('ket', $row->ket),
            'uang_lembur' => set_value('uang_lembur', $row->uang_lembur),
            'title'     => 'Edit Daftar Hadir'
        );
        $this->template->load('template','hrms/absensi/absensi_update', $data);
    }
   
    public function update_action() 
    {
        $data = array(
            'id_pegawai' => $this->input->post('id_pegawai',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'jam_datang' => $this->input->post('jam_datang',TRUE),
            'jam_pulang' => $this->input->post('jam_pulang',TRUE),
            'ket' => $this->input->post('ket',TRUE),
            'uang_lembur' => $this->currency($this->input->post('uang_lembur',TRUE)),
            'dtm_upd' => date("Y-m-d H:i:s",  time())
        );
        $where=array('id_absensi'=>$this->input->post('id_absensi', TRUE));
        $this->Hrms_model->update($where, $data, 'tbl_absensi_pegawai');
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('hrms/absensi'));
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_jabatan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/absensi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/absensi'));
        }
    }
    public function lembur(){
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/absensi/save_lembur'),
            'title' => 'Tambah Lembur'
        );
        $data['pegawai_option'] = array();
        $data['pegawai_option'][''] = 'Pilih Pegawai';
        foreach ($this->Tbl_pegawai_model->get_all($this->location_id) as $pegawai){
            $data['pegawai_option'][$pegawai->id_pegawai] = $pegawai->nama_pegawai;
        }
        $this->template->load('template','hrms/absensi/create_durasi_lembur', $data);
    }
    public function save_lembur(){
        $id=$this->input->post('id_pegawai');
        $tgl=strtotime($this->input->post('tanggal'));
        $date=date('Y-m-d', $tgl);
        $uang_lembur =$this->input->post('uang_lembur',TRUE);
        $row = $this->Hrms_model->get_absensi_by_id_pegawai($id, $date);
        if ($row == null) {
            $this->db->insert('tbl_absensi_pegawai',array('id_pegawai'=>$id, 'tanggal'=>$date));
            $row = $this->Hrms_model->get_absensi_by_id_pegawai($id, $date);

            $data = array(
                // 'durasi_lembur' => $this->input->post('durasi',TRUE),
                'uang_lembur' => $this->currency($uang_lembur),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
            );
            $where=array('id_absensi'=>$row->id_absensi);
            $this->Hrms_model->update($where, $data, 'tbl_absensi_pegawai');
            redirect(site_url('hrms/absensi'));
        }else{
            $data = array(
                'uang_lembur' => $this->currency($uang_lembur),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
            );
            $where=array('id_absensi'=>$row->id_absensi);
            $this->Hrms_model->update($where, $data, 'tbl_absensi_pegawai');
            redirect(site_url('hrms/absensi'));
        }
    }

    public function cuti(){
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/absensi/addCuti'),
        );
        $date=date('Y-m');
        $id_pegawai=1;
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        if (isset($_POST['id_pegawai'])) {
            $id_pegawai=$this->input->post('id_pegawai');
            $tahun=$this->input->post('tahun');
            $bulan=$this->input->post('bulan');
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        }else{
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $cuti=$this->Hrms_model->get_cuti_by_date($id_pegawai, $date);
        $data['pegawai_option'] = array();
        $data['pegawai_option'][''] = 'Pilih Pegawai';
        $pegawai=$this->Tbl_pegawai_model->get_all();
        foreach ($pegawai as $pegawai){
            $data['pegawai_option'][$pegawai->id_pegawai] = $pegawai->nama_pegawai;
        }
        $data['title']='Tambah Cuti Pegawai';

        $this->template->load('template','hrms/absensi/absensi_cuti_form', $data);
    }

    public function addCuti(){

    }

    public function import_excel(){
        $data['title']='Import Daftar Hadir';
        $this->template->load('template','hrms/absensi/import_excel', $data);
    }
    
    public function upload(){
        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = 'assets/import_excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $inputFileName = 'assets/import_excel/'.$fileName;
        
        // try {
        if (is_readable($inputFileName)) {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        }else{
            $this->session->set_flashdata('message', 'File Tidak Bisa Terbaca');
            $this->session->set_flashdata('message_type', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        }
        // } catch(Exception $e) {
        //     die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        // }
 
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        $data_existing = array();
        $error_data = false;
        $error_desc = '';
        $jmlsukses = 0;
        $jmlgagal = 0;

        for ($row = 0; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
            
            $data=$this->db->where('nama_pegawai', strtolower($rowData[0][0]))->get('tbl_pegawai')->row();
            if ($data != null) {
                    $data_import=array(
                        'id_pegawai'        => $data->id_pegawai,
                        'jam_datang'        => PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][2],  "HH:i:s"),
                        'jam_pulang'        => PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][5],  "HH:i:s"),
                        'tanggal'           => PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][1],  "YYYY-MM-DD"),
                    );
                    $cekabsensi=$this->db->where('tanggal', $data_import['tanggal'])->where('id_pegawai', $data_import['id_pegawai'])->get('tbl_absensi_pegawai');
                    if ($cekabsensi->num_rows() == 0) {
                        $this->db->insert('tbl_absensi_pegawai', $data_import);
                    }else{
                        $absensi=$cekabsensi->row();
                        $this->db->where('id_absensi', $absensi->id_absensi)->update('tbl_absensi_pegawai', $data_import);
                    }
            }
        }
        //Hapus file import
        $this->load->helper("file");
        delete_files($config['upload_path']); 
        redirect(site_url('hrms/absensi'));
    }
    private function currency($val){
        $data=explode('.', $val);
        $new=implode('', $data);
        return $new;
    }
}