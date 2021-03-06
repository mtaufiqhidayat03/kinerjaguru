<?php
class M_guruuser extends CI_Model {
	
	function viewguru() {
        $sql="SELECT * FROM `".M_GURU_SD."`";
        $query=$this->db->query($sql);
        return $query->result();
	}

	function viewguru2($npsn_nss) {
        $sql="SELECT * FROM `".M_GURU_SD."` as a left join `".D_GURU_SD.$this->session->userdata('tahun')."` as b  ON a.nuptk=b.nuptk_guru_sd where npsn_nss_guru_sd=?";
        $query=$this->db->query($sql, array($npsn_nss));
        return $query->result();
	}

	function nama_sekolah($npsn_nss) {
        $sql="SELECT npsn_nss,nama_sekolah FROM `".M_SD."` where npsn_nss=?";
		$query=$this->db->query($sql, array($npsn_nss));
        return $query->result();
	}

	function viewtahun() {
		$tahun = $this->session->userdata('tahun');
		$sql="SELECT * FROM `master_tahun` where id_tahun=?";
        $query=$this->db->query($sql, array($tahun));
        return $query->result();
	}
	
    function getdataguru($nuptk){
        $sql="SELECT * FROM `".M_GURU_SD."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function npsn_nss_sd($nip){
		$tahun = $this->session->userdata("tahun");
        $query=$this->db->query("SELECT * FROM `".D_SD.$tahun."` WHERE nip_kepala='$nip' LIMIT 1");
        return $query->result();
	}

	function updategurusekolah2($data_guru2) {
		$this->db->insert("`".D_GURU_SD.$this->session->userdata('tahun')."`", $data_guru2);
	}

	function getdataguru2($nuptk){
        $sql="SELECT * FROM `".M_SD."` as a left join `".D_GURU_SD.$_SESSION["tahun"]."` as b  ON a.npsn_nss=b.npsn_nss_guru_sd left join `".M_GURU_SD."` as c ON b.nuptk_guru_sd=c.nuptk where nuptk_guru_sd=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatasekolah2($nuptk) {
		$sql= "SELECT * FROM `".D_GURU_SD.$_SESSION["tahun"]."` as a left join `".M_SD."` as b ON b.npsn_nss=a.npsn_nss_guru_sd left join master_daerah as c on b.no_daerah=c.no_daerah where nuptk_guru_sd=?";
		$query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}
	
    function getsekolah() {
        $sql="SELECT npsn_nss,nama_sekolah FROM `".M_SD."`";
        $query=$this->db->query($sql);
        return $query->result();
	}
	
    function datasekolahsd($search, $page){
		$array = array('nama_sekolah' => $search, 'npsn_nss' => $search);
		$this->db->or_like($array);
		if ($page == 1) {
			$pageku = $page - 1;
            $this->db->limit($page*10, $pageku);
        } else if ($page > 1) {
			$pageku = ($page - 1) * 10;
			$this->db->limit($page*10, $pageku);
		}		
		$query2=$this->db->get(M_SD);
        return $query2->result();
	}
	
    function namasekolah($npsn_nss) {
        $sql="SELECT * FROM `".M_SD."` where npsn_nss=?";
        $query=$this->db->query($sql,array($npsn_nss));
        return $query->result();
    }
    
    function updateguru($data_guru,$nuptk) {
        $this->db->where('nuptk', $nuptk);
        $this->db->update(M_GURU_SD,$data_guru);
	}
	
    function updatepasswordguru($data_guru2,$nuptk) {
        $this->db->where('username', $nuptk);
        $this->db->update(M_USERS,$data_guru2);
	}
	
    function deleteguru($nuptk){
        $this->db->where('nuptk', $nuptk);
		$this->db->delete(M_GURU_SD);
		$this->db->where('username', $nuptk);
        $this->db->delete(M_USERS);
	}

	function deleteguru2($nuptk){
		$this->db->where('nuptk_guru_sd', $nuptk);
        $this->db->delete("`".D_GURU_SD.$this->session->userdata('tahun')."`");
	}
	
