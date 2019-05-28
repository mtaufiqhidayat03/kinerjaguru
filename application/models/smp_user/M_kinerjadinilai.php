<?php
class M_kinerjadinilai extends CI_Model {
    
    function getdataassesor($id_assesor){
        $sql="SELECT id_assesor, (b.nama_guru) as g1, (c.nama_guru) as g2 FROM `".D_ASSESOR_SMP.$this->session->userdata("tahun")."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_assesor=b.nuptk left join `".M_GURU_SMP."` as c ON a.tugas_assesor=c.nuptk where id_assesor=?";
        $query=$this->db->query($sql,array($id_assesor));
        return $query->result();
	}
	
    function namasekolah($npsn_nss) {
        $sql="SELECT * FROM `".M_SMP."` where npsn_nss=?";
        $query=$this->db->query($sql,array($npsn_nss));
        return $query->result();
	}

	function getdatakinerja($id_indikator, $id_kompetensi, $id_kelompok) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok where a.id_indikator=? and b.id_kompetensi=? and c.id_kelompok=?";
		$query=$this->db->query($sql,array($id_indikator, $id_kompetensi, $id_kelompok));
		return $query->result();
	}

    function getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_smp where a.id_indikator=? and b.id_kompetensi=? and c.id_kelompok=? and d.nuptk_penilaian_smp=?";
		$query=$this->db->query($sql,array($id_indikator, $id_kompetensi, $id_kelompok, $nuptk));
		return $query->result();
	}

	function getdataguru($nuptk){
        $sql="SELECT nama_guru,nuptk FROM `".M_GURU_SMP."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}
    function addassesor($data_assesor) {
        $this->db->insert("`".D_ASSESOR_SMP.$this->session->userdata('tahun')."`",$data_assesor);
	}

	function persetujuankinerja($data_persetujuan, $id_indikator, $nuptk_guru_smp) {
		$this->db->where('id_indikator_penilaian_smp', $id_indikator);
		$this->db->where('nuptk_penilaian_smp', $nuptk_guru_smp);
        $this->db->update("`".D_PENILAIAN_SMP.$this->session->userdata('tahun')."`",$data_persetujuan);
	}

	function dataassesor($search, $page, $npsn_nss_assesor){
		$this->db->select('nuptk,nama_guru');
		$this->db->from(D_GURU_SMP.$this->session->userdata('tahun'));
		//$this->db->where('nama_guru',$search);	
		$this->db->where('npsn_nss_guru_smp', $npsn_nss_assesor);
		$this->db->where("(nama_guru like '%".$search."%' ESCAPE '!' OR nuptk like '%".$search."%' ESCAPE '!')");		
		//$array = array('nama_guru' => $search, 'nuptk' => $search);
		//$this->db->or_like($array);		 
		$this->db->join(M_GURU_SMP, M_GURU_SMP.'.nuptk='.D_GURU_SMP.$this->session->userdata('tahun').'.nuptk_guru_smp', 'left');
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
		$this->db->from(D_GURU_SMP.$this->session->userdata('tahun'));	
		$this->db->where('nuptk_guru_smp !=', $assesor);
		$this->db->where('npsn_nss_guru_smp', $npsn_nss_assesor);	
		$this->db->where("(nama_guru like '%".$search."%' ESCAPE '!' OR nuptk like '%".$search."%' ESCAPE '!')");	 
		$this->db->join(M_GURU_SMP, M_GURU_SMP.'.nuptk='.D_GURU_SMP.$this->session->userdata('tahun').'.nuptk_guru_smp', 'left');
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
        $this->db->delete("`".D_ASSESOR_SMP.$this->session->userdata('tahun')."`");
	}
	
    function dinilai_list($nuptk) {
	$db = get_instance()->db->conn_id;
	$params = $_REQUEST;
	$aColumns = array('id_assesor','id_assesor','nama_sekolah','nuptk_assesor', '(d.nama_guru) as d','tugas_assesor', '(e.nama_guru) as e');
	$aColumns2 = array('id_assesor','id_assesor','nama_sekolah','nuptk_assesor', '(d.nama_guru)','tugas_assesor', '(e.nama_guru)');
	$aColumns3 = array('id_assesor','id_assesor','nama_sekolah','nuptk_assesor', 'd','tugas_assesor', 'e');
	$sIndexColumn = "a.nuptk_assesor";
	$sTable = "`".D_ASSESOR_SMP.$this->session->userdata("tahun")."` as a left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as b ON a.nuptk_assesor=b.nuptk_guru_smp left join `".M_SMP."` as c ON c.npsn_nss=b.npsn_nss_guru_smp left join `".M_GURU_SMP."` as d ON a.nuptk_assesor=d.nuptk left join `".M_GURU_SMP."` as e ON a.tugas_assesor=e.nuptk";
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
		$sOrder .= "`".$aColumns3[$params['order'][$i]['column']]."` ".$params['order'][$i]['dir'].", ";
	}
	$sOrder = substr_replace( $sOrder, "", -2 );
	if ( $sOrder == "ORDER BY" )
	{
		$sOrder = "";
	}

	$sWhere = "where nuptk_assesor='".$nuptk."' ";

	if (!empty($params['search']['value']))
	{
        $sWhere .= "and (";
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
	$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM  $sTable where nuptk_assesor='".$nuptk."'";
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
				<button type='button' class='btn btn-warning btn-elevate btn-elevate-air btn-sm pilih_guru' id='pilih_guru' value='".$aRow->tugas_assesor."'><i class='fa fa-file-signature'></i> Pilih Guru</button>
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
	
	function kinerja_list($nuptk) {
		/* $queryku = $this->db->get_where(D_GURU_SMP.$this->session->userdata('tahun'), array('nuptk_guru_smp' => $nuptk));
        $rowku = $queryku->row_array();
		$jenis_guru = $rowku['jenis_guru'];
		$detail_guru = $rowku['detail_guru']; */
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_indikator','id_indikator','kelompok_kompetensi','nama_kompetensi','nama_indikator', 'if(id_penilaian IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','skor','if(skor IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','id_kelompok','id_indikator_penilaian_smp','id_kompetensi','no_urut_kompetensi','no_urut_indikator');
		$sIndexColumn = "a.id_indikator";
        $sTable = "`".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as e ON a.id_indikator=e.id_indikator_penilaian_smp and nuptk_penilaian_smp='".$nuptk."'";
        
		$sLimit = "";
		/*  Paging */
		if ($this->input->post('start') !== "" && $this->input->post('length') != '-1' )
			{
				$sLimit .= "LIMIT ".mysqli_real_escape_string($db,$this->input->post('start')).", ".
					mysqli_real_escape_string($db,$this->input->post('length'));
			}	
		
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

		$sWhere = "where nuptk_guru_smp=".$nuptk;

		if (!empty($params['search']['value']))
		{
			$sWhere .= " and (";
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
		$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM  $sTable where nuptk_guru_smp=".$nuptk;
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
				if ( $i == 1)
				{
					if ($aRow["id_indikator_penilaian_smp"] == "") {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='' data-target='' class='btn btn-danger btn-sm btnku btn-elevate btn-elevate-air disabled' id='upload-file' data-id='".$aRow['id_indikator']."'><i class='fa fa-exclamation'></i> Belum Ada Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					</div>";
					} else {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='kinerjadinilai/form_lihatpdfkinerjadinilai?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."&nuptk=".$nuptk."'   data-target='#lihat_pdf' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' id='lihat-pdf' data-id='".$aRow['id_indikator']."'><i class='fa fa-file-pdf'></i> Lihat Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					<a data-toggle='modal' href='kinerjadinilai/form_persetujuankinerja?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."&nuptk=".$nuptk."'  data-target='#persetujuan_kinerja' class='btn btn-success btn-sm btnku btn-elevate btn-elevate-air' id='persetujuan-kinerja' data-id='".$aRow['id_indikator']."'><i class='fa fa-thumbs-up'></i> Persetujuan&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
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
			}
			$output['aaData'][] = $row;
		}
		return $output;    
		}  
}
?>
