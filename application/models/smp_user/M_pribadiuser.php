<?php
class M_pribadiuser extends CI_Model {

	function getdataguru($nuptk){
        $sql="SELECT * FROM `".M_GURU_SMP."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdataassesor($nuptk){
        $sql="SELECT nuptk_assesor, nama_guru FROM `".D_ASSESOR_SMP.$this->session->userdata("tahun")."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_assesor=b.nuptk where tugas_assesor=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatapelajaran($nuptk){
        $sql="SELECT detail_guru, jenis_guru FROM `".D_GURU_SMP.$this->session->userdata("tahun")."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_guru_smp=b.nuptk where nuptk_guru_smp=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatasekolah($nuptk) {
		$sql= "SELECT * FROM `".D_GURU_SMP.$_SESSION["tahun"]."` as a left join `".M_SMP."` as b ON b.npsn_nss=a.npsn_nss_guru_smp left join master_daerah as c on b.no_daerah=c.no_daerah where nuptk_guru_smp=?";
		$query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatakepalasekolah($npsn_nss) {
		$sql= "SELECT * FROM `".D_SMP.$_SESSION["tahun"]."` as a left join `".M_GURU_SMP."` as b ON b.nip=a.nip_kepala where npsn_nss_smp=?";
		$query=$this->db->query($sql,array($npsn_nss));
        return $query->result();
	}

	function getdaerah($no_daerah) {
        $sql="SELECT * FROM master_daerah where no_daerah=?";
        $query=$this->db->query($sql,array($no_daerah));
        return $query->result();
	}

	function updateguru($data_guru,$nuptk) {
        $this->db->where('nuptk', $nuptk);
        $this->db->update(M_GURU_SMP,$data_guru);
	}
	
	function updatepasswordguru($data_guru2,$nuptk) {
        $this->db->where('username', $nuptk);
        $this->db->update(M_USERS,$data_guru2);
	}
} ?>