	function deletekepalasekolah($nipkepala){
        $this->db->where('nip_kepala', $nipkepala);
        $this->db->delete("`".D_SD.$this->session->userdata('tahun')."`");
	}
    
    function addguru($data_guru) {
        $this->db->insert(M_GURU_SD,$data_guru);
	}

	function addguru_p($data_guru2) {
        $this->db->insert(M_USERS,$data_guru2);
	}

    function updategurusekolah($data_guru,$nuptk) {
		$this->db->where('nuptk_guru_sd', $nuptk);
		$this->db->update("`".D_GURU_SD.$this->session->userdata('tahun')."`",$data_guru);
	}

	function deletejenisguru($nuptk){
		$this->db->set('jenis_guru', '');
		$this->db->set('detail_guru', '');
		$this->db->where('nuptk_guru_sd', $nuptk);
		$this->db->update("`".D_GURU_SD.$this->session->userdata('tahun')."`");
	}
	
    function guru_list($npsn_nss, $nuptk) {
	$db = get_instance()->db->conn_id;
	$params = $_REQUEST;
    $aColumns = array('nuptk','nuptk','nama_sekolah','nuptk', 'nama_guru', 'nip', 'karpeg', 'tempat_lahir', 'DATE_FORMAT(tgl_lahir, CONCAT(\'%e \', ELT(MONTH(tgl_lahir),"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"), \' %Y\'))','pangkat_jabatan', 
    'CONCAT(floor(datediff(CURDATE(), tmt_guru)/365),\' tahun \',floor((datediff(CURDATE(), tmt_guru)-(floor(datediff(CURDATE(), tmt_guru)/365)*365))/30),\' bulan \', (datediff(CURDATE(), tmt_guru) mod 30),\' hari\')','jenis_kelamin','pendidikan_terakhir','program_keahlian','jenis_guru','detail_guru','npsn_nss');
	$sIndexColumn = "a.nuptk";
	$sTable = "`".M_GURU_SD."` as a left join `".D_GURU_SD.$_SESSION["tahun"]."` as b ON a.nuptk=b.nuptk_guru_sd left join `".M_SD."` as c ON c.npsn_nss=b.npsn_nss_guru_sd ";
	$sLimit = "";
	/*  Paging */
	if ($this->input->post('start') !== "" && $this->input->post('length') != '-1' )
		{
			$sLimit .= "LIMIT ".mysqli_real_escape_string($db,$this->input->post('start')).", ".
				mysqli_real_escape_string($db,$this->input->post('length'));
		}	
	
	//$sOrder =  " ORDER BY  `". $aColumns[$params['order'][0]['column']]."` ".$params['order'][0]['dir']."";

	$sOrder = "ORDER BY  ";
	for ( $i=0 ; $i<count($_POST['order']) ; $i++ )
	{
		$sOrder .= "`".$aColumns[$params['order'][$i]['column']]."` ".$params['order'][$i]['dir'].", ";
	}
	$sOrder = substr_replace( $sOrder, "", -2 );
	if ( $sOrder == "ORDER BY" )
	{
		$sOrder = "";
	}

   // if (isset($npsn_nss) and $npsn_nss != "") {
	   $sWhere = "where npsn_nss_guru_sd='".$npsn_nss."' ";
	//}

	if (!empty($params['search']['value']))
	{
        $sWhere .= "and (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string( $db, $params['search']['value'])."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	} 

	$sQuery2 = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	$rResult = $this->db->query($sQuery2);
	/* Data set length after filtering */
	$sQuery3 = "SELECT FOUND_ROWS() as 'Count' ";
	$rResultFilterTotal = $this->db->query($sQuery3);
	$aResultFilterTotal = $rResultFilterTotal->row()->Count;
	$iFilteredTotal = $aResultFilterTotal;
	
	/* Total data set length */
	$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM  $sTable where npsn_nss_guru_sd='".$npsn_nss."'";
	$rResultTotal = $this->db->query($sQuery);
	$aResultTotal = $rResultTotal->row()->Count;
	$iTotal = $aResultTotal;
	/* Output	 */
	$output = array(
		"sEcho" => intval($this->input->post('sEcho')),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	foreach ( $rResult->result_array() as  $aRow)
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns); $i++ )
		{
			if ($this->session->userdata("level")=="Kepsek") {
			if ( $i == 1)
			{
				if ($aRow[$aColumns[14]] == "") {
				$row[] = "
				<div class='btn-group-vertical' role='group'>
				<a data-toggle='modal' href='guru/form_gurumapel?nuptk=".$aRow['nuptk']."' data-target='#guru_sekolah' class='btn btn-success btn-sm btnku btn-elevate btn-elevate-air' id='guru-sekolah' data-id='".$aRow['nuptk']."'><i class='flaticon-interface-5'></i> Pilih Menjadi Guru<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mata Pelajaran/Kelas</a>
				<a data-toggle='modal' href='guru/form_editguru?nuptk=".$aRow['nuptk']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['nuptk']."'><i class='fa fa-pencil-alt'></i> Edit Data</a>
				<a data-toggle='modal'  href='guru/form_hapusguru?nuptk=".$aRow['nuptk']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['nuptk']."'><i class='fa fa-eraser'></i> Hapus Data</a>
				<a data-toggle='modal'  href='guru/form_gantipasswordguru?nuptk=".$aRow['nuptk']."' class='btn btn-sm btn-dark btnku btn-elevate btn-elevate-air' data-target='#ganti_password'  id='ganti-password' data-id='".$aRow['nuptk']."'><i class='fa fa-lock'></i> Ganti Password</a>
				</div>";
				} else {
				$row[] = "
				<div class='btn-group-vertical' role='group'>
				<a data-toggle='modal' href='guru/form_hapusgurumapel?nuptk=".$aRow['nuptk']."&npsn_nss=".$aRow['npsn_nss']."' data-target='#hapusguru_sekolah' class='btn btn-danger btn-sm btnku btn-elevate btn-elevate-air' id='hapusguru-sekolah' data-id='".$aRow['nuptk']."'><i class='fa fa-eraser'></i> Hapus Sebagai&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$aRow['jenis_guru']."&nbsp;</a>
				<a data-toggle='modal' href='guru/form_editguru?nuptk=".$aRow['nuptk']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['nuptk']."'><i class='fa fa-pencil-alt'></i> Edit Data</a>
				<a data-toggle='modal'  href='guru/form_hapusguru?nuptk=".$aRow['nuptk']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['nuptk']."'><i class='fa fa-eraser'></i> Hapus Data</a>
				<a data-toggle='modal'  href='guru/form_gantipasswordguru?nuptk=".$aRow['nuptk']."' class='btn btn-sm btn-dark btnku btn-elevate btn-elevate-air' data-target='#ganti_password'  id='ganti-password' data-id='".$aRow['nuptk']."'><i class='fa fa-lock'></i> Ganti Password</a>
				</div>";
				}
			}
			else if ($aColumns[$i] != "")
			{
				if ($aRow[$aColumns[$i]] == "" ) {
                    $row[] = '<span class="kt-badge kt-badge--inline kt-badge--danger" style="font-size:14px; font-weight:400">-</span>';
                } else {
					$row[] = '<span style="font-size:14px; font-weight:400">'.$aRow[$aColumns[$i]].'</span>';
				}
			}
		} else {
			if ($aColumns[$i] != "")
			{
				if ($aRow[$aColumns[$i]] == "" ) {
                    $row[] = '<span class="kt-badge kt-badge--inline kt-badge--danger" style="font-size:14px; font-weight:400">-</span>';
                } else {
					$row[] = '<span style="font-size:14px; font-weight:400">'.$aRow[$aColumns[$i]].'</span>';
				}
			}
		}
		}
		$output['aaData'][] = $row;
	}
	return $output;    
    }
}
?>
