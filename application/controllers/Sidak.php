<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidak extends CI_Controller {
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
			$title = "Semua Sidak";
		}
		else{
			if(isset($_GET['sub'])){
				//sub
				$getTitle = $this->Admin_model->submenu(['id_sub_menu' => $_GET['sub']])->row();
				$title = "Sidak ".$getTitle->sub_menu;
			}
			else{
				//menu
				$getTitle = $this->Admin_model->menu(['id_menu' => $_GET['jenis']])->row();
				$title = "Sidak ".$getTitle->menu;
			}
		}

		$data=array(
			'title'	=> $title,
		);
		$this->template->load('template', 'sidak/index', $data);
	}
    public function pimpinan()
	{
		$data=array(
			'title'	=> 'Tinjauan',
		);
		$this->template->load('template', 'sidak/sidak_pimpinan', $data);
	}

	public function anggota()
	{
		$data=array(
			'title'	=> 'Sidak',
		);
		$this->template->load('template', 'sidak/sidak_anggota', $data);
	}

	public function komisi()
	{
		$data=array(
			'title'	=> 'Sidak',
		);
		$this->template->load('template', 'sidak/sidak_komisi', $data);
	}

	public function bamus()
	{
		$data=array(
			'title'	=> 'Sidak',
		);
		$this->template->load('template', 'sidak/sidak_bamus', $data);
	}
	public function bk()
	{
		$data=array(
			'title'	=> 'Sidak',
		);
		$this->template->load('template', 'sidak/sidak_bk', $data);
	}

	public function bampeda()
	{
		$data=array(
			'title'	=> 'Sidak',
		);
		$this->template->load('template', 'sidak/sidak_bampeda', $data);
	}
	
	public function sidak_json1(){
		header('Content-Type: application/json');
		echo $this->Admin_model->sidak_json_pimpinan();
	}

	public function sidak_json2(){
		header('Content-Type: application/json');
		echo $this->Admin_model->sidak_json_anggota();
	}

	public function sidak_json3(){
		header('Content-Type: application/json');
		echo $this->Admin_model->sidak_json_komisi();
	}

	public function sidak_json4(){
		header('Content-Type: application/json');
		echo $this->Admin_model->sidak_json_bamus();
	}

	public function sidak_json5(){
		header('Content-Type: application/json');
		echo $this->Admin_model->sidak_json_bk();
	}

	public function sidak_json6(){
		header('Content-Type: application/json');
		echo $this->Admin_model->sidak_json_bamperda();
	}
	
	public function sidaktahun($isSub="")
	{
		if($isSub!=""){
			$data=[];
			$sub = $this->Admin_model->submenu(['id_menu'=>$_GET['id_menu'],'is_tinjauan' => '1'])->result_array();
			foreach ($sub as $value) {
				$sidak = array(
					'jenis' => 'Tinjauan Lapangan '.$value['sub_menu'],
					'jumlah' => $this->Admin_model->countSubJenisSidak($value['id_sub_menu']),
					'absensi' => $this->Admin_model->countAbsensiSidakBySub($value['id_sub_menu']),
					'url' => base_url()."sidak?jenis=$_GET[id_menu]&sub=$value[id_sub_menu]"
				);
				array_push($data,$sidak);
			}
		}
		else{
			$menu = $this->Admin_model->menu(['id_menu'=>$_GET['id_menu'],'is_tinjauan' => '1'])->result_array();
			$data[0] = array(
				'jenis' => 'Tinjauan Lapangan '.$menu[0]['menu'],
				'jumlah' => $this->Admin_model->countJenisSidak($menu[0]['id_menu']),
				'absensi' => $this->Admin_model->countAbsensiSidak($menu[0]['id_menu']),
				'url' => base_url()."sidak?jenis=".$menu[0]['id_menu']
			);

		}

		$param=array(
			'title'	=> 'Sidak',
			'data' => $data
		);
		$this->template->load('template', 'sidak/sidak_tahun', $param);
	}
	public function add()
	{
		$data=array(
			'title'	=> 'Tambah Sidak',
			'menuTinjauan' => $this->Admin_model->menu(['is_tinjauan' => '1'])->result_array(),
		);
		$this->template->load('template', 'sidak/add_sidak', $data);
    }
	public function getSubMenu()
	{
		$subMenuTinjauan = $this->Admin_model->submenu(['is_tinjauan' => '1','id_menu' => $_GET['id_menu']])->result_array();
		echo json_encode($subMenuTinjauan);

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
        );
		if(isset($_POST['sub_jenis'])){
			$data['sub_jenis_kunjungan'] = $_POST['sub_jenis'];
		}
        $this->Admin_model->insert_table('kunjungan', $data);
        $id=$this->db->insert_id();
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
				'tipe'		=>3,
				'file'        => $row,
			);
			$this->Admin_model->insert_table('galery_rapat', $data);
		}
        redirect('absensi');
    }
    public function sidak_json(){
		header('Content-Type: application/json');
		$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
		$sub = isset($_GET['sub']) ? $_GET['sub'] : '';

		echo $this->Admin_model->sidak_json($jenis,$sub);
	}
    public function kunjungantahun_json(){
		header('Content-Type: application/json');
		 // POST data
		 $postData = $this->input->post();
		 // Get data
		 $data = $this->Admin_model->getkunjungantahun($postData);
		 echo json_encode($data);
	}
    public function sidaktahun_json(){
		header('Content-Type: application/json');
		 // POST data
		 $postData = $this->input->post();
		 // Get data
		 $data = $this->Admin_model->getsidaktahun($postData);
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
        if ($row_kunjungan) {
            $data = array(
                'action' => site_url('kunjungan/tinjau_action'),
                'row_kunjungan' => $row_kunjungan,
                'sub_tipe'  => $sub_tipe,
				'title' => 'Tinjau Sidak'
			);
            $this->template->load('template','sidak/tinjau_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Sidak'));
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
			'is_edit'	=> $this->input->post('is_edit'),
        );
        
		$this->db->where('id', $this->input->post('id'))->update('kunjungan', $update);
		
		redirect('Sidak');
    }
    public function word($id,$word="true")
    {
		if($word=='true'){
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment;Filename=laporan kunjungan.doc");
		}

        $row_kunjungan = $this->Admin_model->get_table_by_id('kunjungan', $id);
        $sub_tipe=$this->db->where('id', $row_kunjungan->id_sub_tipe_kunjungan)->get('sub_tipe_kunjungan')->row();
        $dt=$this->Admin_model->get_absensi($id);
        $data = array(
            'row_kunjungan' => $row_kunjungan,
            'sub_tipe'  => $sub_tipe,
            'anggota'   => $dt
        );
        $this->load->view('sidak/export_laporan', $data);
    }
    public function word_hearing($id)
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=laporan hearing.doc");

        $row_kunjungan = $this->Admin_model->get_table_by_id('kunjungan', $id);
        $sub_tipe=$this->db->where('id', $row_kunjungan->id_sub_tipe_kunjungan)->get('sub_tipe_kunjungan')->row();
        $dt=$this->Admin_model->get_absensi($id);
        $data = array(
            'row_kunjungan' => $row_kunjungan,
            'sub_tipe'  => $sub_tipe,
            'anggota'   => $dt
        );
        $this->load->view('sidak/export_laporan_hearing', $data);
    }
    public function delete($id)
	{
		$data=array(
			'deleted_at'	=> date('Y-m-d H:i:s')
		);
		$this->db->update('kunjungan', $data);
		redirect('Sidak');
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
