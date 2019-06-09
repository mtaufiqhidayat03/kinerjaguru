<?php
class M_cetakkinerja extends CI_Model {
	
	function cetakkinerja_list($nuptk) {
		$queryku = $this->db->get_where(D_GURU_SD.$this->session->userdata('tahun'), array('nuptk_guru_sd' => $nuptk));
        $rowku = $queryku->row_array();
		$jenis_guru = $rowku['jenis_guru'];
		$detail_guru = $rowku['detail_guru'];
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_kompetensi','id_indikator','kelompok_kompetensi','nama_kompetensi','if(id_indikator IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Kompetensi selesai dinilai</span>","")','id_kelompok','no_urut_kompetensi','no_urut_indikator');
		$sIndexColumn = "b.id_kompetensi";
		$sTable = "`".M_KOMPETENSI_SD."` as b left join `".M_KELOMPOK_KOMPETENSI_SD."` as c ON b.id_kelompok_kompetensi_sd=c.id_kelompok left join `".M_INDIKATOR_SD."` as a ON a.id_kompetensi_indikator_sd=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".D_GURU_SD.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET(".$detail_guru.",c.hub_detail_guru) where nuptk_guru_sd='".$nuptk."'".$sWhere." group by id_kompetensi having count(id_indikator)= (select count(skor) from `".D_PENILAIAN_SD.$this->session->userdata("tahun")."` where nuptk_penilaian_sd='".$nuptk."')";
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

		//$sWhere = "where nuptk_guru_sd=".$nuptk;

		if (!empty($params['search']['value']))
		{
			$sWhere = " and (";
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
		$sQuery = "SELECT COUNT(DISTINCT(".$sIndexColumn.")) as 'Count' FROM  $sTable";
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
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a href='cetakkinerja/cetakpenilaian?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."' data-target='#' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='upload-file' data-id='".$aRow['id_indikator']."'><i class='fa fa-file-pdf'></i> Cetak Penilaian&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Komptensi</a>
					</div>";
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
