<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_pegawai_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->location_id = $this->session->userdata('location_id');
        $this->role= $this->session->userdata('role');
    }

    public function index()
    {
        $data['title']='Pegawai';
        $this->template->load('template','hrms/pegawai/tbl_pegawai_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_pegawai_model->json($this->location_id);
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/pegawai/create_action'),
    	    'id_pegawai' => set_value('id_pegawai'),
    	    'nama_pegawai' => set_value('nama_pegawai'),
            'email' => set_value('email'),
            'no_hp' => set_value('no_hp'),
            'alamat_tinggal' => set_value('alamat_tinggal'),
            'id_jabatan' => set_value('id_jabatan'),
            'id_shift' => set_value('id_shift'),
            'location_id' => set_value('location_id'),
            'tanggal_mulai_tugas' => set_value('tanggal_mulai_tugas'),
            'role'  => $this->role
	    );
        $data['title']='Tambah Pegawai';
        $this->template->load('template','hrms/pegawai/tbl_pegawai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
        		'email' => $this->input->post('email',TRUE),
                'no_hp' => $this->input->post('no_hp',TRUE),
                'alamat_tinggal' => $this->input->post('alamat_tinggal',TRUE),
                'id_jabatan' => $this->input->post('id_jabatan',TRUE),
                'tanggal_mulai_tugas' => $this->input->post('tanggal_mulai_tugas',TRUE),
                'id_shift' => $this->input->post('id_shift',TRUE),
                'location_id'   => $this->input->post('location_id',TRUE)
	       );

            $this->Tbl_pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('hrms/pegawai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hrms/pegawai/update_action'),
                'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
                'nama_pegawai' => set_value('nama_pegawai', $row->nama_pegawai),
                'email' => set_value('email', $row->email),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'alamat_tinggal' => set_value('alamat_tinggal', $row->alamat_tinggal),
                'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
                'tanggal_mulai_tugas' => set_value('tanggal_mulai_tugas', $row->tanggal_mulai_tugas),
                'id_shift' => set_value('id_shift', $row->id_shift),
                'location_id' => set_value('location_id', $row->location_id),
                'role'  => $this->role
	        );
            $data['title']='Update Pegawai';
            $this->template->load('template','hrms/pegawai/tbl_pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/pegawai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pegawai', TRUE));
        } else {
            $data = array(
        		'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
                'email' => $this->input->post('email',TRUE),
                'no_hp' => $this->input->post('no_hp',TRUE),
                'alamat_tinggal' => $this->input->post('alamat_tinggal',TRUE),
                'id_jabatan' => $this->input->post('id_jabatan',TRUE),
                'tanggal_mulai_tugas' => $this->input->post('tanggal_mulai_tugas',TRUE),
                'id_shift' => $this->input->post('id_shift',TRUE),
                'location_id'   => $this->input->post('location_id',TRUE),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
	    );

            $this->Tbl_pegawai_model->update($this->input->post('id_pegawai', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hrms/pegawai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pegawai_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/pegawai'));
        }
    }

    public function _rules() 
    {
        
    $this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim');
	$this->form_validation->set_rules('nama_pegawai', 'nama pegawai', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
    $this->form_validation->set_rules('alamat_tinggal', 'alamat tinggal', 'trim|required');
    $this->form_validation->set_rules('id_jabatan', 'id jabatan', 'trim|required');
    $this->form_validation->set_rules('tanggal_mulai_tugas', 'tanggal mulai tugas', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pegawai.xls";
        $judul = "tbl_pegawai";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Tinggal");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Status Menikah");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Spesialis");
	xlsWriteLabel($tablehead, $kolomhead++, "No Izin Praktek");
	xlsWriteLabel($tablehead, $kolomhead++, "Golongan Darah");
	xlsWriteLabel($tablehead, $kolomhead++, "Alumni");

	foreach ($this->Tbl_pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_tinggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_status_menikah);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_spesialis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_izin_praktek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->golongan_darah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alumni);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_pegawai.doc");

        $data = array(
            'tbl_pegawai_data' => $this->Tbl_pegawai_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pegawai/tbl_pegawai_doc',$data);
    }
    
    function autocomplate(){
        autocomplate_json('tbl_pegawai', 'nama_pegawai');
    }

}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */