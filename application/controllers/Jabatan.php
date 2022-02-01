<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('hrms/Tbl_jabatan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->location_id = $this->session->userdata('location_id');
        $this->role= $this->session->userdata('role');
    }

    public function index()
    {
        $data['title']='Jabatan';
        $this->template->load('template','jabatan/jabatan_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_jabatan_model->json();
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan/create_action'),
    	    'jabatan' => set_value('jabatan'),
	    );
        $data['title']='Tambah Jabatan';
        $this->template->load('template','jabatan/jabatan_form', $data);
    }
    
    public function create_action() 
    {
        // $this->_rules();

        $data = array(
            'jabatan' => $this->input->post('jabatan',TRUE),
       );

        $this->Tbl_jabatan_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success 2');
        redirect(site_url('jabatan'));
        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
        // }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan/update_action'),
                'id' => set_value('id', $row->id),
                'jabatan' => set_value('jabatan', $row->jabatan)
	        );
            $data['title']='Update Jabatan';
            $this->template->load('template','jabatan/jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update_action() 
    {
        // $this->_rules();
    	$row = $this->Tbl_jabatan_model->get_by_id($this->input->post('id', TRUE));
            $data = array(
        		'jabatan' => $this->input->post('jabatan',TRUE),
	           );

            $this->Tbl_jabatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan'));
        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_pegawai', TRUE));
        // } else {
        // }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_jabatan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function list_anggota()
    {
        $dt=$this->db->where('tipe !=', 2)->get('tbl_pegawai')->result();
        $data=array(
            'data'  => $dt
        );
        echo json_encode($data);
    }
    public function _rules() 
    {
        
    // $this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim');
	// $this->form_validation->set_rules('username', 'nama pegawai', 'trim|required');
 //    // $this->form_validation->set_rules('email', 'email', 'trim|required');
	// $this->form_validation->set_rules('password', 'no hp', 'trim|required');
 //    // $this->form_validation->set_rules('id_pegawai', 'alamat tinggal', 'trim|required');
 //    // $this->form_validation->set_rules('id_jabatan', 'id jabatan', 'trim|required');
 //    $this->form_validation->set_rules('tanggal_mulai_tugas', 'tanggal mulai tugas', 'trim|required');
	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user.xls";
        $judul = "user";
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

	foreach ($this->User_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
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
        header("Content-Disposition: attachment;Filename=user.doc");

        $data = array(
            'user_data' => $this->User_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pegawai/user_doc',$data);
    }
    
    function autocomplate(){
        autocomplate_json('user', 'username');
    }

}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */