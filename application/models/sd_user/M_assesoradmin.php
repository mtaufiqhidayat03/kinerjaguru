<?php
class M_assesoradmin extends CI_Model {
    
    function getdataassesor($id_assesor){
        $sql="SELECT id_assesor, (b.nama_guru) as g1, (c.nama_guru) as g2 FROM `".D_ASSESOR_SD.$this->session->userdata("tahun")."` as a left join `".M_GURU_SD."` as b ON a.nuptk_assesor=b.nuptk left join `".M_GURU_SD."` as c ON a.tugas_assesor=c.nuptk where id_assesor=?";
        $query=$this->db->query($sql,array($id_assesor));
        return $query->result();
	}
	
    function namasekolah($npsn_nss) {
        $sql="SELECT * FROM `".M_SD."` where npsn_nss=?";
        $query=$this->db->query($sql,array($npsn_nss));
        return $query->result();
    }
    
    function addassesor($data_assesor) {
        $this->db->insert("`".D_ASSESOR_SD.$this->session->userdata('tahun')."`",$data_assesor);
	}

	function dataassesor($search, $page){
		$this->db->select('nuptk,nama_guru');
		$this->db->from(D_GURU_SD.$this->session->userdata('tahun'));
		//$this->db->where('nama_guru',$search);		
		$array = array('nama_guru' => $search, 'nuptk' => $search);
		$this->db->or_like($array);		 
		$this->db->join(M_GURU_SD, M_GURU_SD.'.nuptk='.D_GURU_SD.$this->session->userdata('tahun').'.nuptk_guru_sd', 'left');
		if ($page == 1) {
			$pageku = $page - 1;
            $this->db->limit($page*10, $pageku);
        } else if ($page > 1) {
			$pageku = ($page - 1) * 10;
			$this->db->limit($page*10, $pageku);
		} 
		$query2=$this->db->get();
        return $query2->result();
	}
	function datagurudinilai($search, $page, $assesor, $npsn_nss_assesor){
		$this->db->select('nuptk,nama_guru');
		$this->db->from(D_GURU_SD.$this->session->userdata('tahun'));	
		$this->db->where('nuptk_guru_sd !=', $assesor);
		$this->db->where('npsn_nss_guru_sd', $npsn_nss_assesor);	
		$this->db->where("(nama_guru like '%".$search."%' ESCAPE '!' OR nuptk like '%".$search."%' ESCAPE '!')");	 
		$this->db->join(M_GURU_SD, M_GURU_SD.'.nuptk='.D_GURU_SD.$this->session->userdata('tahun').'.nuptk_guru_sd', 'left');
		if ($page == 1) {
			$pageku = $page - 1;
            $this->db->limit($page*10, $pageku);
        } else if ($page > 1) {
			$pageku = ($page - 1) * 10;
			$this->db->limit($page*10, $pageku);
		} 
		$query2=$this->db->get();
        return $query2->result();
	}
	
	function deleteassesor($id_assesor){
        $this->db->where('id_assesor', $id_assesor);
        $this->db->delete("`".D_ASSESOR_SD.$this->session->userdata('tahun')."`");
	}
	
    function assesor_list($npsn_nss) {
	$db = get_instance()->db->conn_id;
	$params = $_REQUEST;
	$aColumns = array('id_assesor','id_assesor','nama_sekolah','nuptk_assesor', '(d.nama_guru) as d','tugas_assesor', '(e.nama_guru) as e');
	$aColumns2 = array('id_assesor','id_assesor','nama_sekolah','nuptk_assesor', '(d.nama_guru)','tugas_assesor', '(e.nama_guru)');
	$sIndexColumn = "a.nuptk_assesor";
	$sTable = "`".D_ASSESOR_SD.$this->session->userdata("tahun")."` as a left join `".D_GURU_SD.$this->session->userdata("tahun")."` as b ON a.nuptk_assesor=b.nuptk_guru_sd left join `".M_SD."` as c ON c.npsn_nss=b.npsn_nss_guru_sd left join `".M_GURU_SD."` as d ON a.nuptk_assesor=d.nuptk left join `".M_GURU_SD."` as e ON a.tugas_assesor=e.nuptk";
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

    if (isset($npsn_nss) and $npsn_nss != "") {
	   $sWhere = "where b.npsn_nss_guru_sd='".$npsn_nss."' ";
	}

	if (!empty($params['search']['value']))
	{
		if (isset($npsn_nss) and $npsn_nss != "") {
            $sWhere = "where b.npsn_nss_guru_sd='".$npsn_nss."' and (";
        } else {
            $sWhere = "where (";
        }
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns2[$i]." LIKE '%".mysqli_real_escape_string( $db, $params['search']['value'])."%' OR ";
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
	$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM  $sTable";
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
	foreach ( $rResult->result() as  $aRow)
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns); $i++ )
		{
			if ( $i == 1)
			{
				$row[] = "
				<div class='btn-group-vertical' role='group'>
				<a data-toggle='modal'  href='assesor/form_hapusassesor?id_assesor=".$aRow->id_assesor."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow->nuptk_assesor."'><i class='fa fa-eraser'></i> Hapus Data</a>
				</div>";
			}
			else if ( $i == 4) {
				$row[] = '<span style="font-size:14px; font-weight:400">'.$aRow->d.'</span>';
			} 
			 else if ( $i == 6) {
				$row[] = '<span style="font-size:14px; font-weight:400">'.$aRow->e.'</span>';
			} 
			else if ($aColumns[$i] != "")
			{
				if ($aColumns[$i] == "" ) {
                   $row[] = '<span class="kt-badge kt-badge--inline kt-badge--danger" style="font-size:14px; font-weight:400">-</span>';
                } else {
					$a =$aColumns2[$i];
					$row[] = '<span style="font-size:14px; font-weight:400">'.$aRow->$a.'</span>';
				}
			}
		}
		$output['aaData'][] = $row;
	}
	return $output;    
    }
}
?>
