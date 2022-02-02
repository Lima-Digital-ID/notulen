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
        $this->load->model('hrms/Tbl_jabatan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->location_id = $this->session->userdata('location_id');
        $this->role= $this->session->userdata('role');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    public function index()
    {
		$where = isset($_GET['tipe']) ? ['id_tipe' => $_GET['tipe']] : '';
		$tipe_pegawai = $this->Admin_model->getData('*','tipe_pegawai','',$where,'')->result_array();

		$tipe = isset($_GET['tipe']) ? $tipe_pegawai[0]['tipe'] : '';

        $data['title']=$tipe;
        
        $this->template->load('template','hrms/pegawai/tbl_pegawai_list', $data);
    } 

    public function index_dprd()
    {   
        $data['title']='Anggota DPRD';
        $this->template->load('template','hrms/pegawai/tbl_dprd_list', $data);
    }

    public function index_vertical()
    {   
        $data['title']='Anggota Mitra Kerja VERTICAL';
        $this->template->load('template','hrms/pegawai/tbl_non_dprd_list', $data);
    }

    public function index_horizontal()
    {   
        $data['title']='Anggota Mitra Kerja HORIZONTAL';
        $this->template->load('template','hrms/pegawai/tbl_non_dprd_list', $data);
    }
    public function index_forkompimda()
    {   
        $data['title']='Anggota Mitra Kerja FORKOMPIMDA';
        $this->template->load('template','hrms/pegawai/tbl_non_dprd_list', $data);
    }
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_pegawai_model->json($this->location_id,$_POST['id_tipe']);
    }

    public function json_dprd() {
        header('Content-Type: application/json');
        echo $this->Tbl_pegawai_model->json_dprd();
    }

    public function json_jabatan() {
        header('Content-Type: application/json');
        echo $this->Tbl_pegawai_model->json_jabatan();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
    	    'id_pegawai' => set_value('id_pegawai'),
    	    'nama_pegawai' => set_value('nama_pegawai'),
            'nip' => set_value('nip'),
            'nia' => set_value('nia'),
            'priority' => set_value('priority'),
            'tipe' => set_value('tipe'),
            'jenis_jabatan' => set_value('jenis_jabatan'),
            'jk' => set_value('jk'),
            'id_partai' => set_value('id_partai'),
            'id_fraksi' => set_value('id_fraksi'),
            'id_komisi' => set_value('id_komisi'),
            'id_bamus' => set_value('id_bamus'),
            'id_banggar' => set_value('id_banggar'),
            'id_badan' => set_value('id_badan'),
            'allJab' => $this->Tbl_jabatan_model->get_all(),
            'getTipe' => $this->Admin_model->getData('*','tipe_pegawai','','','')->result_array()
	    );
        $data['title']='Tambah Anggota';
        if($_GET['tipe']== '1'){
            $page = 'tbl_pegawai_form';
        }else if($_GET['tipe'] == '2'){
            $page = 'tbl_dprd_form';
        }else{
            $page = 'tbl_non_dprd_form';
        }
        $this->template->load('template',"hrms/pegawai/$page", $data);
    }


    public function getJenis()
    {
        $jenis = $this->Admin_model->getData('id_jenis,jenis','jenis_pegawai','',['id_tipe' => $_POST['id_tipe']],'')->result_array();

        echo json_encode($jenis);
    }
    public function create_action() 
    {
        // $this->_rules();

        
        $this->load->helper('string');
        $fileName = random_string('alnum', 16);
        
        $config['upload_path']          = './assets/images/upload-ttd/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 512;
        $config['file_name']             = $fileName;
        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('ttd'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        else
        {
            $path = $_FILES['ttd']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);            
            $fileName = $config['file_name'].".".$ext;
            $data = array(
                'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
                'nip' => $this->input->post('nip',TRUE),
                'nia' => $this->input->post('nia',TRUE),
                'tipe' => $this->input->post('tipe',TRUE),
                // 'jenis_jabatan' => $this->input->post(0,TRUE),
                'id_partai' => $this->input->post('id_partai',TRUE),
                'id_komisi' => $this->input->post('id_komisi',TRUE),
                'id_badan' => $this->input->post('id_badan',TRUE),
                'ttd' => $fileName
        );
            $this->Tbl_pegawai_model->insert($data);
            foreach ($_POST['id_jabatan']as $jab) {
                $getLastId = $this->db->select_max('id_pegawai')->from('tbl_pegawai')->get()->row();
                $insertJab = array(
                    'id_pegawai' => $getLastId->id_pegawai,
                    'id_jabatan' => $jab,
                );
                $this->db->insert('tbl_jabatan_pegawai', $insertJab);
            }
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pegawai?tipe='.$data['tipe']));
        }
        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
        // }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
                'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
                'nama_pegawai' => set_value('nama_pegawai', $row->nama_pegawai),
                'nip' => set_value('nip', $row->nip),
                'nia' => set_value('nia', $row->nia),
                'tipe' => set_value('tipe', $row->tipe),
                'jenis_jabatan' => set_value('jenis_jabatan', $row->jenis_jabatan),
                'id_partai' => set_value('id_partai', $row->id_partai),
                'id_komisi' => set_value('id_komisi', $row->id_komisi),
                'id_badan' => set_value('id_badan', $row->id_badan),
                'ttd' => $row->ttd,
                'getTipe' => $this->Admin_model->getData('*','tipe_pegawai','','','')->result_array()

	        );
            $data['title']='Update Anggota';
            $data['infoTtd'] = "Abaikan upload jika tidak ingin update tanda tangan";
            $this->template->load('template','hrms/pegawai/tbl_pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }
    
    public function update_action() 
    {
        // $this->_rules();

            $update = true;
            $data = array(
                'nama_pegawai' => $this->input->post('nama_pegawai',TRUE),
                'nip' => $this->input->post('nip',TRUE),
                'nia' => $this->input->post('nia',TRUE),
                'tipe' => $this->input->post('tipe',TRUE),
                'jenis_jabatan' => $this->input->post('jenis_jabatan',TRUE),
                'id_partai' => $this->input->post('id_partai',TRUE),
                'id_komisi' => $this->input->post('id_komisi',TRUE),
                'id_badan' => $this->input->post('id_badan',TRUE),
                'updated_at' => date("Y-m-d H:i:s",  time())
               );
               
            if($_FILES['ttd']['name']!=""){
                $this->load->helper('string');
                $fileName = random_string('alnum', 16);
                
                $config['upload_path']          = './assets/images/upload-ttd/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 512;
                $config['file_name']             = $fileName;
                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('ttd'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $update = false;
                    print_r($error);
                }
                else{
                    $path = $_FILES['ttd']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);            
                    $fileName = $config['file_name'].".".$ext;
                    
                    $data['ttd'] = $fileName;

                    $getOldFile = $this->Tbl_pegawai_model->get_by_id($this->input->post('id_pegawai', TRUE),"ttd");

                    unlink('./assets/images/upload-ttd/'.$getOldFile->ttd);
                }
            }

            if($update){
                   $this->Tbl_pegawai_model->update($this->input->post('id_pegawai', TRUE), $data);
                   $this->session->set_flashdata('message', 'Update Record Success');
                   redirect(site_url('pegawai?tipe='.$data['tipe']));
            }
        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('id_pegawai', TRUE));
        // } else {
        // }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pegawai_model->get_by_id($id);

        if ($row) {
            $this->db->delete('absensi',['id_pegawai'=>$id]);
            $this->db->delete('absensi_rapat',['id_pegawai'=>$id]);
            $this->db->delete('anggota_kunjungan',['id_pegawai'=>$id]);
            $this->db->delete('anggota_rapat',['id_pegawai'=>$id]);
            $this->db->delete('tbl_pegawai',['id_pegawai'=>$id]);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai?tipe='.$row->tipe));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function anggota_json($id = null)
    {
        if($id != null){
            $where = ['t.kategori' => $id];
        }
        $data = $this->Admin_model->getData('p.nama_pegawai,p.id_pegawai','tbl_pegawai p',['tipe_pegawai t','p.tipe = t.id_tipe'],$where,'')->result();
        $dt=array(
            'data'=>$data
        );
        echo json_encode($dt);
    }
    public function anggota_json_by_rapat()
    {
        $where = ['t.kategori' => $_GET['tipe_pegawai'], 'ar.id_rapat' => $_GET['id_rapat']];
        $data = $this->Admin_model->getData('p.nama_pegawai,p.id_pegawai','anggota_rapat ar',["tbl_pegawai p","ar.id_pegawai = p.id_pegawai",'tipe_pegawai t','p.tipe = t.id_tipe'],$where,'')->result();
        $dt=array(
            'data'=>$data
        );
        echo json_encode($dt);
    }

    public function _rules() 
    {
        
    // $this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim');
	// $this->form_validation->set_rules('nama_pegawai', 'nama pegawai', 'trim|required');
 //    // $this->form_validation->set_rules('priority', 'priority', 'trim|required');
	// $this->form_validation->set_rules('tipe', 'no hp', 'trim|required');
 //    // $this->form_validation->set_rules('id_partai', 'alamat tinggal', 'trim|required');
 //    // $this->form_validation->set_rules('id_jabatan', 'id jabatan', 'trim|required');
 //    $this->form_validation->set_rules('id_fraksi', 'tanggal mulai tugas', 'trim|required');
	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function import_excel(){
        $data['title']='Import Absensi';
        $this->template->load('template','hrms/pegawai/import_excel', $data);
    }
    
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = 'assets/import_excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
        $inputFileName = 'assets/import_excel/'.$fileName;
        
        // try {
        if (is_readable($inputFileName)) {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        }else{
            $this->session->set_flashdata('message', 'File Tidak Bisa Terbaca');
            $this->session->set_flashdata('message_type', 'danger');
            redirect($_SERVER['HTTP_REFERER']);
        }
        // } catch(Exception $e) {
        //     die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        // }
 
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        $data_existing = array();
        $error_data = false;
        $error_desc = '';
        $jmlsukses = 0;
        $jmlgagal = 0;

        for ($row = 1; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
            $data=array('nama_pegawai' => $rowData[0][0], 'id_fraksi' => date('Y-m-d'));
            $insert_pegawai=$this->db->insert('tbl_pegawai', $data);

            $id=$this->db->insert_id();

            $insert_user=$this->db->insert('users', array('username' => $rowData[0][0], 'password' => md5('password'), 'role' => 2, 'id_pegawai' => $id));
            // $data=$this->db->where('nama_pegawai', strtolower($rowData[0][0]))->get('tbl_pegawai')->row();
            print_r($data);            
        }
        //Hapus file import
        $this->load->helper("file");
        delete_files($config['upload_path']); 
        redirect(site_url('pegawai'));
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
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_partai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tipe);
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