<?php
	function is_login(){
		$ci=get_instance();
		if(empty($ci->session->userdata('id'))){
			$ci->session->set_flashdata('status_login','anda belum login');
			redirect('auth');
		}
	}
	function cmb_dinamis($name,$table,$field,$pk,$selected=null,$extra=null){
        $ci = get_instance();
        $cmb = "<select data-plugin-selectTwo name='$name' class='form-control' $extra>";
        $cmb .= "<option value=''>--- SILAHKAN PILIH ---</option>";
        $data = $ci->db->get($table)->result();
        foreach ($data as $d){
            $cmb .="<option value='".$d->$pk."'";
            $cmb .= $selected==$d->$pk?" selected='selected'":'';
            $cmb .=">".  strtoupper($d->$field)."</option>";
        }
        $cmb .="</select>";
        return $cmb;  
    }
    function alert($class,$title,$description){
        return '<div class="alert '.$class.' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>
                    '.$description.'
                  </div>';
    }
    function tipe($id="")
    {
        // $tipe = array('Paripurna','Komisi','Bamus','Banggar','Fraksi','Badan','Sekertariat Dewan','Panitia Khusus');
        $ci = get_instance();
        $ci->db->select('menu');
        if($id!=""){
            $sql = $ci->db->get_where('menu',['id_menu' => $id])->row();
            return $sql->menu;
        }
        else{
            $sql = $ci->db->get('menu')->result_array();
            $arr = [];
            foreach ($sql as $key => $value) {
                array_push($arr,$value['menu']);
            }
        }

    }
    function cekSub($idTipe){
        if($idTipe==2 || $idTipe==5 || $idTipe==6){
            return true;
        }
        else{
            return false;
        }
    }
    function subtipe($tipe,$sub="")
    {
        $subtipe = array(
            'Komisi' => ['Komisi 1', 'Komisi 2','Komisi 3'],
            'Fraksi' => ['PDIP', 'PKB','Indonesia Bersatu'],
            'Badan' => ['Bamperda', 'Pimpinan','BK (Badan Kehormatan)','Hearing','Uji Publik','Sekretaris DPRD','Anggota','Pansus'],
        );

        if($sub!=""){
            $return = isset($subtipe[$tipe][$sub-1]) ? $subtipe[$tipe][$sub-1] : 'null';
        }
        else{
            $return = isset($subtipe[$tipe]) ? $subtipe[$tipe] : 'null';
        }

        return $return;
    }
    function bln($bln){
        $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bln = $array_bln[$bln];

        return $bln;
           
    }
?>