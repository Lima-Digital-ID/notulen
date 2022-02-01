<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Set_gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_ref_gaji_model');
        $this->load->model('hrms/Tbl_jabatan_model');
        $this->load->model('hrms/Hrms_model');
        $this->load->model('hrms/Tbl_pegawai_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        $this->id_klinik = $this->session->userdata('id_klinik');
        $this->location_id = $this->session->userdata('location_id');
    }

    public function index()
    {
        $data['title']='Setting Gaji';
        $this->template->load('template','hrms/setting_gaji/setting_gaji_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Hrms_model->json_setting_gaji($this->location_id);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/set_gaji/create_action'),
            'id_set_gaji' => set_value('id_set_gaji'),
            'id_pegawai' => set_value('id_pegawai'),
            'gaji_pokok' => set_value('gaji_pokok'),
            'gaji_min' => set_value('gaji_min'),
            'denda_weekday' => set_value('denda_weekday'),
            'denda_weekend' => set_value('denda_weekend'),
            'bonus_kerajinan' => set_value('bonus_kerajinan'),
            // 'potongan_telat' => set_value('potongan_telat'),
            'kom_trx' => set_value('kom_trx'),
            'denda' => set_value('denda'),
            'kom_min' => set_value('kom_min'),
            'kom_level' => set_value('kom_level'),
            'tipe_gaji' => set_value('tipe_gaji'),
            'title'     => 'Setting Gaji Pegawai'
    );
        $data['pegawai_option'] = array();
        $data['pegawai_option'][0] = 'Pilih Pegawai';
        foreach ($this->Tbl_pegawai_model->get_all($this->location_id) as $pegawai){
            $data['pegawai_option'][$pegawai->id_pegawai] = $pegawai->nama_pegawai;
        }
        $this->template->load('template','hrms/setting_gaji/setting_gaji_create', $data);
    }
    
    public function get_referensi($id){
        $pegawai=$this->Tbl_pegawai_model->get_by_id($id);
        $ref_gaji=$this->Tbl_ref_gaji_model->get_by_jabatan($pegawai->id_jabatan);
        header('Content-Type: application/json');
        echo json_encode($ref_gaji);
    }
    public function create_action() 
    {
        $gaji_pokok = $this->input->post('gaji_pokok',TRUE);
        $uang_kehadiran = ($this->input->post('check_uk') ? $this->input->post('uang_kehadiran',TRUE) : '');
        $uang_makan = ($this->input->post('check_um') ? $this->input->post('uang_makan',TRUE) : '');
        $uang_transport = ($this->input->post('check_ut') ? $this->input->post('uang_transport',TRUE) : '');
        $uang_lembur = $this->input->post('uang_lembur',TRUE);
        $gaji_min = $this->input->post('gaji_min',TRUE);
        $denda_weekday = $this->input->post('denda_weekday',TRUE);
        $denda_weekend = $this->input->post('denda_weekend',TRUE);
        $bonus_kerajinan = $this->input->post('bonus_kerajinan',TRUE);
        $denda = $this->input->post('denda',TRUE);
        $kom_min = $this->input->post('kom_min',TRUE);
        $kom_trx = $this->input->post('kom_trx',TRUE);
        $kom_level = $this->input->post('kom_level',TRUE);
        $tipe_gaji = $this->input->post('tipe_gaji',TRUE);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_pegawai' => $this->input->post('id_pegawai',TRUE),
                'gaji_pokok' => $this->currency($gaji_pokok),
                'gaji_min' => $this->currency($gaji_min),
                'denda' => $this->currency($denda),
                'denda_weekday' => $this->currency($denda_weekday),
                'denda_weekend' => $this->currency($denda_weekend),
                'bonus_kerajinan' => $this->currency($bonus_kerajinan),
                'kom_min' => $this->currency($kom_min),
                'kom_trx' => $this->currency($kom_trx),
                'kom_level' => $this->currency($kom_level),
                'tipe_gaji' => $this->input->post('tipe_gaji',TRUE),
            );
            $check=$this->db->where('id_pegawai', $this->input->post('id_pegawai'))->get('tbl_setting_gaji')->num_rows();
            if ($check < 1) {
                $this->Hrms_model->insert_setting('tbl_setting_gaji', $data);
                $this->session->set_flashdata('message_type', 'success');
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('hrms/set_gaji'));
            }else{
                $this->session->set_flashdata('message_type', 'danger');
                $this->session->set_flashdata('message', 'Input gagal, data pegawai yang diinput telah ter record sebelumnya');
                redirect(site_url('hrms/set_gaji'));
            }
        }
    }

    public function update($id) 
    {
        $row = $this->Hrms_model->get_setting_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hrms/set_gaji/update_action'),
                'id_set_gaji' => set_value('id_set_gaji', $row->id_setting_gaji),
                'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
                'gaji_pokok' => set_value('gaji_pokok', $row->gaji_pokok),
                'gaji_min' => set_value('gaji_min', $row->gaji_min),
                'denda' => set_value('denda', $row->denda),
                'denda_weekday' => set_value('denda_weekday', $row->denda_weekday),
                'denda_weekend' => set_value('denda_weekend', $row->denda_weekend),
                'bonus_kerajinan' => set_value('bonus_kerajinan', $row->bonus_kerajinan),
                'kom_min' => set_value('kom_min', $row->kom_min),
                'kom_trx' => set_value('kom_trx', $row->kom_trx),
                'kom_level' => set_value('kom_level', $row->kom_level),
                'tipe_gaji' => set_value('tipe_gaji', $row->tipe_gaji),
                'title'     => 'Update Setting Gaji Pegawai'

        );
            $data['pegawai_option'] = array();
            $data['pegawai_option'][0] = 'Pilih Pegawai';
            foreach ($this->Tbl_pegawai_model->get_all($this->id_klinik) as $pegawai){
                $data['pegawai_option'][$pegawai->id_pegawai] = $pegawai->nama_pegawai;
            }
            $this->template->load('template','hrms/setting_gaji/setting_gaji_create', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/set_gaji'));
        }
    }
    
    public function update_action() 
    {
        $gaji_pokok = $this->input->post('gaji_pokok',TRUE);
        $uang_kehadiran = ($this->input->post('check_uk') ? $this->input->post('uang_kehadiran',TRUE) : '');
        $uang_makan = ($this->input->post('check_um') ? $this->input->post('uang_makan',TRUE) : '');
        $uang_transport = ($this->input->post('check_ut') ? $this->input->post('uang_transport',TRUE) : '');
        $denda = $this->input->post('denda',TRUE);
        $denda_weekday = $this->input->post('denda_weekday',TRUE);
        $denda_weekend = $this->input->post('denda_weekend',TRUE);
        $bonus_kerajinan = $this->input->post('bonus_kerajinan',TRUE);
        $gaji_min = $this->input->post('gaji_min',TRUE);
        $kom_min = $this->input->post('kom_min',TRUE);
        $kom_level = $this->input->post('kom_level',TRUE);
        $kom_trx = $this->input->post('kom_trx',TRUE);
        $tipe_gaji = $this->input->post('tipe_gaji',TRUE);
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_set_gaji', TRUE));
        } else {
            $data = array(
                'gaji_pokok' => $this->currency($gaji_pokok),
                'gaji_min' => $this->currency($gaji_min),
                'denda' => $this->currency($denda),
                'denda_weekday' => $this->currency($denda_weekday),
                'denda_weekend' => $this->currency($denda_weekend),
                'bonus_kerajinan' => $this->currency($bonus_kerajinan),
                'kom_min' => $this->currency($kom_min),
                'kom_trx' => $this->currency($kom_trx),
                'kom_level' => $this->currency($kom_level),
                'tipe_gaji' => $this->input->post('tipe_gaji',TRUE),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
        );
            $where=array('id_setting_gaji'=>$this->input->post('id_set_gaji', TRUE));
            $this->Hrms_model->update($where, $data, 'tbl_setting_gaji');
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hrms/set_gaji'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Hrms_model->get_setting_by_id($id);

        if ($row) {
            $where=array('id_setting_gaji'=>$id);
            $this->Hrms_model->delete($where, 'tbl_setting_gaji');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/set_gaji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/set_gaji'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_pegawai', 'id set_gaji', 'trim');
        $this->form_validation->set_rules('gaji_pokok', 'gaji_pokok', 'trim|required');
        $this->form_validation->set_rules('uang_kehadiran', 'uang_kehadiran', 'trim');
        $this->form_validation->set_rules('uang_transport', 'uang_transport', 'trim');
        $this->form_validation->set_rules('uang_makan', 'uang_makan', 'trim');
        $this->form_validation->set_rules('uang_lembur', 'uang_lembur', 'trim');
        $this->form_validation->set_rules('tunjangan', 'tunjangan', 'trim');
    }
    
    private function currency($val){
        $data=explode('.', $val);
        $new=implode('', $data);
        return $new;
    }

}

/* End of file Dokter.php */
/* Location: ./application/controllers/Dokter.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */