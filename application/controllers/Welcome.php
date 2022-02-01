<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		is_login();
		$this->load->model('Admin_model');
		$this->load->model('hrms/Tbl_pegawai_model');
		$this->load->library('datatables');
		$this->role=$this->session->userdata('role');
		$this->user_id=$this->session->userdata('id');
		$this->id_pegawai=$this->session->userdata('id_pegawai');
	}
	public function index()
	{
		if ($this->role != 1) {
			redirect('welcome/data_kurir');
		}
		$data=array(
			'title'	=> 'Beranda',
		);
		$this->template->load('template', 'page/home', $data);
	}
/* 	public function dashboard(){

		$tahun = date('Y');
		
        $this->db->select('count(id) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('tipe !=',0);

        $data['rapat']  = $this->db->get('rapat')->result();

        $this->db->select('count(kunjungan.id) as total');
        // $this->db->limit($rowperpage, $start);
        // $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan !=', 3);
        $this->db->where('jenis_kunjungan  !=',0);
        $this->db->where('YEAR(awal_waktu_pelaksanaan)', $tahun);
        $data['kunker']  = $this->db->get('kunjungan')->result();

        $this->db->select('count(kunjungan.id) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
		$this->db->where('tipe_kunjungan', 3);
        $this->db->where('jenis_kunjungan  !=',0);

        $this->db->where('YEAR(awal_waktu_pelaksanaan)', $tahun);
        $data['sidak']  = $this->db->get('kunjungan')->result();
		$data['title'] = 'Dashboard';
		$this->template->load('template', 'dashboard',$data);
	}
	*/	
	public function dashboard($tipeMenu="")
	{
		$data['title'] = 'Dashboard '.ucwords($tipeMenu);
		if($tipeMenu=='rapat'){
			$where = "is_rapat";
		}
		else if($tipeMenu=='kunjungan'){
			$where = "is_kunjungan";
		}
		else if($tipeMenu=='tinjauan'){
			$where = "is_tinjauan";
		}
		$data['tipeMenu'] = $tipeMenu;		
		if($tipeMenu!=""){
			$data['menu'] = $this->Admin_model->menu([$where => '1'])->result_array();
		}
		else{
			$data['rapat'] = $this->Admin_model->getData('id','rapat','','','')->num_rows();
			$data['kunjungan'] = $this->Admin_model->getData('id','kunjungan','',['tipe_kunjungan' => 1],'')->num_rows();
			$data['sidak'] = $this->Admin_model->getData('id','kunjungan','',['tipe_kunjungan' => 3],'')->num_rows();
		}
		$this->template->load('template', 'dashboard',$data);
	}
	public function between($date)
	{
		$start = $date." 00:00";
		$end = $date." 23:59";

		$between = "g.created_at between '$start' and '$end' ";

		return $between;
	}
	public function gallery($all="",$cat,$date)
	{
		$data['title'] = "Galeri - All";
		$data['galeri'] = $this->db->query("SELECT * FROM galery_rapat where ".$this->between($date)." ORDER BY id DESC ")->result();
		$this->template->load('template', 'page/galeri',$data);
	}
	public function galery(){
		$data['title'] = "Galeri";
		$this->template->load('template', 'page/galeriFolder');
	}
	public function galleryCategory($cat)
	{
		$field = "is_".$cat;
		$data['menu'] = $this->Admin_model->menu([$field => '1'])->result_array();
		$this->template->load('template', 'page/galeriTipe', $data);
	}
	public function gallerySub($dir,$tipe)
	{
		$field = "is_".$dir;
		$data['subMenu'] = $this->Admin_model->submenu([$field => '1','id_menu' => $tipe])->result_array();

		$this->template->load('template', 'page/galeriSub', $data);
	}
	public function galleryByDate($dir,$tipe,$sub="")
	{
		$data['url'] = base_url()."welcome/";
/* 		if($dir=='all'){
			$join = "join rapat on galery_rapat.id_rapat = rapat.id";
			$whereSub = $sub!="" ? "and rapat.sub_tipe_komisi = '$sub' " : "";
			$where = "rapat.tipe = '$tipe'";

			$data['dir'] = $this->db->query("select DATE_FORMAT(galery_rapat.Created_At,'%Y-%m-%d') as date from galery_rapat $join where $where group by date ")->result_array();
			$data['url'].="gallery/$dir";
		}
 */
		$join = "join kunjungan on galery_rapat.id_rapat = kunjungan.id";
		$whereSub = $sub!="" ? "and kunjungan.sub_jenis_kunjungan = '$sub' " : "";
		$where = "kunjungan.jenis_kunjungan = '$tipe' ".$whereSub;

		if($dir=='rapat'){
			$join = "join rapat on galery_rapat.id_rapat = rapat.id";
			$whereSub = $sub!="" ? "and rapat.sub_tipe_komisi = '$sub' " : "";
			$where = "rapat.tipe = '$tipe' ".$whereSub;

			$tableTipe = 1;
			$data['url'].="galery_rapat/$dir";
		}
		else if($dir=='kunjungan'){
			$tableTipe = 2;
			
			$data['url'].="galery_kunjungan/$dir";
		}
		else if($dir=='sidak'){
			$tableTipe = 3;

			$data['url'].="galery_sidak/$dir";
		}
		else if($dir=='tinjauan'){
			$tableTipe = 4;

			$data['url'].="galery_sidak/$dir";
		}
		$data['dir'] = $this->db->query("select DATE_FORMAT(galery_rapat.Created_At,'%Y-%m-%d') as date from galery_rapat $join WHERE $where and galery_rapat.tipe=$tableTipe group by date ")->result_array();

		$this->template->load('template', 'page/galeriByDate',$data);

	}
	public function galery_rapat($rapat="",$cat,$date){
	    $data['title'] = "Galeri - Rapat";
		$sub = isset($_GET['sub']) ? "r.sub_tipe_komisi = '$_GET[sub]' and" : "";

		$data['galeri'] = $this->db->query("SELECT g.*,r.title as nama FROM galery_rapat g join rapat r on g.id_rapat = r.id  WHERE r.tipe='$cat' and $sub ".$this->between($date)." and g.tipe=1 ORDER BY id DESC ")->result();
		$this->template->load('template', 'page/galeri',$data);
	}
	public function galery_kunjungan($kunjungan="",$cat,$date){
	    $data['title'] = "Galeri - Kunjungan";
		$sub = isset($_GET['sub']) ? "k.sub_jenis_kunjungan = '$_GET[sub]' and" : "";

		$data['galeri'] = $this->db->query("SELECT g.*, k.nama as nama FROM galery_rapat g join kunjungan k on g.id_rapat = k.id WHERE k.jenis_kunjungan = '$cat' and $sub ".$this->between($date)." and g.tipe=2 ORDER BY id DESC ")->result();
		$this->template->load('template', 'page/galeri',$data);
	}
	public function galery_sidak($sidak="",$cat,$date){
	    $data['title'] = "Galeri - Sidak";
		$sub = isset($_GET['sub']) ? "k.sub_jenis_kunjungan = '$_GET[sub]' and" : "";

		$data['galeri'] = $this->db->query("SELECT g.*, k.nama as nama FROM galery_rapat g join kunjungan k on g.id_rapat = k.id WHERE k.jenis_kunjungan = '$cat' and $sub ".$this->between($date)." and g.tipe=3 ORDER BY id DESC ")->result();
		$this->template->load('template', 'page/galeri',$data);
	}
	public function add_product()
	{
		if ($this->role != 1) {
			redirect('welcome/data_kurir');
		}
		$data=array(
			'title'	=> 'Tambah Produk',
		);
		$this->template->load('template', 'page/add_product', $data);
	}
	public function save_product()
	{
		$kode=$this->input->post('kode');
		$notes=$this->input->post('notes');
		$month=$this->input->post('month');
		$date=$this->input->post('date');
		if (count($kode) == 0) {
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			for ($i=0; $i < count($kode); $i++) { 
				$cek=$this->db->where('barcode_number', $kode[$i])->where('month', $month)->get('barcodes')->num_rows();
				if ($cek == 0) {
					$data=array(
						'barcode_number'	=> $kode[$i],
						'month'	=> $month,
						'date_in'	=> $date,
						'notes'	=> $notes[$i],
					);
					$this->db->insert('barcodes', $data);
				}
			}
		}
		redirect('welcome');
	}
	public function delete_product($id)
	{
		if ($this->role != 1) {
			redirect('welcome/data_kurir');
		}
		$product=$this->db->where('id', $id)->get('barcodes')->row();
		if ($product != null) {
			$product=$this->db->where('id', $id)->delete('barcodes');
		}
		redirect('welcome');
	}
	public function json(){
		header('Content-Type: application/json');
		echo $this->Admin_model->json();
	}
	public function kurir_load()
	{
		if ($this->role != 1) {
			redirect('welcome/data_kurir');
		}
		$data=array(
			'title'	=> 'Bawaan Kurir',
		);
		$this->template->load('template', 'page/kurir_load', $data);
	}
	public function add_kurir_load()
	{
		$pegawai=$this->db->select('tbl_pegawai.*')->join('users', 'users.id_pegawai=tbl_pegawai.id_pegawai')->get('tbl_pegawai')->result();
		
		$data=array(
			'pegawai'	=> $pegawai,
			'title'	=> 'Tambah Bawaan Kurir',
		);
		$this->template->load('template', 'page/add_kurir_load', $data);
	}
	public function getBarcode(){
		$barcode=$this->input->post('barcode');
		$month=$this->input->post('month');
        $data=array();
        if ($this->input->post('month')) {
        	$data=$this->db->where('barcode_number', $barcode)->where('month', $month)->get('barcodes')->row();
        }
        echo json_encode($data);
	}
	public function suggestCode(){
        $key=$this->input->get('q');
        $data=array();
        if ($this->input->get('q')) {
        	// $data=$this->db->like('name', $key)->or_like('barcode_number', $key)->where('status', 0)->limit(15)->get('barcodes')->result();
        	$data=$this->db->query("SELECT * FROM `barcodes` WHERE id NOT IN (SELECT barcode_id FROM save_kurir_d) AND name LIKE '%".$key."%' OR barcode_number LIKE '%".$key."%'")->result();
        }
        echo json_encode($data);
	}
	public function save_kurir_load()
	{
		$user_id= $this->session->userdata('id');
		$id_pegawai=$this->input->post('id_pegawai');
		$barcode_id=$this->input->post('barcode_id');
		$date=$this->input->post('date');
		if (count($barcode_id) == 0) {
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data=array('user_id' => $user_id, 'id_pegawai' => $id_pegawai, 'send_date' => $date);
			$this->db->insert('save_kurir', $data);
			$id=$this->db->insert_id();
			for ($i=0; $i < count($barcode_id); $i++) { 
				$data1=array(
					'barcode_id'		=> $barcode_id[$i],
					'save_kurir_id'		=> $id
				);
				$this->db->insert('save_kurir_d', $data1);
			}
		}
		redirect('welcome/kurir_load');
	}
	public function json_kurir_load(){
		header('Content-Type: application/json');
		echo $this->Admin_model->json_kurir_load();
	}
	public function json_kurir_load_d($id){
		header('Content-Type: application/json');
		echo json_encode($this->Admin_model->json_kurir_load_d($id));
	}
	public function data_kurir(){
		$data=array(
			'title'	=> 'Data Kurir',
		);
		$this->template->load('template', 'page/data_kurir', $data);
	}
	public function json_data_kurir(){
		header('Content-Type: application/json');
		echo $this->Admin_model->json_data_kurir($this->id_pegawai);
	}
	public function updateStatusDeliver($id){
		$this->Admin_model->updateStatusDeliver($id);
		redirect('welcome/data_kurir');
	}
	public function list_pengiriman(){
		$data=array(
			'title'	=> 'List Pengiriman',
		);
		$this->template->load('template', 'page/list_pengiriman', $data);
	}
	public function list_pengiriman_json(){
		header('Content-Type: application/json');
		echo $this->Admin_model->list_pengiriman_json();
	}
	public function print_surat($id)
	{
		$detail=$this->Admin_model->detail_kurir_load_d($id);
		$data['detail']=$detail;
		$this->load->view('page/print_surat', $data);
	}
	public function delete_kurir_load($id)
	{
		$this->db->where('id', $id)->delete('save_kurir');
		redirect('welcome/kurir_load');
	}
	public function scan_deliver()
	{
		$pegawai=$this->db->select('tbl_pegawai.*')->join('users', 'users.id_pegawai=tbl_pegawai.id_pegawai')->get('tbl_pegawai')->result();
		
		$data=array(
			'pegawai'	=> $pegawai,
			'title'	=> 'Scan Deliver',
			'id_pegawai'	=> $this->id_pegawai
		);
		
		$this->template->load('template', 'page/scan_deliver_form', $data);
	}
	public function getKurirLoad(){
		$barcode=$this->input->post('barcode');
		$month=$this->input->post('month');
        $data=array();
        if ($this->input->post('month')) {
			$data=$this->db->where('barcode_number', $barcode)
							->where('save_kurir_d.status', 0)
							->join('save_kurir_d', 'save_kurir_d.barcode_id=barcodes.id')
							->where('barcodes.month', $month)
							->get('barcodes')
							->row();
        }
        echo json_encode($data);
	}
	public function update_kurir_load()
	{
		$user_id= $this->session->userdata('id');
		$id_pegawai=$this->input->post('id_pegawai');
		$barcode_id=$this->input->post('barcode_id');
		$date=$this->input->post('date');
		$notes=$this->input->post('notes');
		if (count($barcode_id) == 0) {
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			for ($i=0; $i < count($barcode_id); $i++) { 
				if ($notes[$i] == 'Dikirim') {
					$this->db->where('id', $barcode_id[$i])->update('save_kurir_d', ['status' => 1, 'delivered_date' => $date]);
				}else{
					$this->db->where('id', $barcode_id[$i])->delete('save_kurir_d');
				}
			}
		}
		redirect('welcome/data_kurir');
	}
	public function print_report()
	{
		$data_pegawai=$this->db->get('tbl_pegawai')->result();
		$data=array(
			'title'	=> 'Beranda',
			'data_pegawai'	=> $data_pegawai,
			'id_pegawai'	=> $this->id_pegawai
		);
		$this->template->load('template', 'page/choose_print_report', $data);
	}
	public function print_report_detail()
	{
		$id_pegawai=$this->input->post('id_pegawai');
		$date=$this->input->post('date');

		$detail=$this->Admin_model->detail_report($id_pegawai, $date);
		$data=array(
			'title'	=> 'Beranda',
			'detail'	=> $detail,
			'pegawai'	=> $this->db->where('id_pegawai', $id_pegawai)->get('tbl_pegawai')->row()
		);
		
		$this->load->view('page/print_report_detail', $data);
	}
	public function add_partai()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('partai', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function add_badan()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('badan', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function badan_option()
	{
		$dt=$this->db->get('badan')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function partai_option()
	{
		$dt=$this->db->get('partai')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function add_fraksi()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('fraksi', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function fraksi_option()
	{
		$dt=$this->db->get('fraksi')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function add_komisi()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('komisi', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function komisi_option()
	{
		$dt=$this->db->get('komisi')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function add_bamus()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('bamus', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function bamus_option()
	{
		$dt=$this->db->get('bamus')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function add_banggar()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('banggar', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function banggar_option()
	{
		$dt=$this->db->get('banggar')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	
	
		public function add_bk()
	{
		$data=array(
			'nama'	=> $this->input->post('nama')
		);
		$this->Admin_model->insert_table('bk', $data);
		$id=$this->db->insert_id();
		return $id;
	}
	public function bk_option()
	{
		$dt=$this->db->get('bk')->result();
		$data=array(
			'data'	=> $dt
		);
		echo json_encode($data);
	}
	public function add_anggota()
	{
		$data = array(
            'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
    		'priority' => $this->input->post('priority',TRUE),
            'jk' => $this->input->post('jk',TRUE),
            'tipe' => $this->input->post('tipe',TRUE),
       );
		$insert=$this->Tbl_pegawai_model->insert($data);
		echo 1;
	}
}
