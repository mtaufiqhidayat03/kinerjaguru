<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

    function auth_guru($username){
        $query=$this->db->query("SELECT * FROM `".M_GURU_SD."` WHERE nuptk='$username' LIMIT 1");
        return $query;
	}
	function check_if_kepseksd($nip,$tahun){
        $query=$this->db->query("SELECT * FROM `".D_SD.$tahun."` WHERE nip_kepala='$nip' LIMIT 1");
        return $query;
	}
	function auth_gurusmp($username){
        $query=$this->db->query("SELECT * FROM `".M_GURU_SMP."` WHERE nuptk='$username' LIMIT 1");
        return $query;
	}
	function check_if_kepseksmp($nip,$tahun){
        $query=$this->db->query("SELECT * FROM `".D_SMP.$tahun."` WHERE nip_kepala='$nip' LIMIT 1");
        return $query;
	}
    function auth_admin($username){
        $query=$this->db->query("SELECT * FROM master_administrator WHERE id_administrator='$username' LIMIT 1");
        return $query;
	}
	function cek_tahun() {
		$query=$this->db->query("SELECT * FROM master_tahun ORDER BY tahun asc");
		return $query->result();
	}
}
?>
