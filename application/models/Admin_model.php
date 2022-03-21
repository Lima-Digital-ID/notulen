<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public $table = 'admin';
    public $id = 'adm_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insert_table($table, $data)
    {
        $this->db->insert($table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function json(){
        $this->datatables->select('id, barcode_number, notes, month, date_in, status, created_at');
        $this->datatables->from('barcodes');
        return $this->datatables->generate();
    }
      function kunjungan_json_pimpinan(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan =', '1');
        $this->datatables->where('k.jenis_kunjungan =', '1');
        return $this->datatables->generate();
    }
    function kunjungan_json_anggota(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $this->datatables->where('k.jenis_kunjungan =', '2');
        return $this->datatables->generate();
    }
    function kunjungan_json_komisi(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $this->datatables->where('k.jenis_kunjungan =', '3');
        return $this->datatables->generate();
    }
    function kunjungan_json_bamus(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $this->datatables->where('k.jenis_kunjungan =', '4');
        return $this->datatables->generate();
    }
    function kunjungan_json_banggar(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $this->datatables->where('k.jenis_kunjungan =', '5');
        return $this->datatables->generate();
    }
    function kunjungan_json_bamperda(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $this->datatables->where('k.jenis_kunjungan =', '6');
        return $this->datatables->generate();
    }
    function kunjungan_json_bk(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $this->datatables->where('k.jenis_kunjungan =', '7');
        return $this->datatables->generate();
    }
    function kunjungan_json($jenis,$sub){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe, k.jenis_kunjungan');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        if($jenis!=""){
            $this->datatables->where('k.jenis_kunjungan',$jenis);
        }
        if($sub!=""){
            $this->datatables->where('k.sub_jenis_kunjungan',$sub);
        }

        $this->db->order_by('k.updated_at','desc');
        return $this->datatables->generate();
    }

    function sidak_json($jenis,$sub){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe, k.jenis_kunjungan');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', 3);
        if($jenis!=""){
            $this->datatables->where('k.jenis_kunjungan',$jenis);
        }
        if($sub!=""){
            $this->datatables->where('k.sub_jenis_kunjungan',$sub);
        }

        $this->db->order_by('k.updated_at','desc');

        return $this->datatables->generate();
    }
    
    
    function sidak_json_pimpinan(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, jenis_kunjungan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan','3');
        $this->datatables->where('k.jenis_kunjungan','1');
        return $this->datatables->generate();
    }

    function sidak_json_anggota(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', '3');
        $this->datatables->where('k.jenis_kunjungan', '2');
        return $this->datatables->generate();
    }

    function sidak_json_komisi(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', '3');
        $this->datatables->where('k.jenis_kunjungan', '3');
        return $this->datatables->generate();
    }

    function sidak_json_bamus(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', '3');
        $this->datatables->where('k.jenis_kunjungan', '4');
        return $this->datatables->generate();
    }

    function sidak_json_bk(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', '3');
        $this->datatables->where('k.jenis_kunjungan', '5');
        return $this->datatables->generate();
    }
  

    function sidak_json_bamperda(){
        $this->datatables->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->datatables->from('kunjungan k');
        $this->datatables->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->datatables->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', '3');
        $this->datatables->where('k.jenis_kunjungan', '6');
        return $this->datatables->generate();
    }
    
    function get_absensi($id){
        $dt=$this->db->where('id_kunjungan', $id)
                        ->join('tbl_pegawai tp', 'tp.id_pegawai=absensi.id_pegawai')
                        ->get('absensi')->result();
        return $dt;
    }
    function kunjungan_harian_json($id){
        $date=date('Y-m-d');
        $this->db->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->db->from('kunjungan k');
        // $this->db->where('k.awal_waktu_pelaksanaan <=', $date);
        // $this->db->where('k.ahir_waktu_pelaksanaan >=', $date);
        $this->db->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->db->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan !=', 3);
        $data=$this->db->get()->result();
        foreach($data as $row){
            $cek=$this->db->where('id_pegawai', $id)->where('id_kunjungan', $row->id)->like('waktu', $date)->get('absensi')->num_rows();
            $row->cek=$cek;
        }
        return $data;
    }
    function rapat_harian_json($id)
    {
        $date = date('Y-m-d');
        $this->db->select('r.id, waktu, tanggal, is_edit, r.title, tipe, m.menu, r.tempat');
        $this->db->from('rapat r');
        $this->db->join('menu m','r.tipe = m.id_menu');
        // $this->db->where('r.tanggal >=', $date);
        $this->db->where('r.deleted_at', null);
        $data = $this->db->get()->result();
        foreach ($data as $row) {
            $cek = $this->db->where('id_pegawai', $id)->like('waktu', $date)->get('absensi')->num_rows();
            $row->cek = $cek;
        }
        return $data;
    }
    function sidak_harian_json($id){
        $date=date('Y-m-d');
        $this->db->select('k.id, waktu, awal_waktu_pelaksanaan, ahir_waktu_pelaksanaan, is_edit, k.nama, tipe_kunjungan, st.nama as sub_tipe');
        $this->db->from('kunjungan k');
        // $this->db->where('k.awal_waktu_pelaksanaan <=', $date);
        // $this->db->where('k.ahir_waktu_pelaksanaan >=', $date);
        $this->db->join('sub_tipe_kunjungan st', 'st.id=k.id_sub_tipe_kunjungan');
        $this->db->where('k.deleted_at', null);
        $this->datatables->where('k.tipe_kunjungan', 3);
        $data=$this->db->get()->result();
        foreach($data as $row){
            $cek=$this->db->where('id_pegawai', $id)->where('id_kunjungan', $row->id)->like('waktu', $date)->get('absensi')->num_rows();
            $row->cek=$cek;
        }
        return $data;
    }
    function rapat_json($tipe,$sub,$id_rapat){
        $this->datatables->select("id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at,(select count(*) ttl from anggota_rapat where id_rapat = r.id) ttl_anggota, (select count(*) ttl from absensi_rapat where id_rapat = r.id) ttl_absen");
        $this->datatables->from('rapat r');
        // $this->datatables->where('deleted_at', null);
        if($tipe!=""){
            $this->datatables->where('tipe',$tipe);
        }
        if($sub!=""){
            $this->datatables->where('sub_tipe_komisi',$sub);
        }
        if($id_rapat!=""){
            $this->datatables->where('r.id',$id_rapat);
        }
        $this->db->order_by('updated_at','desc');
        return $this->datatables->generate();
    }
    
    function rapat_json_pimpinan($db=false){
        if($db){
         $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', '2');
        $this->datatables->where('sub_tipe_komisi', '2');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }

    function rapat_json_anggota($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('rapat_jenis', '2');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_komisi($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 2);
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_bamus($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 3);
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    function rapat_json_banggar($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 4);
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_bamperda($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 2);
        $this->datatables->where('sub_tipe_komisi','1');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_bk($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        // $this->datatables->where('tipe', 2);
        $this->datatables->where('sub_tipe_komisi','3');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_hearing($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 2);
        $this->datatables->where('sub_tipe_komisi', '4');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_ujipublik($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 2);
        $this->datatables->where('sub_tipe_komisi', '5');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }
    
    function rapat_json_sekwan($db=false){
        if($db){
            $this->datatables = $this->db;   
        }
        $this->datatables->select('id, tanggal, waktu, title, event, tipe, sifat, tempat, is_edit, created_at, updated_at');
        $this->datatables->from('rapat');
        $this->datatables->where('tipe', 2);
        $this->datatables->where('sub_tipe_komisi', '6');
        if($db){
            return $this->datatables->get();
        }else{
            return $this->datatables->generate();
        }
    }


    function get_table_by_id($table, $id)
    {
        $this->db->where('id', $id);
        return $this->db->get($table)->row();
    }

    function get_table_rapat_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->join('tbl_pegawai tp1', 'tp1.id_pegawai=r.pimpinan', 'left');
        $this->db->join('tbl_pegawai tp2', 'tp2.id_pegawai=r.wakil_ketua1', 'left');
        $this->db->join('tbl_pegawai tp3', 'tp3.id_pegawai=r.wakil_ketua2', 'left');
        $this->db->join('tbl_pegawai tp4', 'tp4.id_pegawai=r.sekretaris', 'left');
        $this->db->select('r.*, tp1.nama_pegawai as ketua, tp2.nama_pegawai as wakil_ketua1, tp3.nama_pegawai as wakil_ketua2, tp4.nama_pegawai as sekretaris');
        return $this->db->get('rapat r')->row();
    }

    function anggota_rapat_by_tipe($id, $tipe){
        return $this->db->where('id_rapat', $id)
        ->join('tbl_pegawai tp', 'tp.id_pegawai=ar.id_pegawai')
        ->select('ar.id, ar.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ar.status, ar.jabatan')
        ->where('tp.tipe', $tipe)
        ->get('anggota_rapat ar')->result();
    }
    function anggota_kunjungan_by_tipe($id, $tipe){
        return $this->db->where('id_kunjungan', $id)
        ->join('tbl_pegawai tp', 'tp.id_pegawai=ak.id_pegawai')
        ->select('ak.id, ak.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ak.status, ak.jabatan')
        ->where('tp.tipe', $tipe)
        ->get('anggota_kunjungan ak')->result();
    }
    function group_anggota($id){
        $get_fraksi=$this->db->where('id_rapat', $id)
                ->where('tp.tipe', 1)
                ->join('tbl_pegawai tp', 'tp.id_pegawai=ar.id_pegawai')
                ->join('fraksi f', 'tp.id_fraksi=f.id', 'left')
                ->select('id_fraksi, max(f.nama) as nama_fraksi')
                ->group_by('id_fraksi')
                ->get('anggota_rapat ar')->result();
        foreach($get_fraksi as $row){
            $get_anggota=$this->db->where('id_rapat', $id)
                ->where('tp.tipe', 1)
                ->join('tbl_pegawai tp', 'tp.id_pegawai=ar.id_pegawai')
                ->where('id_fraksi', $row->id_fraksi)
                ->select('tp.*, ar.status, ar.keterangan, ar.jabatan, ar.jabatan_rapat')
                ->get('anggota_rapat ar')->result();
            $row->detail=$get_anggota;
        }
        return $get_fraksi;
    }
    function anggota_rapat($id){
        return $this->db->where('id_rapat', $id)
        ->join('tbl_pegawai tp', 'tp.id_pegawai=ar.id_pegawai')
        ->select('ar.id, ar.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ar.status, ar.jabatan')
        ->get('anggota_rapat ar')->result();
    }
    function anggota_kunjungan($id){
        return $this->db->where('id_kunjungan', $id)
        ->join('tbl_pegawai tp', 'tp.id_pegawai=ak.id_pegawai')
        ->select('ak.id, ak.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ak.status, ak.jabatan')
        ->get('anggota_kunjungan ak')->result();
    }

    function anggota_rapat_order_jabatan($id){
        return $this->db->where('id_rapat', $id)
        ->join('tbl_pegawai tp', 'tp.id_pegawai=ar.id_pegawai')
        ->select('ar.id, ar.keterangan, tp.id_pegawai, tp.tipe, tp.nama_pegawai, ar.status, ar.jabatan, ar.jabatan_rapat')
        ->order_by('ar.jabatan_rapat')
        ->get('anggota_rapat ar')->result();
    }

    function galery_rapat($id){
        return $this->db->where('id_rapat', $id)
        ->get('galery_rapat')->result();
    }

    function list_pengiriman_json(){
        $this->datatables->select('save_kurir_d.status, save_kurir_d.id, save_kurir.send_date, barcodes.created_at, save_kurir_d.delivered_date, barcodes.barcode_number, tbl_pegawai.nama_pegawai');
        $this->datatables->from('save_kurir');
        $this->datatables->join('save_kurir_d', 'save_kurir.id=save_kurir_d.save_kurir_id');
        $this->datatables->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=save_kurir.id_pegawai');
        $this->datatables->join('barcodes', 'barcodes.id=save_kurir_d.barcode_id');
        return $this->datatables->generate();
    }
    function json_kurir_load(){
        $this->datatables->select('save_kurir.id, save_kurir.send_date, users.username, tbl_pegawai.nama_pegawai, save_kurir.created_at');
        $this->datatables->from('save_kurir');
        $this->datatables->join('users', 'users.id=save_kurir.user_id');
        $this->datatables->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=save_kurir.id_pegawai');
        return $this->datatables->generate();
    }
    function json_kurir_load_d($id){
        $this->db->where('save_kurir_id', $id);
        $this->db->from('save_kurir_d');
        $this->db->select('save_kurir_d.status, save_kurir_d.id, save_kurir_d.created_at, barcodes.barcode_number, barcodes.created_at AS tgl_pickup');
        $this->db->join('barcodes', 'barcodes.id=save_kurir_d.barcode_id');
        return $this->db->get()->result();
    }
    function json_data_kurir($id){
        $this->datatables->select('save_kurir_d.status, save_kurir.send_date, save_kurir_d.id, save_kurir_d.created_at, save_kurir_d.delivered_date, barcodes.barcode_number, barcodes.month');
        $this->datatables->where('save_kurir.id_pegawai', $id);
        $this->datatables->from('save_kurir');
        $this->datatables->join('save_kurir_d', 'save_kurir.id=save_kurir_d.save_kurir_id');
        $this->datatables->join('barcodes', 'barcodes.id=save_kurir_d.barcode_id');
        return $this->datatables->generate();
    }
    function updateStatusDeliver($id){
        $this->db->where('id', $id);
        $this->db->update('save_kurir_d', array('delivered_date' => date('Y-m-d H:i:s'), 'status' => 1));
    }
    function detail_kurir_load_d($id){
        $this->db->where('save_kurir_id', $id);
        $this->db->from('save_kurir_d');
        $this->db->select('save_kurir_d.status, save_kurir.send_date, save_kurir_d.id, save_kurir_d.created_at, barcodes.*, barcodes.created_at AS tgl_pickup, tbl_pegawai.nama_pegawai');
        $this->db->join('barcodes', 'barcodes.id=save_kurir_d.barcode_id');
        $this->db->join('save_kurir', 'save_kurir_d.save_kurir_id=save_kurir.id');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=save_kurir.id_pegawai');
        return $this->db->get()->result();
    }
    function detail_report($id_pegawai, $date){
        $this->db->select('save_kurir_d.delivered_date, barcodes.*, save_kurir.send_date');
		$this->db->from('save_kurir');
		$this->db->join('save_kurir_d', 'save_kurir.id=save_kurir_d.save_kurir_id');
		$this->db->join('barcodes', 'barcodes.id=save_kurir_d.barcode_id');
		$this->db->where('save_kurir.id_pegawai', $id_pegawai);
		$this->db->like('save_kurir_d.delivered_date', $date);
		return $this->db->get()->result();
    }
    
     function getrapattahun($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tahun = $postData['tahun'];
        $tahunini = date('Y');




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        
        $this->db->where('deleted_at', null);
        $records  = $this->db->get('rapat')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('deleted_at', null);
        $this->db->where('Year(tanggal)', $tahun);
        $records  = $this->db->get('rapat')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->where('deleted_at', null);
        $this->db->where('Year(tanggal)', $tahun);
        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('rapat')->result();

        $this->db->select('*');
        $this->db->where('deleted_at', null);
        $this->db->where('Year(tanggal)', $tahunini);
        $this->db->limit($rowperpage, $start);
        $records2  = $this->db->get('rapat')->result();

        $data = array();
        if ($tahun ==  null) {
            foreach ($records2 as $record) {
                $data[] = array(
                    "title" => $record->title,
                    "tempat" => $record->tempat,
                    "tanggal" => $record->tanggal,
                    "tanggal" => $record->tanggal,
                    "waktu" => $record->waktu,
                    "tipe" => $record->tipe,
                    "id" => $record->id,
                );
            }
        } else {
            foreach ($records as $record) {
                $data[] = array(
                    "title" => $record->title,
                    "tempat" => $record->tempat,
                    "tanggal" => $record->tanggal,
                    "tanggal" => $record->tanggal,
                    "waktu" => $record->waktu,
                    "tipe" => $record->tipe,
                    "id" => $record->id,
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
        
    }

    function getkunjungantahun($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tahun = $postData['tahun'];
        $tahunini = date('Y');




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan !=', 3);
        $records  = $this->db->get('kunjungan')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan !=', 3);
        $this->db->where('Year(awal_waktu_pelaksanaan)', $tahun);
        $records  = $this->db->get('kunjungan')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('kunjungan.id, kunjungan.waktu, kunjungan.awal_waktu_pelaksanaan, kunjungan.ahir_waktu_pelaksanaan, kunjungan.is_edit, kunjungan.nama, kunjungan.tipe_kunjungan, sub_tipe_kunjungan.nama as sub_tipe');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan !=', 3);
        $this->db->where('Year(awal_waktu_pelaksanaan)', $tahun);
        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('kunjungan')->result();

        $this->db->select('*');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan !=', 3);
        $this->db->where('Year(awal_waktu_pelaksanaan)', $tahunini);
        $this->db->limit($rowperpage, $start);
        $records2  = $this->db->get('kunjungan')->result();

        $data = array();
        if ($tahun ==  null) {
            foreach ($records2 as $record) {
                $data[] = array(
                    "nama" => $record->nama,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "waktu" => $record->waktu,
                    "tipe_kunjungan" => $record->tipe_kunjungan,
                    "sub_tipe" => $record->sub_tipe,
                    "id" => $record->id,
                );
            }
        } else {
            foreach ($records as $record) {
                $data[] = array(
                    "nama" => $record->nama,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "waktu" => $record->waktu,
                    "tipe_kunjungan" => $record->tipe_kunjungan,
                    "sub_tipe" => $record->sub_tipe,
                    "id" => $record->id,
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
        
    }

    function getsidaktahun($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tahun = $postData['tahun'];
        $tahunini = date('Y');




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan', 3);
        $records  = $this->db->get('kunjungan')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan', 3);
        $this->db->where('Year(awal_waktu_pelaksanaan)', $tahun);
        $records  = $this->db->get('kunjungan')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('kunjungan.id, kunjungan.waktu, kunjungan.awal_waktu_pelaksanaan, kunjungan.ahir_waktu_pelaksanaan, kunjungan.is_edit, kunjungan.nama, kunjungan.tipe_kunjungan, sub_tipe_kunjungan.nama as sub_tipe');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan', 3);
        $this->db->where('Year(awal_waktu_pelaksanaan)', $tahun);
        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('kunjungan')->result();

        $this->db->select('*');
        $this->db->join('sub_tipe_kunjungan', 'sub_tipe_kunjungan.id=kunjungan.id_sub_tipe_kunjungan');
        $this->db->where('deleted_at', null);
        $this->db->where('tipe_kunjungan', 3);
        $this->db->where('Year(awal_waktu_pelaksanaan)', $tahunini);
        $this->db->limit($rowperpage, $start);
        $records2  = $this->db->get('kunjungan')->result();

        $data = array();
        if ($tahun ==  null) {
            foreach ($records2 as $record) {
                $data[] = array(
                    "nama" => $record->nama,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "waktu" => $record->waktu,
                    "tipe_kunjungan" => $record->tipe_kunjungan,
                    "sub_tipe" => $record->sub_tipe,
                    "id" => $record->id,
                );
            }
        } else {
            foreach ($records as $record) {
                $data[] = array(
                    "nama" => $record->nama,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "awal_waktu_pelaksanaan" => $record->awal_waktu_pelaksanaan,
                    "waktu" => $record->waktu,
                    "tipe_kunjungan" => $record->tipe_kunjungan,
                    "sub_tipe" => $record->sub_tipe,
                    "id" => $record->id,
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
        
    }

    public function getSekretarisRapat($id)
    {
        $this->db->select('p.nama_pegawai,p.ttd,p.nip');
        $this->db->from('rapat r');
        $this->db->join('tbl_pegawai p','r.sekretaris = p.id_pegawai');
        $this->db->where('r.id',$id);
        return $this->db->get();
    }
    public function getSekretarisKunjungan($id)
    {
        $this->db->select('p.nama_pegawai,p.ttd,p.nip');
        $this->db->from('kunjungan k');
        $this->db->join('tbl_pegawai p','k.sekretaris = p.id_pegawai');
        $this->db->where('k.id',$id);
        return $this->db->get();
    }

    public function countJenisRapat($tipe)
    {
        $this->db->select('id');
        $this->db->where('tipe',$tipe);
        // $this->db->where('year(tanggal)', date('Y'));
        return $this->db->get('rapat')->num_rows();
    }
    public function countSubJenisRapat($sub)
    {
        $this->db->select('id');
        $this->db->where('sub_tipe_komisi',$sub);
        // $this->db->where('year(tanggal)', date('Y'));
        return $this->db->get('rapat')->num_rows();
    }
    public function countAbsensiRapat($tipe)
    {
        $this->db->select('a.id');
        $this->db->join('rapat r','a.id_rapat = r.id');
        $this->db->where('r.tipe',$tipe);
        // $this->db->where('year(r.tanggal)', date('Y'));
        return $this->db->get('absensi_rapat a')->num_rows();
    }
    public function countAbsensiRapatBySub($sub)
    {
        $this->db->select('a.id');
        $this->db->join('rapat r','a.id_rapat = r.id');
        $this->db->where('r.sub_tipe_komisi',$sub);
        // $this->db->where('year(r.tanggal)', date('Y'));
        return $this->db->get('absensi_rapat a')->num_rows();
    }
    public function countJenisKunjungan($jenis)
    {
        $this->db->select('id');
        $this->db->where('tipe_kunjungan !=',3);
        $this->db->where('jenis_kunjungan',$jenis);
        // $this->db->where('year(awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('kunjungan')->num_rows();
    }
    public function countSubJenisKunjungan($sub)
    {
        $this->db->select('id');
        $this->db->where('tipe_kunjungan !=',3);
        $this->db->where('sub_jenis_kunjungan',$sub);
        // $this->db->where('year(awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('kunjungan')->num_rows();
    }
    public function countAbsensiKunjungan($jenis)
    {
        $this->db->select('a.id');
        $this->db->join('kunjungan k','a.id_kunjungan = k.id');
        $this->db->where('k.tipe_kunjungan !=',3);
        $this->db->where('k.jenis_kunjungan',$jenis);
        // $this->db->where('year(k.awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('absensi a')->num_rows();
    }
    public function countAbsensiKunjunganBySub($sub)
    {
        $this->db->select('a.id');
        $this->db->join('kunjungan k','a.id_kunjungan = k.id');
        $this->db->where('k.tipe_kunjungan !=',3);
        $this->db->where('k.sub_jenis_kunjungan',$sub);
        // $this->db->where('year(k.awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('absensi a')->num_rows();
    }
    public function countJenisSidak($jenis)
    {
        $this->db->select('id');
        $this->db->where('tipe_kunjungan',3);
        $this->db->where('jenis_kunjungan',$jenis);
        // $this->db->where('year(awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('kunjungan')->num_rows();
    }
    public function countSubJenisSidak($sub)
    {
        $this->db->select('id');
        $this->db->where('tipe_kunjungan',3);
        $this->db->where('sub_jenis_kunjungan',$sub);
        // $this->db->where('year(awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('kunjungan')->num_rows();
    }
    public function countAbsensiSidak($jenis)
    {
        $this->db->select('a.id');
        $this->db->join('kunjungan k','a.id_kunjungan = k.id');
        $this->db->where('k.tipe_kunjungan',3);
        $this->db->where('k.jenis_kunjungan',$jenis);
        // $this->db->where('year(k.awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('absensi a')->num_rows();
    }
    public function countAbsensiSidakBySub($sub)
    {
        $this->db->select('a.id');
        $this->db->join('kunjungan k','a.id_kunjungan = k.id');
        $this->db->where('k.tipe_kunjungan',3);
        $this->db->where('k.sub_jenis_kunjungan',$sub);
        // $this->db->where('year(k.awal_waktu_pelaksanaan)', date('Y'));
        return $this->db->get('absensi a')->num_rows();
    }
    public function menu($where)
    {
        $this->db->select('id_menu,menu,is_sub');
        $this->db->from('menu');
        $this->db->where($where);
        $this->db->order_by('menu','asc');
        return $this->db->get();
    }
    public function submenu($where)
    {
        $this->db->select('id_sub_menu,sub_menu');
        $this->db->from('sub_menu');
        $this->db->where($where);
        $this->db->order_by('no_urut','asc');
        $this->db->order_by('sub_menu','asc');
        return $this->db->get();
    }
    public function countMenu($join,$where)
    {
        $this->db->select('id_menu,menu,COUNT(r.id) ttl');
        $this->db->from('menu m');
        $this->db->join($join[0],$join[1]);
        $this->db->where($where);
        $this->db->group_by('id_menu');
        return $this->db->get();
    }
    public function getData($select,$tb,$join,$filter,$order,$group_by="")
    {
        $sql = $this->db->select($select);

        if($join!="") {
            for($i=0;$i<count($join);$i++){
                if($i%2!=0){
                    $sql = $this->db->join($join[$i-1],$join[$i]);
                }
            }
        }

        if($group_by!=""){
            $this->db->group_by($group_by);
        }
        if($order!=""){
            if(is_array($order)){
                $sql = $this->db->order_by($order[0],$order[1]);
            }
            else{
                $sql = $this->db->order_by($order);
            }
        }
        if($filter!=""){
            $sql = $this->db->where($filter);
        }

        if(is_array($tb)){
            $sql = $this->db->get($tb[0],$tb[1],$tb[2]);
        }
        else{
            $sql = $this->db->get($tb);
        }

        return $sql;
    }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */