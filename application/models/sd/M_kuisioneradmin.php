<?php
class M_kuisioneradmin extends CI_Model {

	function addkuisioner($data_kuisioner) {
		$this->db->insert(M_KUISIONER_SD,$data_kuisioner);
	}

	function addpenilaiankuisioner($data_kuisioner) {
		$this->db->insert(D_KUISIONER_SD.$this->session->userdata('tahun'),$data_kuisioner);
	}

	function getdatakuisioner($id_kuisioner) {
		$sql="SELECT * FROM `".M_KUISIONER_SD."` where id_kuisioner=?";
		$query=$this->db->query($sql,array($id_kuisioner));
		return $query->result();
	}

	function getdatakuisioner2($id_kuisioner) {
		$sql="SELECT * FROM `".M_KUISIONER_SD."` as a left join `".M_KELOMPOK_KOMPETENSI_SD."` as b ON a.id_kelompok_kuisioner_sd=b.id_kelompok where a.id_kuisioner=?";
		$query=$this->db->query($sql,array($id_kuisioner));
		return $query->result();
	}

	function updatekuisioner($data_kuisioner,$id_kuisioner) {
        $this->db->where('id_kuisioner', $id_kuisioner);
        $this->db->update(M_KUISIONER_SD,$data_kuisioner);
	}
	
    function deletekuisioner($id_kuisioner){
        $this->db->where('id_kuisioner', $id_kuisioner);
        $this->db->delete(M_KUISIONER_SD);
	}
	
	function kuisioner_list() {
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_kuisioner','id_kuisioner','kelompok_kompetensi','nama_kuisioner');
		$sIndexColumn = "a.id_kuisioner";
		$sTable = "`".M_KUISIONER_SD."` as a left join `".M_KELOMPOK_KOMPETENSI_SD."` as b ON a.id_kelompok_kuisioner_sd=b.id_kelompok";
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
					$row[] = "<div class='btn-group-vertical center' role='group'>
					<a data-toggle='modal' href='kuisioner/form_editkuisioner?id_kuisioner=".$aRow['id_kuisioner']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['id_kuisioner']."'><i class='fa fa-pencil-alt'></i> Edit Data</a>
					<a data-toggle='modal'  href='kuisioner/form_hapuskuisioner?id_kuisioner=".$aRow['id_kuisioner']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['id_kuisioner']."'><i class='fa fa-eraser'></i> Hapus Data</a>
					<a data-toggle='modal'  href='kuisioner/form_uploadfile?id_kuisioner=".$aRow['id_kuisioner']."' class='btn btn-sm btn-success btnku btn-elevate btn-elevate-air' data-target='#upload_file'  id='upload-file' data-id='".$aRow['id_kuisioner']."'><i class='fa fa-cloud-upload-alt'></i> Upload File Bukti Kuisioner</a>
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
