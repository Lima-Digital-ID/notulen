<?php
Class Auth extends CI_Controller{
    
    function index(){
        if(!empty($this->session->userdata('id'))){
            $role=$this->session->userdata('role');
            if($role == 1){
                redirect('rapat');
            }else{
                redirect('absensi');
            }
            
        }else{
            $this->session->set_flashdata('status_login','anda belum login');
            $this->load->view('auth/auth');
        }
    }

    function register(){
        if(!empty($this->session->userdata('id'))){
            $this->session->set_flashdata('status_login','anda belum login');
            redirect('rapat');
        }else{
            $this->load->view('auth/register');
        }
    }
    
    function saveRegister(){
        $ref_counts=$this->db->select('*')->where('ref_type', 'contacts')->get('reference_counts')->row();
        $ref_count=$ref_counts->ref_count + 1;
        $ref_digits =  str_pad($ref_count, 4, 0, STR_PAD_LEFT);
        $this->db->where('ref_type', 'contacts')->update('reference_counts', array('ref_count' => $ref_count));

        $data=array(
            'business_id'      => 1,
            'created_by'      => 1,
            'is_default'      => 0,
            'type'      => 'customer',
            'name'   => $this->input->post('name'),
            'password'   => md5($this->input->post('password')),
            'email'   => $this->input->post('email'),
            'mobile'   => $this->input->post('telp'),
            'contact_id'    => 'CO'.$ref_digits,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        );
        
        redirect('auth');
    }
    
    function checklogin(){
        // $telp=$this->input->post('phone');
        // $query=$this->db->where('mobile', $telp)->get('contacts')->row();
        // if ($query != null) {
        //     $this->db->where('id', $query->id)->update('contacts', array('name' => $this->input->post('name')));
        //     $contacts=$this->db->where('mobile', $telp)->get('contacts');
        //     $result = $contacts->row_array();
        // }else{
        //     $ref_counts=$this->db->select('*')->where('ref_type', 'contacts')->get('reference_counts')->row();
        //     $ref_count=$ref_counts->ref_count + 1;
        //     $ref_digits =  str_pad($ref_count, 4, 0, STR_PAD_LEFT);
        //     $this->db->where('ref_type', 'contacts')->update('reference_counts', array('ref_count' => $ref_count));

        //     $data=array(
        //         'business_id'      => 1,
        //         'created_by'      => 1,
        //         'is_default'      => 0,
        //         'type'      => 'customer',
        //         'name'   => $this->input->post('name'),
        //         'mobile'   => $this->input->post('phone'),
        //         'contact_id'    => 'CO'.$ref_digits,
        //         'created_at'    => date('Y-m-d H:i:s'),
        //         'updated_at'    => date('Y-m-d H:i:s')
        //     );
        //     $this->db->insert('contacts', $data);
        //     $contacts=$this->db->where('mobile', $telp)->get('contacts');
        //     $result = $contacts->row_array();
        // }
        
        // $this->session->set_userdata($result);
        // redirect('welcome');


        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        // query chek users
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password',  md5($password));
        $user       = $this->db->get();

        $result = $user->row_array();
        
        if($user->num_rows() > 0){
            $this->session->set_userdata($user->row_array());
            $role=$this->session->userdata('role');
            if($role == 1){
                redirect('rapat');
            }else{
                redirect('absensi');
            }
        }else{
            $this->session->set_flashdata('status_login','email atau password yang anda input salah');
            redirect('auth');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login','Anda sudah berhasil keluar dari aplikasi');
        redirect('auth');
    }
}
