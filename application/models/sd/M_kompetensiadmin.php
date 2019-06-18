<?php
class M_kompetensiadmin extends CI_Model {

	function addkompetensi($data_kompetensi) {
		$this->db->insert(M_KOMPETENSI_SD,$data_kompetensi);
	}

	function getdatakompetensi($id_kompetensi) {
		$sql="SELECT * FROM `".M_KOMPETENSI_SD."` where id_kompetensi=?";
		$query=$this->db->query($sql,array($id_kompetensi));
		return $query->result();
	}

	function updatekompetensi($data_kompetensi,$id_kompetensi) {
        $this->db->where('id_kompetensi', $id_kompetensi);
        $this->db->update(M_KOMPETENSI_SD,$data_kompetensi);
	}
	
    function deletekompetensi($id_kompetensi){
        $this->db->where('id_kompetensi', $id_kompetensi);
        $this->db->delete(M_KOMPETENSI_SD);
	}

	function datakelompokkompetensi($search, $page){
		$array = array('kelompok_kompetensi' => $search);
		$this->db->or_like($array);
		if ($page == 1) {
			$pageku = $page - 1;
            $this->db->limit($page*10, $pageku);
        } else if ($page > 1) {
			$pageku = ($page - 1) * 10;
			$this->db->limit($page*10, $pageku);
		}		
		$query2=$this->db->get(M_KELOMPOK_KOMPETENSI_SD);
        return $query2->result();
	}

	function datakelompokkompetensi2($id_kelompok){
		$sql="SELECT * FROM `".M_KELOMPOK_KOMPETENSI_SD."` where id_kelompok=?";
		$query=$this->db->query($sql,array($id_kelompok));
		return $query->result();
	}
	
	function kompetensi_list($id_kelompok) {
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_kompetensi','id_kompetensi','kelompok_kompetensi','no_urut_kompetensi','nama_kompetensi', 'keaktifan','sebelum_pengamatan','selama_pengamatan','setelah_pengamatan','pemantauan');
		$sIndexColumn = "a.id_kompetensi";
		$sTable = "`".M_KOMPETENSI_SD."` as a left join `".M_KELOMPOK_KOMPETENSI_SD."` as b ON a.id_kelompok_kompetensi_sd=b.id_kelompok" ;
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

		if (isset($id_kelompok) and $id_kelompok != "") {
			$sWhere = "where a.id_kelompok_kompetensi_sd='".$id_kelompok."' ";
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
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap; !important'>
					<a data-toggle='modal' href='kompetensi/form_editkompetensi?id_kompetensi=".$aRow['id_kompetensi']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['id_kompetensi']."'><i class='fa fa-pencil-alt'></i> Edit Data</a>
					<a data-toggle='modal'  href='kompetensi/form_hapuskompetensi?id_kompetensi=".$aRow['id_kompetensi']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['id_kompetensi']."'><i class='fa fa-eraser'></i> Hapus Data</a>
					<a href='indikator?id_kompetensi=".$aRow['id_kompetensi']."' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' data-target='#cek_data' id='cek_data' data-id='".$aRow['id_kompetensi']."'><i class='fa fa-search-plus'></i> Tampilkan Indikator</a>
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
