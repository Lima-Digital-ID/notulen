<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cuti extends CI_Controller
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
        $data['title']='Cuti';
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        if (isset($_POST['bulan'])) {
            $id_pegawai=$this->input->post('id_pegawai');
            $tahun=$this->input->post('tahun');
            $bulan=$this->input->post('bulan');
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        }else{
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $this->template->load('template','hrms/cuti/list_cuti', $data);
    } 

    public function create($id, $date){
        $data['action'] = site_url('hrms/absensi/save_update_holiday');
        $id_pegawai=1;   
        if (isset($_POST['bulan'])) {
            $id_pegawai=$this->input->post('id_pegawai');
            $tahun=$this->input->post('tahun');
            $bulan=$this->input->post('bulan');
            $date=$tahun.'-'.$bulan;
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            if ($this->input->post('tanggal')) {
                $tgl=strtotime($this->input->post('tanggal'));
                $tanggal=date('Y-m-d', $tgl);
                $cek=$this->Hrms_model->get_cuti_by_date($id, $date);
                if (count($cek) < 3) {
                    $cek_date=$this->Hrms_model->cek_cuti_by_date($tanggal);
                    if ($cek_date == null) {
                        $data_cuti=array(
                            'id_pegawai'    => $this->input->post('id_pegawai'),
                            'tanggal'       => $tanggal
                        );
                        $this->Hrms_model->insert_setting('tbl_cuti', $data_cuti);
                        $this->session->set_flashdata('message_type', 'success');
                        $this->session->set_flashdata('message', 'Create Record Success');
                    }else{
                        $this->session->set_flashdata('message_type', 'error');
                        $this->session->set_flashdata('message', 'Tanggal yang anda input sudah ada');
                    }
                }else{
                    $this->session->set_flashdata('message_type', 'error');
                    $this->session->set_flashdata('message', 'Cuti hanya bisa diinput 3 hari');
                }
            }
        }else{
            $newDate=explode('-', $date);
            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $newDate[1], $newDate[0]);
        }

        $newDate=explode('-', $date);
        $data=array(
            'jumlah_hari'   => $jumlah_hari,  
            'list_cuti'     => $this->Hrms_model->get_cuti_by_date($id, $date),
            'date'          => $date,
            'bulan'         => $newDate[1],
            'tahun'         => $newDate[0],
            'id_pegawai'    => $id,
            'pegawai'       => $this->Tbl_pegawai_model->get_by_id($id),
            'title'         => 'Tambah Cuti Pegawai'
        );
        $this->template->load('template','hrms/cuti/cuti_form', $data);
    }

    public function json(){
        $data=$this->Tbl_pegawai_model->get_all($this->location_id);
        $data1 = array();
        $date=$this->input->post('bulan');
        foreach ($data as $data) {
            $row = array();
            $row['id_pegawai']= $data->id_pegawai;
            $row['nama_pegawai']= $data->nama_pegawai;
            $cuti=$this->Hrms_model->get_cuti_by_date($data->id_pegawai, $date);
            $list_cuti='';
            foreach ($cuti as $key => $value) {
                $tanggal=strtotime($value->tanggal);
                $list_cuti.=date('d-m-Y',$tanggal).", ";
            }
            $row['tanggal_cuti']= rtrim($list_cuti, ", ");
            $data1[] = $row;
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
    public function delete_cuti($id, $id_pegawai, $date){
        $row = $this->Hrms_model->get_cuti_by_id($id);
        if ($row) {
            $where=array('id' => $id);
            $this->Hrms_model->delete($where, 'tbl_cuti');
            $this->session->set_flashdata('message_type', 'success');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/cuti/create/'.$id_pegawai.'/'.$date));
        } else {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/cuti/create/'.$id_pegawai.'/'.$date));
        }
    }
    public function holiday()
    {
        $date=date('Y');
        if ($this->input->post('tahun')) {
            $date=$this->input->post('tahun');
        }
        $data=array(
            'title' => 'Setting Tanggal',
            'year'  => $date
        );

        $this->template->load('template','hrms/cuti/holiday_list', $data);
    } 
    public function json_holiday($year){
        header('Content-Type: application/json');
        echo $this->Hrms_model->json_holiday($year);
    }
    public function create_holiday() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/cuti/save_holiday'),
            'id' => set_value('id'),
            'tanggal' => set_value('tanggal'),
            'ket' => set_value('ket'),
            'title'       => 'Tambah Tanggal Merah'
        );
          
        $this->template->load('template','hrms/cuti/holiday_form', $data);
    }
    
    public function save_holiday() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $tgl=strtotime($this->input->post('tanggal',TRUE));
            $date=date('Y-m-d', $tgl);
            $data = array(
               'tanggal' => $date,
               'ket' => $this->input->post('ket',TRUE),
            );
            $check=$this->db->where('tanggal', $this->input->post('tanggal'))->get('tbl_holiday')->num_rows();
            if ($check < 1) {
                $this->db->insert('tbl_holiday', $data);
                $this->session->set_flashdata('message_type', 'success');
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('hrms/cuti/holiday'));
            }else{
                $this->session->set_flashdata('message_type', 'error');
                $this->session->set_flashdata('message', 'Input gagal, Jabatan yang diinput telah ter record');
                redirect(site_url('hrms/cuti/holiday'));
            }
        }
    }
    
    public function update_holiday($id) 
    {
        $row = $this->db->where('id', $id)->get('tbl_holiday')->row();
        if ($row) {
            $tgl=strtotime($row->tanggal);
            $date=date('d-m-Y', $tgl);
            $data = array(
                'button' => 'Update',
                'action' => site_url('hrms/cuti/save_update_holiday'),
                'id' => set_value('id', $row->id),
                'tanggal' => set_value('tanggal', $date),
                'ket' => set_value('ket', $row->ket),
                'title'       => 'Update Setting Tanggal'

        );
            $data['jabatan_option'] = array();
            $data['jabatan_option'][''] = 'Pilih Jabatan';
            foreach ($this->Tbl_jabatan_model->get_all() as $jabatan){
                $data['jabatan_option'][$jabatan->id_jabatan] = $jabatan->nama_jabatan;
            }
            $this->template->load('template','hrms/cuti/holiday_form', $data);
        } else {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/cuti/holiday'));
        }
    }
    
    public function save_update_holiday() 
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update_holiday($this->input->post('id', TRUE));
        } else {
            $tgl=strtotime($this->input->post('tanggal',TRUE));
            $date=date('Y-m-d', $tgl);
            $data = array(
               'tanggal' => $date,
               'ket' => $this->input->post('ket',TRUE),
            );
            $where=array('id'=> $this->input->post('id'));
           // print_r($data);exit();
            $this->Hrms_model->update($where, $data, 'tbl_holiday');
            $this->session->set_flashdata('message_type', 'success');
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hrms/cuti/holiday'));
        }
    }
    
    public function delete_holiday($id) 
    {
        $row = $this->db->where('id', $id)->get('tbl_holiday')->row();

        if ($row) {
            $this->db->where('id', $id)->delete('tbl_holiday');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/cuti/holiday'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/cuti/holiday'));
        }
    }

    public function cuti_bersama()
    {
        $data['title']='Cuti Bersama';
        $cuti = $this->db->get('tbl_cuti_bersama')->result();
        foreach ($cuti as $key => $value) {
            $value->detail=$this->db->where('id_cuti_bersama', $value->id)->get('tbl_cuti_bersama_d')->result();
        }
        $data['data']=$cuti;
        $this->template->load('template','hrms/cuti/cuti_bersama_list', $data);
    } 
    public function cuti_bersama_add(){
        $data['action'] = site_url('hrms/cuti/save_cuti_bersama');
        $data['title']='Tambah Cuti Bersama';
        $this->template->load('template','hrms/cuti/cuti_bersama_add', $data);
    }
    public function save_cuti_bersama(){
        $tgl=strtotime($this->input->post('start_date',TRUE));
        $tgl_end=strtotime($this->input->post('end_date',TRUE));
        $date=date('Y-m-d', $tgl);
        $date_end=date('Y-m-d', $tgl_end);

        $data_cuti=array(
            'nama'  => $this->input->post('ket')
            );
        $this->db->insert('tbl_cuti_bersama', $data_cuti);
        $insertId = $this->db->insert_id();
        
        for ($i=strtotime($date); $i <= strtotime($date_end); $i = $i + 86400) { 
            $cuti_d=array(
                'id_cuti_bersama'   => $insertId,
                'tanggal'           => date('Y-m-d', $i)
            );
            $this->db->insert('tbl_cuti_bersama_d', $cuti_d);
        }
        redirect('hrms/cuti/cuti_bersama');
    }
    public function delete_cuti_bersama($id) 
    {
        $row = $this->db->where('id', $id)->get('tbl_cuti_bersama')->row();

        if ($row) {
            $this->db->where('id', $id)->delete('tbl_cuti_bersama');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/cuti/cuti_bersama'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/cuti/cuti_bersama'));
        }
    }
    public function json_cuti_bersama_detail($id){
        $detail['data']=$this->db->where('id_cuti_bersama', $id)->get('tbl_cuti_bersama_d')->result();
        echo json_encode($detail);
    }
    public function _rules() 
    {
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'trim|required');
    }
}