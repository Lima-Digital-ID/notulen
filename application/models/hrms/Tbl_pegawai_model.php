<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pegawai_model extends CI_Model
{

    public $table = 'tbl_pegawai';
    public $id = 'id_pegawai';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($location_id,$idTipe="") {
        $this->datatables->select('id_pegawai,  nama_pegawai,  tipe, p.nama as nama_partai, k.nama as nama_komisi, b.nama as nama_badan');
        $this->datatables->from('tbl_pegawai tp');
        $this->datatables->join('partai p', 'p.id=tp.id_partai', 'left');
        $this->datatables->join('komisi k', 'k.id=tp.id_komisi', 'left');
        $this->datatables->join('badan b', 'b.id=tp.id_badan', 'left');
        $this->datatables->where('tipe',$idTipe);

        $this->datatables->add_column('action', anchor(site_url('pegawai/update/$1'),'<i class="fa fa-edit" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm', 'title' => 'Edit Pegawai'))." 
                ".anchor(site_url('pegawai/delete/$1'),'<i class="fa fa-trash" aria-hidden="true"></i>','class="btn btn-danger btn-sm" title = "Hapus Pegawai" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_pegawai');
        return $this->datatables->generate();
    }

        function json_dprd() 
        {
            $this->datatables->select('id_pegawai,  nama_pegawai, p.nama as nama_partai, k.nama as nama_komisi, b.nama as nama_badan');
            $this->datatables->from('tbl_pegawai tp');
            $this->datatables->join('partai p', 'p.id=tp.id_partai', 'left');
            $this->datatables->join('komisi k', 'k.id=tp.id_komisi', 'left');
            $this->datatables->join('badan b', 'b.id=tp.id_badan', 'left');

            $this->datatables->add_column('action', anchor(site_url('pegawai/update/$1'),'<i class="fa fa-edit" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm', 'title' => 'Edit Pegawai'))." 
                    ".anchor(site_url('pegawai/delete_dprd/$1'),'<i class="fa fa-trash" aria-hidden="true"></i>','class="btn btn-danger btn-sm" title = "Hapus Pegawai" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_pegawai');
            return $this->datatables->generate();
        }

    // get all
    function get_all($location_id)
    {
        $this->db->order_by($this->id, $this->order);
        if ($location_id != null) {
            $this->datatables->where('location_id', $location_id);
        }
        return $this->db->get($this->table)->result();
    }
    
    function get_all_jaga($id_klinik = null)
    {
        // $this->db->order_by($this->id, $this->order);
        $this->db->from('tbl_dokter');
        $this->db->join('tbl_user','tbl_dokter.id_dokter=tbl_user.id_dokter', 'left');
        $this->db->where('is_jaga', 1);
        if($id_klinik != null)
            $this->db->where('tbl_user.id_klinik', $id_klinik);
            
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id,$select="")
    {
        if($select!=""){
            $this->db->select($select);
        }
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    //get by no_pendaftaran
    function get_by_no_pendaftaran($id, $no_pendaftaran)
    {
        $this->db->where($this->id, $id);
        $this->db->where('no_pendaftaran', $no_pendaftaran);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_dokter', $q);
	$this->db->or_like('nama_dokter', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('id_agama', $q);
	$this->db->or_like('alamat_tinggal', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('id_status_menikah', $q);
	$this->db->or_like('id_spesialis', $q);
	$this->db->or_like('no_izin_praktek', $q);
	$this->db->or_like('golongan_darah', $q);
	$this->db->or_like('alumni', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_dokter', $q);
	$this->db->or_like('nama_dokter', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('id_agama', $q);
	$this->db->or_like('alamat_tinggal', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('id_status_menikah', $q);
	$this->db->or_like('id_spesialis', $q);
	$this->db->or_like('no_izin_praktek', $q);
	$this->db->or_like('golongan_darah', $q);
	$this->db->or_like('alumni', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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

}

/* End of file Tbl_dokter_model.php */
/* Location: ./application/models/Tbl_dokter_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-27 18:45:56 */
/* http://harviacode.com */