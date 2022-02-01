<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	var $segment;
	function __construct(){
		parent::__construct();
		is_login();
		$this->segment=$this->uri->rsegment_array();
		$this->load->model('Member_model');
		$this->load->model('Tpoin_model');
		$this->load->library('datatables');
	}
	public function index()
	{
		$data=array();
		$data['filter']=0;
		$data['value']=0;
		if ($this->input->post('filter')) {
			if ($this->input->post('filter') == 'bulan') {
				$data['filter']='bulan';
				$data['value']=$this->input->post('bulan');
			}else{
				$data['filter']='tanggal';
				$data['value']=$this->input->post('date');
			}
		}
		$data['title']='Data Transaksi';
		$this->template->load('template', 'transaksi/transaksi_list', $data);
	}
	public function json(){
		header('Content-Type: application/json');
		echo $this->Tpoin_model->json();
	}
	public function jsonFilter($tipe, $filter){
		header('Content-Type: application/json');
		echo $this->Tpoin_model->jsonFilter($tipe, $filter);
	}
	public function history_trx($id){
		header('Content-Type: application/json');
		echo $this->Tpoin_model->jsonById($id);
	}
	public function profile($id){
		$this->_rules();
		if ($this->form_validation->run() == TRUE) {
			$data_admin=array(
				'adm_username' => $this->input->post('adm_username'),
				'adm_nama' => $this->input->post('adm_nama'),
				'adm_telp' => $this->input->post('adm_telp'),
				'adm_role' => $this->input->post('adm_role'),
				'adm_status' => $this->input->post('adm_status'),
			);
			$this->Admin_model->update($this->input->post('adm_id'), $data_admin);
		}
		$this->data['data']=$this->Admin_model->get_by_id($id);
		$this->template->load('template', 'auth/profile', $this->data);

	}
	public function changePassword(){
		$data_password=array(
			'adm_password' => md5($this->input->post('password')),
		);
		$this->Admin_model->update($this->input->post('id'), $data_password);
		redirect('user/profile/'.$this->input->post('id'));

	}
	public function _rules() 
    {
		$this->form_validation->set_rules('adm_username', 'username', 'trim|required');
		$this->form_validation->set_rules('adm_nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('adm_telp', 'Telp', 'trim|required');
		$this->form_validation->set_rules('adm_role', 'Role', 'trim|required');
		$this->form_validation->set_rules('adm_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
