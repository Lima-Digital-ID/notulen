<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {
	function __construct(){
		parent::__construct();
		is_login();
		$this->load->model('Admin_model');
		$this->load->library('datatables');
		$this->role=$this->session->userdata('role');
		$this->user_id=$this->session->userdata('id');
		$this->id_pegawai=$this->session->userdata('id_pegawai');
		$this->load->library('upload');
		$this->load->helper('url'); 
	}
	public function index()
	{
		$where = isset($_GET['id_tipe']) ? ['id_tipe' => $_GET['id_tipe']] : '';
		$tipe_pegawai = $this->Admin_model->getData('*','tipe_pegawai','',$where,'')->result_array();

		$tipe = isset($_GET['id_tipe']) ? $tipe_pegawai[0]['tipe'] : '';
		$data=array(
			'title'	=> 'Absensi '.$tipe,
			'tipe_pegawai' => $tipe_pegawai,
			'tipe' => $tipe
		);
		if(empty($_GET['id_tipe'])){
			$this->template->load('template', 'absensi/pilih-absensi', $data);
		}
		else{
			$this->template->load('template', 'absensi/absensi', $data);
		}
	}
	public function kunjungan_harian_json()
	{
		header('Content-Type: application/json');
		$dt=$this->Admin_model->kunjungan_harian_json($this->id_pegawai);
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function rapat_harian_json()
	{
		header('Content-Type: application/json');
		$dt=$this->Admin_model->rapat_harian_json($this->id_pegawai);
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function upload(){
		$waktu=date('Y-m-d H:i:s');
		$id=$this->input->post('id'); //id anggota kunjungan
		$longitude=$this->input->post('longitude');
		$latitude=$this->input->post('latitude');
		$data=$_POST['file_absen'];

		$data = str_replace('data:image/jpeg;base64,', '', $data);

		$data = str_replace(' ', '+', $data);

		$data = base64_decode($data);

		$file = time() . '.jpeg';

		$success = file_put_contents('assets/images/'.$file, $data);

		// $cek=$this->db->where('id_pegawai', $this->id_pegawai)->where('id_kunjungan', $id)->get('absensi')->row();
		
		$select = $this->db->query("SELECT * FROM anggota_kunjungan WHERE id='$id'")->row_array();
		$insert=array(
			'id_kunjungan'	=> $select['id_kunjungan'],
			'id_pegawai'	=> $select['id_pegawai'],
			'waktu'		=> $waktu,
			'longitude'	=> $longitude,
			'latitude'	=> $latitude,
			'file'		=> $file,
		);
/* 		if($select['absen'] == 3){
			$update=array(
				'id_kunjungan'	=> $select['id_kunjungan'],
				'id_pegawai'	=> 0,
				'waktu'		=> $waktu,
				'longitude'	=> $longitude,
				'latitude'	=> $latitude,
				'file'		=> $file,
			);
		}else{
			$update=array(
				'id_kunjungan'	=> $select['id_kunjungan'],
				'id_pegawai'	=> $id,
				'waktu'		=> $waktu,
				'longitude'	=> $longitude,
				'latitude'	=> $latitude,
				'file'		=> $file,
			);
		}	
 */		
/* 		if($cek != null){
			$this->db->where('id', $cek->id)->update('absensi', $update);
		}else{
			$this->db->insert('absensi', $update);
		}
 */
		$this->db->insert('absensi', $insert);
		redirect('absensi?showModal=true&idKunjungan='.$select['id_kunjungan']."&id_tipe=".$_POST['id_tipe']);
	}
	public function uploadrapat(){
		$waktu=date('Y-m-d H:i:s');
		$id=$this->input->post('id2'); //anggota rapat
		$longitude=$this->input->post('longitude');
		$latitude=$this->input->post('latitude');
		$data=$_POST['file_absen'];

		$data = str_replace('data:image/jpeg;base64,', '', $data);

		$data = str_replace(' ', '+', $data);

		$data = base64_decode($data);

		$file = time() . '.jpeg';

		$success = file_put_contents('assets/images/'.$file, $data);

		// $cek=$this->db->where('id_pegawai', $this->id_pegawai)->where('id_rapat', $id)->get('absensi_rapat')->row();
		
		$select = $this->db->query("SELECT * FROM anggota_rapat WHERE id='$id'")->row_array();
	
		$insert=array(
			'id_rapat'	=> $select['id_rapat'],
			'id_pegawai'	=> $select['id_pegawai'],
			'waktu'		=> $waktu,
			'longitude'	=> $longitude,
			'latitude'	=> $latitude,
			'file'		=> $file,
		);
			
		$this->db->insert('absensi_rapat', $insert);
/*
		if($cek != null){
			$this->db->where('id', $cek->id)->update('absensi_rapat', $update);
		}else{
			$this->db->insert('absensi_rapat', $update);
		}
		*/	
		redirect('absensi?showModal=true&idRapat='.$select['id_rapat']."&id_tipe=".$_POST['id_tipe']);
}
	public function uploadkunjungan(){
		$waktu=date('Y-m-d H:i:s');
		$id=$this->input->post('id2');
		$longitude=$this->input->post('longitude');
		$latitude=$this->input->post('latitude');
		$data=$_POST['file_absen'];

		$data = str_replace('data:image/jpeg;base64,', '', $data);

		$data = str_replace(' ', '+', $data);

		$data = base64_decode($data);

		$file = time() . '.jpeg';

		$success = file_put_contents('assets/images/'.$file, $data);

		$cek=$this->db->where('id_pegawai', $this->id_pegawai)->where('id_kunjungan', $id)->get('absensi')->row();
		
		$select = $this->db->query("SELECT * FROM anggota_kunjungan WHERE id='$id'")->row_array();
	
			$update=array(
				'id_kunjungan'	=> $select['id_kunjungan'],
				'id_pegawai'	=> $id,
				'waktu'		=> $waktu,
				'longitude'	=> $longitude,
				'latitude'	=> $latitude,
				'file'		=> $file,
			);
			
		if($cek != null){
			$this->db->where('id', $cek->id)->update('absensi', $update);
		}else{
			$this->db->insert('absensi', $update);
		}
		redirect('absensi?showModal=true&idKunjungan='.$select['id_kunjungan']."&id_tipe=".$_POST['id_tipe']);
	}
}
