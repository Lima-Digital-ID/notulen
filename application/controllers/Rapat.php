<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat extends CI_Controller {
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
		if(empty($_GET['tipe'])){
			$title = "Semua Rapat";
		}
		else{
			if(isset($_GET['sub'])){
				//sub
				$getTitle = $this->Admin_model->submenu(['id_sub_menu' => $_GET['sub']])->row();
				$title = "Rapat ".$getTitle->sub_menu;
			}
			else{
				//menu
				$getTitle = $this->Admin_model->menu(['id_menu' => $_GET['tipe']])->row();
				$title = "Rapat ".$getTitle->menu;
			}
		}

		$data=array(
			'title'	=> $title,
		);

		$this->template->load('template', 'rapat/rapat', $data);
	}

	public function jsonTipePegawai()
	{
		$tipe = $this->Admin_model->getData('*','tipe_pegawai','','','')->result();

		echo json_encode($tipe);
	}
    
    public function pimpinan()
	{
		$data=array(
			'title'	=> 'pimpinan',
		);
		$this->template->load('template', 'rapat/rapat_pimpinan', $data);
	}

	public function anggota()
	{
		$data=array(
			'title'	=> 'anggota',
		);
		$this->template->load('template', 'rapat/rapat_anggota', $data);
	}

	public function komisi()
	{
		$data=array(
			'title'	=> 'komisi',
		);
		$this->template->load('template', 'rapat/rapat_komisi', $data);
	}

	public function banggar()
	{
		$data=array(
			'title'	=> 'banggar',
		);
		$this->template->load('template', 'rapat/rapat_banggar', $data);
	}

	public function bamus()
	{
		$data=array(
			'title'	=> 'bamus',
		);
		$this->template->load('template', 'rapat/rapat_bamus', $data);
	}

	public function bamperda()
	{
		$data=array(
			'title'	=> 'bamperda',
		);
		$this->template->load('template', 'rapat/rapat_bamperda', $data);
	}

	public function bk()
	{
		$data=array(
			'title'	=> 'badan kehormatan',
		);
		$this->template->load('template', 'rapat/rapat_bk', $data);
	}

	public function sekwan()
	{
		$data=array(
			'title'	=> 'sekwan',
		);
		$this->template->load('template', 'rapat/rapat_sekwan', $data);
	}

	public function ujipublik()
	{
		$data=array(
			'title'	=> 'ujipublik',
		);
		$this->template->load('template', 'rapat/rapat_ujipublik', $data);
	}


	public function hearing()
	{
		$data=array(
			'title'	=> 'sekwan',
		);
		$this->template->load('template', 'rapat/rapat_hearing', $data);
	}

	



	public function bamus1(){
		$data=array(
			'title'	=> 'Rapat',
		);
		$this->template->load('template', 'rapat/rapat_bamus', $data);
	}



	public function rapat_json1(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_pimpinan();
	}

	public function rapat_json2(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_anggota();
	}

	public function rapat_json3(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_komisi();
	}

	public function rapat_json4(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_bamus();
	}

	public function rapat_json5(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_banggar();
	}
	public function rapat_json6(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_bamperda();
	}

	public function rapat_json7(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_bk();
	}
	public function rapat_json_sekwan(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_sekwan();
	}

	public function rapat_json9(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_ujipublik();
	}
	public function rapat_json10(){
		header('Content-Type: application/json');
		echo $this->Admin_model->rapat_json_hearing();
	}







	public function rapat_json(){
		header('Content-Type: application/json');
		$tipe = isset($_GET['tipe']) ? $_GET['tipe'] : '';
		$sub = isset($_GET['sub']) ? $_GET['sub'] : '';
		echo $this->Admin_model->rapat_json($tipe,$sub);
	}
	public function rapattahun_json(){
		header('Content-Type: application/json');
		 // POST data
		 $postData = $this->input->post();
		 // Get data
		 $data = $this->Admin_model->getrapattahun($postData);
		 echo json_encode($data);
	}
	public function add_rapat()
	{
		$data=array(
			'title'	=> 'Tambah Rapat',
			'menuRapat' => $this->Admin_model->menu(['is_rapat' => '1'])->result_array(),
		);
		$this->template->load('template', 'rapat/add_rapat', $data);
    }
	public function edit_rapat($id)
	{
		$data=array(
			'title'	=> 'Edit Rapat',
			'menuRapat' => $this->Admin_model->menu(['is_rapat' => '1'])->result_array(),
			'rapat' => $this->Admin_model->getData("*","rapat","",['id'=>$id],'','')->row(),
		);
		$data['subMenu'] = $this->Admin_model->submenu(['is_rapat' => '1','id_menu' => $data['rapat']->tipe])->result_array();
		$this->template->load('template', 'rapat/edit_rapat', $data);
    }
	public function getSubMenu()
	{
		$subMenuRapat = $this->Admin_model->submenu(['is_rapat' => '1','id_menu' => $_GET['id_menu']])->result_array();
		echo json_encode($subMenuRapat);

	}
    public function save_rapat()
	{
        $data=array(
            'title'     =>$this->input->post('title'),
            'tempat'        =>$this->input->post('tempat'),
            'tanggal'       => $this->formatDate($this->input->post('tanggal')),
            'waktu'     =>$this->input->post('waktu'),
            'tipe'      =>$this->input->post('tipe'),
            'sifat'     =>$this->input->post('sifat'),
            'event'     => empty($this->input->post('event')) ? "" : $this->input->post('event'),
            'lampiran'     =>$this->input->post('lampiran'),
		);
		if(isset($_POST['sekretaris'])){
			$data['sekretaris'] = $_POST['sekretaris'];
		}
		if(isset($_POST['sub_menu_komisi'])){
			$data['sub_tipe_komisi'] = $_POST['sub_menu_komisi'];
		}
		$this->Admin_model->insert_table('rapat', $data);

		$id=$this->db->insert_id();
		if(isset($_POST['id_anggota'])){
			$id_anggota=$this->input->post('id_anggota');
			foreach($id_anggota as $row){
				$data=array(
					'id_rapat'     =>$id,
					'id_pegawai'     =>$row,
				);
				$this->Admin_model->insert_table('anggota_rapat', $data);
			}
		}
		$sekretaris=array(
			'id_rapat'     =>$id,
			'id_pegawai'     =>$_POST['sekretaris'],
			'jabatan_rapat' => 4
		);
		$this->Admin_model->insert_table('anggota_rapat', $sekretaris);
		//save galery
		$image_name = [];
   
		$count = count($_FILES['files']['name']);

		for($i=0;$i<$count;$i++){
			$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
			
			$config['upload_path'] = 'assets/images/bukti_rapat'; //buat folder dengan nama assets di root folder
			$config['allowed_types'] = 'pdf|jpg|jpeg|png|gif|xls|xlsx|csv';
			
			$filename = $_FILES['file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            $newname='bukti_rapat_'.time().'.'.$ext;
			$config['file_name']= $newname;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
				$image_name[$i] = $imageData['file_name'];
			}
		}
		foreach($image_name as $row){
			$data=array(
				'id_rapat'     =>$id,
				'tipe'		=>1,
				'file'        => $row,
			);
			$this->Admin_model->insert_table('galery_rapat', $data);
		}
		redirect('absensi');
    }
	function update(){
		$id = $this->input->post('id_rapat');
        $data=array(
            'title'     =>$this->input->post('title'),
            'tempat'        =>$this->input->post('tempat'),
            'tanggal'       => $this->formatDate($this->input->post('tanggal')),
            'waktu'     =>$this->input->post('waktu'),
            'tipe'      =>$this->input->post('tipe'),
            'sifat'     =>$this->input->post('sifat'),
            'event'     => empty($this->input->post('event')) ? "" : $this->input->post('event'),
            'lampiran'     =>$this->input->post('lampiran'),
		);
		if(isset($_POST['sekretaris'])){
			$data['sekretaris'] = $_POST['sekretaris'];
		}
		if(isset($_POST['sub_menu_komisi'])){
			$data['sub_tipe_komisi'] = $_POST['sub_menu_komisi'];
		}
		$this->db->update('rapat', $data,['id' => $id]);

		$this->db->delete('anggota_rapat',['id_rapat' => $id]);
		if(isset($_POST['id_anggota'])){
			$id_anggota=$this->input->post('id_anggota');
			foreach($id_anggota as $row){
				$data=array(
					'id_rapat'     =>$id,
					'id_pegawai'     =>$row,
				);
				$this->Admin_model->insert_table('anggota_rapat', $data);
			}
		}
		$sekretaris=array(
			'id_rapat'     =>$id,
			'id_pegawai'     =>$_POST['sekretaris'],
			'jabatan_rapat' => 4
		);
		$this->Admin_model->insert_table('anggota_rapat', $sekretaris);
		redirect('absensi');

	}
    private function formatDate($date){
        $date=date('Y-m-d', strtotime($date));
        return $date;
	}
	public function delete_rapat($id)
	{
		$this->db->delete("absensi_rapat",['id_rapat' => $id]);
		$this->db->delete("anggota_rapat",['id_rapat' => $id]);
		$this->db->delete("galery_rapat",['id_rapat' => $id,'tipe' => 1]);
		$this->db->delete("rapat",['id' => $id]);
		$this->session->set_flashdata('successMsg', 'Rapat Berhasil Dihapus');
		redirect('rapat');
	}
	public function tinjau($id) 
    {
		$row_rapat = $this->Admin_model->get_table_by_id('rapat', $id);
		$anggota_rapat = $this->Admin_model->anggota_rapat($id);
		$galery_rapat = $this->Admin_model->galery_rapat($id);
        if ($row_rapat) {
            $data = array(
                'action' => site_url('rapat/tinjau_action'),
				'row_rapat' => $row_rapat,
				'anggota_rapat' => $anggota_rapat,
				'galery_rapat' => $galery_rapat,
				'title' => 'Tinjau Rapat'
			);
            $this->template->load('template','rapat/tinjau_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rapat'));
        }
	}
	public function save_tinjauan_rapat()
	{
		//update rapat
		$update=array(
			'acara'	=> $this->input->post('acara'),
			'dasar'	=> $this->input->post('dasar'),
			'undangan'	=> $this->input->post('undangan'),
			'isi_risalah'	=> $this->input->post('isi_risalah'),
			'hasil_kegiatan'	=> $this->input->post('hasil_kegiatan'),
			'pimpinan'	=> $this->input->post('pimpinan'),
			'wakil_ketua1'	=> $this->input->post('wakil_ketua1'),
			'wakil_ketua2'	=> $this->input->post('wakil_ketua2'),
			// 'is_edit'	=> $this->input->post('is_edit'),
		);
		$this->db->where('id', $this->input->post('id'))->update('rapat', $update);
		$this->db->where(['id_rapat' => $this->input->post('id'),'jabatan_rapat !=' => 4])->update('anggota_rapat', array('jabatan_rapat' => 5)); //anggota

		if($this->input->post('pimpinan') != null){
			$this->db->where('id_rapat', $this->input->post('id'))->where('id_pegawai', $this->input->post('pimpinan'))->update('anggota_rapat', array('jabatan_rapat' => 1)); //pimpinan
		}
		if($this->input->post('wakil_ketua1') != null){
			$this->db->where('id_rapat', $this->input->post('id'))->where('id_pegawai', $this->input->post('wakil_ketua1'))->update('anggota_rapat', array('jabatan_rapat' => 2));
		}
		if($this->input->post('wakil_ketua2') != null){
			$this->db->where('id_rapat', $this->input->post('id'))->where('id_pegawai', $this->input->post('wakil_ketua2'))->update('anggota_rapat', array('jabatan_rapat' => 3));
		}
		//update absensi
		$check_id=$this->input->post('check_id');
		$id_anggota=$this->input->post('id_detail');
		$keterangan=$this->input->post('keterangan');
		$jabatan=$this->input->post('jabatan');
		foreach($id_anggota as $key => $row){
			$absen=in_array($row, $check_id);
			$data=array(
				'status'	=> $absen,
				'keterangan'	=> $keterangan[$key],
				'jabatan'	=> $jabatan[$key],
			);
			$this->db->where('id', $row)->update('anggota_rapat', $data);
		}
		
		//save galery
		$image_name = [];
   
		$count = count($_FILES['files']['name']);

		for($i=0;$i<$count;$i++){
			$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
			
			$config['upload_path'] = 'assets/images/bukti_rapat'; //buat folder dengan nama assets di root folder
			$config['allowed_types'] = 'pdf|jpg|jpeg|png|gif|xls|xlsx|csv';
			
			$filename = $_FILES['file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            $newname='bukti_rapat_'.time().'.'.$ext;
			$config['file_name']= $newname;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
				$image_name[$i] = $imageData['file_name'];
			}
		}
		foreach($image_name as $row){
			$data=array(
				'id_rapat'     =>$this->input->post('id'),
				'file'        => $row,
			);
			$this->Admin_model->insert_table('galery_rapat', $data);
		}
		
		redirect('rapat');
	}
	public function get_galery($id)
	{
		$galery_rapat = $this->Admin_model->galery_rapat($id);
		$data=array(
			'data'	=> $galery_rapat
		);
		echo json_encode($data);
	}
	public function delete_galery($id)
	{
		$galery_rapat = $this->db->where('id', $id)->get('galery_rapat')->row();
		$path='assets/images/bukti_rapat/'.$galery_rapat->file;
		if(file_exists($path)){
			unlink($path);
		}
		$delete = $this->db->where('id', $id)->delete('galery_rapat');
		echo $delete;
	}
	public function word($id,$word="true")
    {
		if($word=="true"){
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=risalah rapat.doc");
		}

        $row_rapat = $this->Admin_model->get_table_rapat_by_id($id);
		$anggota_rapat = $this->Admin_model->anggota_rapat($id);
		$group_anggota = $this->Admin_model->group_anggota($id);
		$data = array(
			'row_rapat' => $row_rapat,
			'anggota_rapat' => $anggota_rapat,
			'group_anggota' => $group_anggota,
		);
        $this->load->view('rapat/export_rapat_paripurna', $data);
	}
	public function preview($id)
    {
        $row_rapat = $this->Admin_model->get_table_rapat_by_id($id);
		$anggota_rapat = $this->Admin_model->anggota_rapat($id);
		$group_anggota = $this->Admin_model->group_anggota($id);
		$data = array(
			'row_rapat' => $row_rapat,
			'anggota_rapat' => $anggota_rapat,
			'group_anggota' => $group_anggota,
		);
        $this->load->view('rapat/export_rapat_paripurna', $data);
	}
	public function word_bamus($id,$word="true")
    {
		if($word=="true"){
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=notulen kegiatan.doc");
		}

		$row_rapat = $this->Admin_model->get_table_by_id('rapat', $id);
		$anggota_rapat = $this->Admin_model->anggota_rapat_order_jabatan($id);
		$data = array(
			'row_rapat' => $row_rapat,
			'anggota_rapat' => $anggota_rapat,
			'sekretaris' => $this->Admin_model->getSekretarisRapat($id)->result_array()[0],
			'galery' => $this->Admin_model->galery_rapat($id),
		);
		// echo json_encode($anggota_rapat);
       $this->load->view('rapat/export_rapat_bamus', $data);
	}
	public function anggota_rapat($id, $tipe)
	{
		$anggota_rapat = $this->Admin_model->anggota_rapat_by_tipe($id, $tipe);
		$data=array(
			'data'	=> $anggota_rapat
		);
		echo json_encode($data);
	}
	
	public function upload_galeri(){
	    //save galery
	    $id = $this->input->post('id');
		$image_name = [];
   
		$count = count($_FILES['files']['name']);

		for($i=0;$i<$count;$i++){
			$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
			
			$config['upload_path'] = 'assets/images/bukti_rapat'; //buat folder dengan nama assets di root folder
			$config['allowed_types'] = 'pdf|jpg|jpeg|png|gif|xls|xlsx|csv';
			
			$filename = $_FILES['file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            $newname='bukti_rapat_'.time().'.'.$ext;
			$config['file_name']= $newname;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
				$image_name[$i] = $imageData['file_name'];
			}
		}
		foreach($image_name as $row){
			$data=array(
				'id_rapat'     => $id,
				'file'        => $row,
			);
			$this->Admin_model->insert_table('galery_rapat', $data);
		}
		
		redirect('rapat');
	    
	}
	public function daftar_hadir($id)
    {
		if(isset($_GET['word'])){
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=daftar_hadir.doc");
		}
		$row_rapat = $this->Admin_model->get_table_by_id('rapat', $id);
		$anggota_rapat = $this->Admin_model->getData("ar.id, ar.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ar.status, ar.jabatan","anggota_rapat ar",["tbl_pegawai tp","tp.id_pegawai=ar.id_pegawai"],["id_rapat" => $id,"tp.tipe" => $_GET['id_tipe']],"")->result();
		$data = array(
			'row_rapat' => $row_rapat,
			'anggota_rapat' => $anggota_rapat,
			'sekretaris' => $this->Admin_model->getSekretarisRapat($id)->result_array()[0],
			'tipe_pegawai' => $this->Admin_model->getData("*","tipe_pegawai","",['id_tipe' => $_GET['id_tipe']],'')->result_array()[0]
		);
        $this->load->view('rapat/export_daftar_hadir', $data);
	}
	public function getloc()
	{
		$getloc = json_decode(file_get_contents("http://ipinfo.io/"));

 		echo json_encode($getloc); //to get city
	}
	public function upload(){
		print_r($_FILES['webcam']['name']);exit;
		$config['upload_path'] = 'assets/images'; //buat folder dengan nama assets di root folder
		$config['allowed_types'] = 'pdf|jpg|jpeg|png|gif|xls|xlsx|csv';
		
		$filename = $_FILES['webcam']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		$newname=time().'.'.$ext;
		$config['file_name']= $newname;

		// Load and initialize upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		// Upload file to server
		if($this->upload->do_upload('webcam')){
			$imageData = $this->upload->data();
			print_r($imageData);
		}
	}
	public function tahun($isSub="")
	{
		if($isSub!=""){
			$data=[];
			$sub = $this->Admin_model->submenu(['id_menu'=>$_GET['id_menu'],'is_rapat' => '1'])->result_array();		
			foreach ($sub as $value) {
				$rapat = array(
					'jenis' => 'Rapat '.$value['sub_menu'],
					'jumlah' => $this->Admin_model->countSubJenisRapat($value['id_sub_menu']),
					'absensi' => $this->Admin_model->countAbsensiRapatBySub($value['id_sub_menu']),
					'url' => base_url()."rapat?tipe=$_GET[id_menu]&sub=$value[id_sub_menu]"
				);
				array_push($data,$rapat);
			}
		}
		else{
			$menu = $this->Admin_model->menu(['id_menu'=>$_GET['id_menu'],'is_rapat' => '1'])->result_array();
			$data[0] = array(
				'jenis' => 'Rapat '.$menu[0]['menu'],
				'jumlah' => $this->Admin_model->countJenisRapat($menu[0]['id_menu']),
				'absensi' => $this->Admin_model->countAbsensiRapat($menu[0]['id_menu']),
				'url' => base_url()."rapat?tipe=".$menu[0]['id_menu']
			);
		}
		$param=array(
			'title'	=> 'Rapat',
			'data' => $data
		);

		$this->template->load('template', 'rapat/semua-rapat', $param);
	}
}
