<?php
class M_kelompokuser extends CI_Model {

	function addkelompok($data_kelompok) {
		$this->db->insert(M_KELOMPOK_KOMPETENSI_SD,$data_kelompok);
	}

	function getdatakelompok($id_kelompok) {
		$sql="SELECT * FROM `".M_KELOMPOK_KOMPETENSI_SD."` where id_kelompok=?";
		$query=$this->db->query($sql,array($id_kelompok));
		return $query->result();
	}

	function updatekelompok($data_kelompok,$id_kelompok) {
        $this->db->where('id_kelompok', $id_kelompok);
        $this->db->update(M_KELOMPOK_KOMPETENSI_SD,$data_kelompok);
	}
	
    function deletekelompok($id_kelompok){
        $this->db->where('id_kelompok', $id_kelompok);
        $this->db->delete(M_KELOMPOK_KOMPETENSI_SD);
	}
	
	function kelompok_list() {
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_kelompok','id_kelompok','kelompok_kompetensi','hub_jenis_guru','hub_detail_guru');
		$sIndexColumn = "a.id_kelompok";
		$sTable = "`".M_KELOMPOK_KOMPETENSI_SD."` as a";
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
		
		if (!empty($params['search']['value']))
		{
			$sWhere = "where (";
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
		foreach ( $rResult->result_array() as  $aRow)
		{
			$row = array();
			for ( $i=0 ; $i<count($aColumns); $i++ )
			{
				if ( $i == 1)
				{
					$row[] = "
					<div class='btn-group-vertical center' role='group'>
					<a data-toggle='modal' href='kelompok/form_hubkelompok?id_kelompok=".$aRow['id_kelompok']."' data-target='#hub_data' class='btn btn-success btn-sm btnku btn-elevate btn-elevate-air' id='hub-data' data-id='".$aRow['id_kelompok']."'><i class='fa fa-globe'></i> Hubungkan Dengan Data Guru</a>
					<div class='btn-group-vertical center' role='group'>
					<a data-toggle='modal' href='kelompok/form_editkelompok?id_kelompok=".$aRow['id_kelompok']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['id_kelompok']."'><i class='fa fa-pencil-alt'></i> Edit Data</a>
					<a data-toggle='modal'  href='kelompok/form_hapuskelompok?id_kelompok=".$aRow['id_kelompok']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['id_kelompok']."'><i class='fa fa-eraser'></i> Hapus Data</a>
					<a href='kompetensi?id_kelompok=".$aRow['id_kelompok']."' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' data-target='#cek_data' id='cek_data' data-id='".$aRow['id_kelompok']."'><i class='fa fa-search-plus'></i> Tampilkan Kompetensi</a>
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
