<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hrms_model extends CI_Model
{

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
    function insert_setting($table, $data)
    {
        $this->db->insert($table, $data);
    }

    // update data
    function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // delete data
    function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    
    function json_setting_gaji($location_id){
        $this->datatables->select('id_setting_gaji, gaji_pokok, gaji_min,  nama_jabatan, kom_min, kom_level, tbl_pegawai.nama_pegawai, tbl_jabatan.nama_jabatan, tbl_setting_gaji.id_setting_gaji, tipe_gaji, kom_trx, denda, denda_weekday, denda_weekend, bonus_kerajinan');
        $this->datatables->from('tbl_setting_gaji');
        $this->datatables->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_setting_gaji.id_pegawai');
        $this->datatables->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_pegawai.id_jabatan');
        if ($location_id != null) {
            $this->datatables->where('tbl_pegawai.location_id', $location_id);
        }
        $this->datatables->add_column('action', anchor(site_url('hrms/set_gaji/update/$1'),'<i class="fa fa-edit" aria-hidden="true"></i>','class="btn btn-success btn-sm"')." 
                ".anchor(site_url('hrms/set_gaji/delete/$1'),'<i class="fa fa-trash" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_setting_gaji');
            
        return $this->datatables->generate();
    }
    function get_setting_by_id($id)
    {
        $this->db->where('id_setting_gaji', $id);
        return $this->db->get('tbl_setting_gaji')->row();
    }
    // function json_setting_gaji($id_klinik){
    //     $this->db->select('tbl_setting_gaji.*, tbl_pegawai.nama_pegawai, tbl_jabatan.nama_jabatan, tbl_setting_gaji.id_setting_gaji');
    //     $this->db->from('tbl_setting_gaji');
    //     $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_setting_gaji.id_pegawai');
    //     $this->db->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_pegawai.id_jabatan');
    //     if ($id_klinik != null) {
    //         $this->db->where('tbl_pegawai.id_klinik', $id_klinik);
    //     }

    //     return $this->db->get()->result();
    // }

    function get_by_jabatan($id)
    {
        $this->db->where('id_jabatan', $id);
        return $this->db->get($this->table)->row();
    }
    function get_absensi($date, $id_klinik)
    {
        $this->db->select('tbl_absensi_pegawai.*, tbl_pegawai.nama_pegawai');
        $this->db->from('tbl_absensi_pegawai');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_absensi_pegawai.id_pegawai', 'right');
        $this->db->where('tanggal', date('Y-m-d'));
        if ($id_klinik != null) {
            $this->db->where('tbl_pegawai.id_klinik', $id_klinik);
        }
        return $this->db->get()->result();
    }
    function get_absensi_by_id_pegawai($id, $date)
    {
        $this->db->select('tbl_absensi_pegawai.*, tbl_pegawai.nama_pegawai');
        $this->db->from('tbl_absensi_pegawai');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_absensi_pegawai.id_pegawai');
        $this->db->where('tbl_pegawai.id_pegawai', $id);
        $this->db->where('tbl_absensi_pegawai.tanggal', $date);
        return $this->db->get()->row();
    }
    function get_absensi_pegawai_by_day($id, $date){
        $this->db->select('tbl_absensi_pegawai.*, tbl_pegawai.nama_pegawai');
        $this->db->from('tbl_absensi_pegawai');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_absensi_pegawai.id_pegawai', 'right');
        $this->db->where('tbl_pegawai.id_pegawai', $id);
        $this->db->where('tbl_absensi_pegawai.jam_datang !=', '00:00:00');
        $this->db->where('tbl_absensi_pegawai.jam_datang !=', NULL);
        $this->db->where('tbl_absensi_pegawai.tanggal', $date);
        return $this->db->get()->row();
    }

    function get_ket_absensi($id, $date){
        $this->db->select('tbl_absensi_pegawai.*, tbl_pegawai.nama_pegawai');
        $this->db->from('tbl_absensi_pegawai');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_absensi_pegawai.id_pegawai', 'right');
        $this->db->where('tbl_pegawai.id_pegawai', $id);
        $this->db->where('tbl_absensi_pegawai.tanggal', $date);
        return $this->db->get()->row();
    }

    function get_absensi_pegawai_by_month($id, $date){
        $this->db->select('tbl_absensi_pegawai.*, tbl_pegawai.nama_pegawai, tbl_shift.jam_datang as jadwal_datang_shift, tbl_shift.jam_pulang as jadwal_pulang_shift');
        $this->db->from('tbl_absensi_pegawai');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_absensi_pegawai.id_pegawai', 'left');
        $this->db->join('tbl_shift', 'tbl_shift.id_shift=tbl_absensi_pegawai.id_shift', 'left');
        $this->db->where('tbl_pegawai.id_pegawai', $id);
        $this->db->where('tbl_absensi_pegawai.jam_datang !=', '00:00:00');
        $this->db->like('tbl_absensi_pegawai.tanggal', $date, 'after');
        return $this->db->get()->result();
    }
    function get_gaji_by_pegawai($id){
        $this->db->select('*');
        $this->db->from('tbl_setting_gaji');
        $this->db->join('tbl_pegawai', 'tbl_pegawai.id_pegawai=tbl_setting_gaji.id_pegawai');
        $this->db->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_pegawai.id_jabatan');
        $this->db->join('business_locations', 'business_locations.id=tbl_pegawai.location_id');
        $this->db->where('tbl_pegawai.id_pegawai', $id);
        return $this->db->get()->row();
    }
    function get_potongan($id, $date){
        $this->db->select('potongan_bpjs, cicilan, kasbon, komisi_langsung');
        $this->db->from('tbl_other_gaji');
        $this->db->where('id_pegawai', $id);
        $this->db->where('bulan', $date);
        return $this->db->get()->row();
    }
    function get_cuti_by_date($id, $date){
        $this->db->select('*');
        $this->db->from('tbl_cuti');
        $this->db->where('id_pegawai', $id);
        $this->db->like('tanggal', $date, 'after');
        return $this->db->get()->result();
    }
    function json_holiday($year){
        $this->datatables->select('id, tanggal, ket');
        $this->datatables->from('tbl_holiday');
        $this->datatables->like('tanggal', $year, 'after');
        $this->datatables->add_column('action', anchor(site_url('hrms/cuti/update_holiday/$1'),'<i class="fa fa-edit" aria-hidden="true"></i>','class="btn btn-success btn-sm"')." 
                ".anchor(site_url('hrms/cuti/delete_holiday/$1'),'<i class="fa fa-trash" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        $this->db->order_by('tanggal', 'asc');
        return $this->datatables->generate();
    }
    function getHoliday($date){
        $this->db->select('*');
        $this->db->from('tbl_holiday');
        $this->db->where('tanggal', $date);
        return $this->db->get()->row();
    }
    function getUangLembur($id, $date){
        $this->db->select('SUM(uang_lembur) as uang_lembur');
        $this->db->from('tbl_absensi_pegawai');
        $this->db->like('tanggal', $date, 'after');
        $this->db->like('id_pegawai', $id);
        return $this->db->get()->row();
    }
    function get_cuti_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tbl_cuti')->row();
    }
    function cek_cuti_by_date($date)
    {
        $this->db->where('tanggal', $date);
        return $this->db->get('tbl_cuti')->row();
    }
    function cekKomisiPerPotong($id, $date)
    {
        $this->db->select('COUNT(id) AS total, transaction_date');
        $this->db->from('transactions tr');
        $this->db->where('id_pegawai', $id);
        $this->db->like('transaction_date', $date, 'after');
        // $this->db->having('transaction_date LIKE "'.$date.'%"');
        $this->db->group_by('id_pegawai');
        return $this->db->get()->row();
    }
    function cekKomisiPerPotongPerProduct($id, $date)
    {
        $this->db->select('trs.invoice_no, trs.transaction_date, p.id, p.name, p.commission, p.is_paket, tsl.quantity');
        $this->db->from('transaction_sell_lines tsl');
        $this->db->join('transactions trs', 'trs.id=tsl.transaction_id');
        $this->db->join('products p', 'p.id=tsl.product_id');
        $this->db->where('tsl.id_pegawai', $id);
        $this->db->like('trs.transaction_date', $date, 'after');
        $this->db->where('tsl.is_item_paket', 0);
        $this->db->or_where('tsl.is_item_paket', null);
        $this->db->order_by('trs.transaction_date');
        return $this->db->get()->result();
    }
    function cekKomisiPerTrx($id, $date)
    {
        $this->db->select('trs.invoice_no, trs.transaction_date, p.id, p.name, p.commission, p.is_paket, tsl.quantity');
        $this->db->from('transaction_sell_lines tsl');
        $this->db->join('transactions trs', 'trs.id=tsl.transaction_id');
        $this->db->join('products p', 'p.id=tsl.product_id');
        $this->db->where('trs.created_by', $id);
        $this->db->like('trs.transaction_date', $date, 'after');
        $this->db->where('p.is_paket', null);
        $this->db->order_by('trs.transaction_date');
        // // $this->db->where('tsl.is_item_paket', 0);
        // $this->db->or_where('tsl.is_item_paket', 1);
        return $this->db->get();
    }
    function cekCutiBersama($date){
        $this->db->select('tbl_cuti_bersama.*, tbl_cuti_bersama_d.tanggal');
        $this->db->from('tbl_cuti_bersama');
        $this->db->join('tbl_cuti_bersama_d', 'tbl_cuti_bersama.id=tbl_cuti_bersama_d.id_cuti_bersama');
        $this->db->where('tbl_cuti_bersama_d.tanggal', $date);
        return $this->db->get()->row();
    }
}

/* End of file Tbl_pasien_model.php */
/* Location: ./application/models/Tbl_pasien_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-03 15:02:10 */
/* http://harviacode.com */