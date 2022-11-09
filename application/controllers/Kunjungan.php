<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller {
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
		if(empty($_GET['jenis'])){
			$title = "Semua Kunjungan";
		}
		else{
			if(isset($_GET['sub'])){
				//sub
				$getTitle = $this->Admin_model->submenu(['id_sub_menu' => $_GET['sub']])->row();
				$title = "Kunjungan ".$getTitle->sub_menu;
			}
			else{
				//menu
				$getTitle = $this->Admin_model->menu(['id_menu' => $_GET['jenis']])->row();
				$title = "Kunjungan ".$getTitle->menu;
			}
		}
		$data=array(
			'title'	=> $title,
		);
		$this->template->load('template', 'kunjungan/index', $data);
	}
	
	public function pimpinan()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_pimpinan', $data);
	}

	public function anggota()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_anggota', $data);
	}

	public function komisi()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_komisi', $data);
	}

	public function bamus()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_bamus', $data);
	}

	public function banggar()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_banggar', $data);
	}

	public function bamperda()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_bamperda', $data);
	}

	public function bk()
	{
		$data=array(
			'title'	=> 'Kunjungan',
		);
		$this->template->load('template', 'kunjungan/kunjungan_bk', $data);
	}

	public function kunjungan_json1(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_pimpinan();
	}
	public function kunjungan_json2(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_anggota();
	}
	public function kunjungan_json3(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_komisi();
	}
	public function kunjungan_json4(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_bamus();
	}
	public function kunjungan_json5(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_banggar();
	}
	public function kunjungan_json6(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_bamperda();
	}
	public function kunjungan_json7(){
		header('Content-Type: application/json');
		echo $this->Admin_model->kunjungan_json_bk();
	}

	public function tahun($isSub="")
	{
		if($isSub!=""){
			$data=[];
			$sub = $this->Admin_model->submenu(['id_menu'=>$_GET['id_menu'],'is_kunjungan' => '1'])->result_array();
			foreach ($sub as $value) {
				$kunjungan = array(
					'jenis' => 'Kunjungan '.$value['sub_menu'],
					'jumlah' => $this->Admin_model->countSubJenisKunjungan($value['id_sub_menu']),
					'absensi' => $this->Admin_model->countAbsensiKunjunganBySub($value['id_sub_menu']),
					'url' => base_url()."kunjungan?jenis=$_GET[id_menu]&sub=$value[id_sub_menu]"
				);
				array_push($data,$kunjungan);
			}
		}
		else{
			$menu = $this->Admin_model->menu(['id_menu'=>$_GET['id_menu'],'is_kunjungan' => '1'])->result_array();
			$data[0] = array(
				'jenis' => 'Kunjungan '.$menu[0]['menu'],
				'jumlah' => $this->Admin_model->countJenisKunjungan($menu[0]['id_menu']),
				'absensi' => $this->Admin_model->countAbsensiKunjungan($menu[0]['id_menu']),
				'url' => base_url()."kunjungan?jenis=".$menu[0]['id_menu']
			);
		}
		$param=array(
			'title'	=> 'Kunjungan',
			'data' => $data
		);
		$this->template->load('template', 'kunjungan/kunjungan_tahun', $param);
	}
	public function add()
	{
		$data=array(
			'title'	=> 'Tambah Kunjungan',
			'menuKunjungan' => $this->Admin_model->menu(['is_kunjungan' => '1'])->result_array(),
			'pegawai' => $this->Admin_model->getData('id_pegawai,nama_pegawai','tbl_pegawai','','','')->result_array()
		);
		$this->template->load('template', 'kunjungan/add_kunjungan', $data);
    }
	public function getSubMenu()
	{
		$subMenuKunjungan = $this->Admin_model->submenu(['is_kunjungan' => '1','id_menu' => $_GET['id_menu']])->result_array();
		echo json_encode($subMenuKunjungan);

	}
    public function addDetailnama()
	{
		$this->load->view("kunjungan/loop-detail", ['now' => $_GET['counting'], 'start' => 0, 'tipe' => 1]);
	}
    public function addDetailnama2()
	{
		$this->load->view("kunjungan/loop-detail", ['now' => $_GET['counting'], 'start' => 0, 'tipe' => 2]);
	}
	public function anggota_kunjungan($id, $tipe)
	{
		$anggota_kunjungan = $this->Admin_model->anggota_kunjungan_by_tipe($id, $tipe);
		$data=array(
			'data'	=> $anggota_kunjungan
		);
		echo json_encode($data);
	}
    public function add_action()
	{
        $data=array(
            'nama'     =>$this->input->post('title'),
            'awal_waktu_pelaksanaan'       => $this->formatDate($this->input->post('tanggal')),
            'ahir_waktu_pelaksanaan'       => $this->formatDate($this->input->post('tanggal')),
            'waktu'     =>$this->input->post('waktu'),
            'tipe_kunjungan'      =>$this->input->post('tipe'),
            'id_sub_tipe_kunjungan'     =>$this->input->post('sub_tipe'),
            'jenis_kunjungan'      =>$this->input->post('jenis'),
			'sekretaris' => $_POST['sekretaris'],
			'pelapor' => $_POST['pelapor']
        );
		if(isset($_POST['sub_jenis'])){
			$data['sub_jenis_kunjungan'] = $_POST['sub_jenis'];
		}
        $this->Admin_model->insert_table('kunjungan', $data);
		$id=$this->db->insert_id();
		if(isset($_POST['id_anggota'])){
			$id_anggota=$this->input->post('id_anggota');
			foreach($id_anggota as $row){
				$data=array(
					'id_kunjungan'     =>$id,
					'id_pegawai'     =>$row,
				);
				$this->Admin_model->insert_table('anggota_kunjungan', $data);
			}
		}
		$sekretaris=array(
			'id_kunjungan'     =>$id,
			'id_pegawai'     =>$_POST['sekretaris'],
			'jabatan_kunjungan' => 4
		);
		$this->Admin_model->insert_table('anggota_kunjungan', $sekretaris);
		
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
				'tipe'		=>2,
				'file'        => $row,
			);
			$this->Admin_model->insert_table('galery_rapat', $data);
		}
        redirect('absensi');
    }
    public function kunjungan_json(){
		header('Content-Type: application/json');
		$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
		$sub = isset($_GET['sub']) ? $_GET['sub'] : '';

		echo $this->Admin_model->kunjungan_json($jenis,$sub);
	}
	public function kunjungantahun_json(){
		header('Content-Type: application/json');
		 // POST data
		 $postData = $this->input->post();
		 // Get data
		 $data = $this->Admin_model->getkunjungantahun($postData);
		 echo json_encode($data);
	}
    public function sub_tipe()
	{
        $dt=$this->db->get('sub_tipe_kunjungan')->result();
		$data=array(
			'data'	=> $dt,
		);
		echo json_encode($data);
    }
    public function add_sub_tipe()
	{
        $data=array(
            'nama'  => $this->input->post('nama')
        );
        $this->Admin_model->insert_table('sub_tipe_kunjungan', $data);
        echo 1;
    }
    private function formatDate($date){
        $date=date('Y-m-d', strtotime($date));
        return $date;
    }
    public function tinjau($id) 
    {
        $row_kunjungan = $this->Admin_model->get_table_by_id('kunjungan', $id);
        $sub_tipe=$this->db->where('id', $row_kunjungan->id_sub_tipe_kunjungan)->get('sub_tipe_kunjungan')->row();
		$pegawai = $this->Admin_model->getData('id_pegawai,nama_pegawai','tbl_pegawai','','','')->result_array();
        if ($row_kunjungan) {
            $data = array(
                'action' => site_url('kunjungan/tinjau_action'),
                'row_kunjungan' => $row_kunjungan,
                'sub_tipe'  => $sub_tipe,
				'title' => 'Tinjau Kunjungan',
				'pegawai' => $pegawai
			);
            $this->template->load('template','kunjungan/tinjau_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kunjungan'));
        }
    }
    public function save_tinjauan()
	{
		//update rapat
		$update=array(
			'dasar'	=> $this->input->post('dasar'),
			'undangan'	=> $this->input->post('undangan'),
			'tujuan'	=> $this->input->post('tujuan'),
			'materi'	=> $this->input->post('materi'),
            'hasil'	=> $this->input->post('hasil'),
            'saran'	=> $this->input->post('saran'),
            'kesimpulan'	=> $this->input->post('kesimpulan'),
            'penutup'	=> $this->input->post('penutup'),
			'lain'	=> $this->input->post('lain'),
			'pelapor'	=> $this->input->post('pelapor'),
			'pimpinan'	=> $this->input->post('pimpinan'),
			'wakil_ketua1'	=> $this->input->post('wakil_ketua1'),
			'wakil_ketua2'	=> $this->input->post('wakil_ketua2'),
			'is_edit'	=> $this->input->post('is_edit'),
        );
        
		$this->db->where('id', $this->input->post('id'))->update('kunjungan', $update);

		$this->db->where(['id_kunjungan' => $this->input->post('id'), 'jabatan_kunjungan !=' => 4])->update('anggota_kunjungan', array('jabatan_kunjungan' => 5));

		if($this->input->post('pimpinan') != null){
			$this->db->where('id_kunjungan', $this->input->post('id'))->where('id_pegawai', $this->input->post('pimpinan'))->update('anggota_kunjungan', array('jabatan_kunjungan' => 1));
		}
		if($this->input->post('wakil_ketua1') != null){
			$this->db->where('id_kunjungan', $this->input->post('id'))->where('id_pegawai', $this->input->post('wakil_ketua1'))->update('anggota_kunjungan', array('jabatan_kunjungan' => 2));
		}
		if($this->input->post('wakil_ketua2') != null){
			$this->db->where('id_kunjungan', $this->input->post('id'))->where('id_pegawai', $this->input->post('wakil_ketua2'))->update('anggota_kunjungan', array('jabatan_kunjungan' => 3));
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
			$this->db->where('id', $row)->update('anggota_kunjungan', $data);
		}

/* 		if($this->input->post('pelapor') != null){
		$pelapor = array(
			'id_kunjungan' => $this->input->post('id'),
			'nama' => $this->input->post('pelapor'),
			'absen' => 3
		);
		$this->db->insert('daftar_dewan', $pelapor);
		}
		foreach ($_POST['nama'] as $key => $value) {
			$data = [
				'id_kunjungan' => $this->input->post('id'),
				'nama' => $this->input->post('nama')[$key],
				'absen' => $this->input->post('absen')[$key]
			];
			$this->db->insert('daftar_dewan', $data);
		}
 */


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
				'tipe'		=>2,
				'file'        => $row,
			);
			$this->Admin_model->insert_table('galery_rapat', $data);
		}
		
		if(isset($_POST['is_sidak'])){
			redirect('sidak');
		}
		else{
			redirect('kunjungan');
		}
    }
    public function word($id,$word="true")
	{
		if($word=='true'){
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=laporan kunjungan.doc");
		}

		$row_kunjungan = $this->Admin_model->get_table_by_id('kunjungan', $id);
		$sub_tipe = $this->db->where('id', $row_kunjungan->id_sub_tipe_kunjungan)->get('sub_tipe_kunjungan')->row();
		$dt = $this->Admin_model->get_absensi($id);
		$pengikut = $this->db->query("SELECT * FROM absensi WHERE id_kunjungan='$id' AND id_pegawai!=0")->result();
		$countPengikut = $this->db->query("SELECT * FROM absensi WHERE id_kunjungan='$id' AND id_pegawai!=0")->num_rows();
		$pengikut2 = $this->db->query("SELECT * FROM absensi WHERE id_kunjungan='$id' AND id_pegawai=0")->row_array();
		$data = array(
			'row_kunjungan' => $row_kunjungan,
			'sub_tipe'  => $sub_tipe,
			'anggota'   => $this->Admin_model->getData('tp.id_pegawai,tp.nama_pegawai','anggota_kunjungan ak',['tbl_pegawai tp','ak.id_pegawai = tp.id_pegawai'],['ak.id_kunjungan' => $id],'')->result(),
			'pengikut'   => $pengikut,
			'pengikut2' => $pengikut2,
			'count' => $countPengikut,
			'sekretaris' => $this->Admin_model->getSekretarisKunjungan($id)->result_array()[0],
			'galery' => $this->Admin_model->galery_rapat($id),
			'pelapor' => $this->Admin_model->getData('nama_pegawai,ttd,nip','tbl_pegawai','',['id_pegawai' => $row_kunjungan->pelapor],'')->row(),
		);
		$this->load->view('kunjungan/export_laporan', $data);
	}
	public function word_absensi($id)
	{
		// header("Content-type: application/vnd.ms-word");
		// header("Content-Disposition: attachment;Filename=daftar hadir.doc");

		$row_kunjungan = $this->Admin_model->get_table_by_id('kunjungan', $id);
		$sub_tipe = $this->db->where('id', $row_kunjungan->id_sub_tipe_kunjungan)->get('sub_tipe_kunjungan')->row();
		$dt = $this->Admin_model->get_absensi($id);
		// $anggota_kunjungan = $this->Admin_model->anggota_kunjungan($id);
		$anggota_kunjungan = $this->Admin_model->getData("ak.id, ak.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ak.status, ak.jabatan","anggota_kunjungan ak",["tbl_pegawai tp","tp.id_pegawai=ak.id_pegawai"],["id_kunjungan" => $id,"tp.tipe" => $_GET['id_tipe']],"")->result();

		$data = array(
			'row_kunjungan' => $row_kunjungan,
			'sub_tipe'  => $sub_tipe,
			'anggota'   => $dt,
			'anggota_kunjungan'   => $anggota_kunjungan,
			'sekretaris' => $this->Admin_model->getSekretarisKunjungan($id)->row(),
			'tipe_pegawai' => $this->Admin_model->getData("*","tipe_pegawai","",['id_tipe' => $_GET['id_tipe']],'')->row()
		);
		$this->load->view('kunjungan/export_daftar_hadir', $data);
	}
    public function word_hearing($id)
    {
        // header("Content-type: application/vnd.ms-word");
        // header("Content-Disposition: attachment;Filename=laporan hearing.doc");

        $row_kunjungan = $this->Admin_model->get_table_by_id('kunjungan', $id);
        $sub_tipe=$this->db->where('id', $row_kunjungan->id_sub_tipe_kunjungan)->get('sub_tipe_kunjungan')->row();
        $dt=$this->Admin_model->get_absensi($id);
        $pengikut = $this->db->query("SELECT * FROM daftar_dewan WHERE id_kunjungan='$id'")->result();
        $data = array(
            'row_kunjungan' => $row_kunjungan,
            'sub_tipe'  => $sub_tipe,
            'anggota'   => $dt,
            'pengikut'  => $pengikut
        );
        $this->load->view('kunjungan/export_laporan_hearing', $data);
    }
    public function delete($id)
	{
		$data=array(
			'deleted_at'	=> date('Y-m-d H:i:s')
		);
		$this->db->update('kunjungan', $data);
		redirect('kunjungan');
    }
    public function get_absensi($id)
    {
        $dt=$this->Admin_model->get_absensi($id);
        $data = array(
            'data' => $dt
        );
        echo json_encode($data);
    }
}
