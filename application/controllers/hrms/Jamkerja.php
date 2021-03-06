<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jamkerja extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_jam_kerja_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->location_id = $this->session->userdata('location_id');
        $this->role = $this->session->userdata('role');
    }

    public function index()
    {
        $data=array('title' => 'Jam Kerja', 'role' => $this->role);
        $this->template->load('template','hrms/jam_kerja/tbl_jam_kerja_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_jam_kerja_model->json($this->role);
    }

    public function create() 
    {
        $this->cekRole();
        $data = array(
            'button' => 'Create',
            'action' => site_url('hrms/jamkerja/create_action'),
    	    'id' => set_value('id'),
            'location_id' => set_value('location_id'),
            'jam_datang' => set_value('jam_datang'),
            'jam_pulang'  => set_value('jam_pulang'),
	    );
        $data['title']='Tambah Jam Kerja';
        $this->template->load('template','hrms/jam_kerja/tbl_jam_kerja_form', $data);
    }
    
    public function create_action() 
    {
        $this->cekRole();
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'location_id'   => $this->input->post('location_id',TRUE),
                'jam_datang' => $this->input->post('jam_datang',TRUE),
                'jam_pulang' => $this->input->post('jam_pulang',TRUE),
	        );

            $this->Tbl_jam_kerja_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('hrms/jamkerja'));
        }
    }
    
    public function update($id) 
    {
        $this->cekRole();
        $row = $this->Tbl_jam_kerja_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hrms/jam_kerja/update_action'),
                'id' => set_value('id', $row->id),
                'location_id' => set_value('location_id', $row->location_id),
                'jam_datang' => set_value('jam_datang', $row->jam_datang),
                'jam_pulang' => set_value('jam_pulang', $row->jam_pulang),
	        );
            $data['title']='Update jam_kerja';
            $this->template->load('template','hrms/jam_kerja/tbl_jam_kerja_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/jamkerja'));
        }
    }
    
    public function update_action() 
    {
        $this->cekRole();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'location_id'   => $this->input->post('location_id',TRUE),
                'jam_datang' => $this->input->post('jam_datang',TRUE),
                'jam_pulang' => $this->input->post('jam_pulang',TRUE),
                'dtm_upd' => date("Y-m-d H:i:s",  time())
	    );

            $this->Tbl_jam_kerja_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hrms/jamkerja'));
        }
    }
    
    public function delete($id) 
    {
        $this->cekRole();
        $row = $this->Tbl_jam_kerja_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jam_kerja_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hrms/jamkerja'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hrms/jamkerja'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id', 'id jam_kerja', 'trim');
        $this->form_validation->set_rules('location_id', 'location_id', 'trim|required');
        $this->form_validation->set_rules('jam_pulang', 'jam_pulang', 'trim|required');
        $this->form_validation->set_rules('jam_datang', 'jam_datang', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    private function cekRole(){
        if ($this->role != 1) {
            redirect(site_url('hrms/jamkerja'));
        }
    }
}

/* End of file jam_kerja.php */
/* Location: ./application/controllers/jam_kerja.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */