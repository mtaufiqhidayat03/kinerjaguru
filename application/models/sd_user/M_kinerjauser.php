<?php
class M_kinerjauser extends CI_Model {
	
	function getdatakinerja($id_indikator, $id_kompetensi, $id_kelompok) {
		$sql="SELECT * FROM `".M_INDIKATOR_SD."` as a left join `".M_KOMPETENSI_SD."` as b ON a.id_kompetensi_indikator_sd=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SD."` as c ON b.id_kelompok_kompetensi_sd=c.id_kelompok where a.id_indikator=? and b.id_kompetensi=? and c.id_kelompok=?";
		$query=$this->db->query($sql,array($id_indikator, $id_kompetensi, $id_kelompok));
		return $query->result();
	}

	function getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk) {
		$sql="SELECT * FROM `".M_INDIKATOR_SD."` as a left join `".M_KOMPETENSI_SD."` as b ON a.id_kompetensi_indikator_sd=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SD."` as c ON b.id_kelompok_kompetensi_sd=c.id_kelompok left join `".D_PENILAIAN_SD.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_sd where a.id_indikator=? and b.id_kompetensi=? and c.id_kelompok=? and d.nuptk_penilaian_sd=?";
		$query=$this->db->query($sql,array($id_indikator, $id_kompetensi, $id_kelompok, $nuptk));
		return $query->result();
	}

	function getdataguru($nuptk){
        $sql="SELECT nama_guru,nuptk FROM `".M_GURU_SD."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatakuisioner2($id_kuisioner) {
		$sql="SELECT * FROM `".M_KUISIONER_SD."` as a left join `".M_KELOMPOK_KOMPETENSI_SD."` as b ON a.id_kelompok_kuisioner_sd=b.id_kelompok where a.id_kuisioner=?";
		$query=$this->db->query($sql,array($id_kuisioner));
		return $query->result();
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

	function addpenilaiankinerja($data_kinerja) {
		$this->db->insert(D_PENILAIAN_SD.$this->session->userdata('tahun'),$data_kinerja);
	}

	function editpenilaiankinerja($data_kinerja, $id_indikator, $nuptk_guru_sd) {
		$this->db->where('id_indikator_penilaian_sd', $id_indikator);
		$this->db->where('nuptk_penilaian_sd', $nuptk_guru_sd);
        $this->db->update("`".D_PENILAIAN_SD.$this->session->userdata('tahun')."`",$data_kinerja);
	}

	function deletehasilkinerja($id_indikator, $nuptk_guru_sd){
        $this->db->where('id_indikator_penilaian_sd', $id_indikator);
		$this->db->where('nuptk_penilaian_sd', $nuptk_guru_sd);
        $this->db->delete("`".D_PENILAIAN_SD.$this->session->userdata('tahun')."`");
	}

	function kinerja_list($nuptk) {
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_indikator','id_indikator','kelompok_kompetensi','no_urut_kompetensi','nama_kompetensi','no_urut_indikator','nama_indikator', 'if(id_penilaian IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','id_kelompok','id_indikator_penilaian_sd','id_kompetensi');
		$sIndexColumn = "a.id_indikator";
		$sTable = "`".M_INDIKATOR_SD."` as a left join `".M_KOMPETENSI_SD."` as b ON a.id_kompetensi_indikator_sd=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SD."` as c ON b.id_kelompok_kompetensi_sd=c.id_kelompok left join `".D_GURU_SD.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru left join `".D_PENILAIAN_SD.$this->session->userdata("tahun")."` as e ON a.id_indikator=e.id_indikator_penilaian_sd and nuptk_penilaian_sd='".$nuptk."'";
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

		$sWhere = "where nuptk_guru_sd=".$nuptk;

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
		$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM  $sTable where nuptk_guru_sd=".$nuptk;
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
					if ($aRow["id_indikator_penilaian_sd"] == "") {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='kinerja/form_uploadfilekinerja?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."' data-target='#upload_file' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='upload-file' data-id='".$aRow['id_indikator']."'><i class='fa fa-cloud-upload-alt'></i> Upload Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					</div>";
					} else {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='kinerja/form_lihatpdfkinerja?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."'   data-target='#lihat_pdf' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' id='lihat-pdf' data-id='".$aRow['id_indikator']."'><i class='fa fa-file-pdf'></i> Lihat Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					<a data-toggle='modal' href='kinerja/form_gantifilekinerja?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."'  data-target='#upload_file2' class='btn btn-success btn-sm btnku btn-elevate btn-elevate-air' id='upload-file2' data-id='".$aRow['id_indikator']."'><i class='fa fa-pencil-alt'></i> Ganti Berkas Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					<a data-toggle='modal' href='kinerja/form_hapuskinerja?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."'   data-target='#hapus_data' class='btn btn-danger btn-sm btnku btn-elevate btn-elevate-air' id='hapus-data' data-id='".$aRow['id_indikator']."'><i class='fa fa-eraser'></i> Hapus Data&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
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
