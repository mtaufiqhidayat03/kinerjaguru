<?php
class M_indikatoruser extends CI_Model {

	function addindikator($data_indikator) {
		$this->db->insert(M_INDIKATOR_SD,$data_indikator);
	}

	function namaindikator($id_kompetensi) {
        $sql="SELECT * FROM `".M_KOMPETENSI_SD."` where id_kompetensi=?";
        $query=$this->db->query($sql,array($id_kompetensi));
        return $query->result();
	}
	
	function getdataindikator($id_indikator) {
		$sql="SELECT * FROM `".M_INDIKATOR_SD."` as a left join `".M_KOMPETENSI_SD."` as b ON a.id_kompetensi_indikator_sd=b.id_kompetensi where a.id_indikator=?";
		$query=$this->db->query($sql,array($id_indikator));
		return $query->result();
	}

	function updateindikator($data_indikator,$id_indikator) {
        $this->db->where('id_indikator', $id_indikator);
        $this->db->update(M_INDIKATOR_SD,$data_indikator);
	}
	
    function deleteindikator($id_indikator){
        $this->db->where('id_indikator', $id_indikator);
        $this->db->delete(M_INDIKATOR_SD);
	}

	function datakompetensi($search, $page, $id_kelompok){
		$this->db->where('id_kelompok_kompetensi_sd', $id_kelompok);
		$array = array('nama_kompetensi' => $search);		
		$this->db->like($array);
		if ($page == 1) {
			$pageku = $page - 1;
            $this->db->limit($page*10, $pageku);
        } else if ($page > 1) {
			$pageku = ($page - 1) * 10;
			$this->db->limit($page*10, $pageku);
		}		
		
		$query2=$this->db->get(M_KOMPETENSI_SD);
        return $query2->result();
	}

	function datakompetensi2($id_kompetensi){
		$sql="SELECT * FROM `".M_KOMPETENSI_SD."` where id_kompetensi=?";
		$query=$this->db->query($sql,array($id_kompetensi));
		return $query->result();
	}
	
	function indikator_list($id_kompetensi) {
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_indikator','id_indikator','kelompok_kompetensi','no_urut_kompetensi','nama_kompetensi','no_urut_indikator','nama_indikator', 'keaktifan_indikator','id_kelompok');
		$sIndexColumn = "a.id_indikator";
		$sTable = "`".M_INDIKATOR_SD."` as a left join `".M_KOMPETENSI_SD."` as b ON a.id_kompetensi_indikator_sd=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SD."` as c ON b.id_kelompok_kompetensi_sd=c.id_kelompok" ;
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

		if (isset($id_kompetensi) and $id_kompetensi != "") {
			$sWhere = "where a.id_kompetensi_indikator_sd='".$id_kompetensi."' ";
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
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='indikator/form_editindikator?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['id_indikator']."'><i class='fa fa-pencil-alt'></i> Edit Data</a>
					<a data-toggle='modal'  href='indikator/form_hapusindikator?id_indikator=".$aRow['id_indikator']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['id_indikator']."'><i class='fa fa-eraser'></i> Hapus Data</a>
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
