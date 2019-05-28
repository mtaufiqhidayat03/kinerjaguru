<?php
class M_kuisioneruser extends CI_Model {

	function addkuisioner($data_kuisioner) {
		$this->db->insert(M_KUISIONER_SMP,$data_kuisioner);
	}

	function addpenilaiankuisioner($data_kuisioner) {
		$this->db->insert(D_KUISIONER_SMP.$this->session->userdata('tahun'),$data_kuisioner);
	}

	function deletehasilkuisioner($no_kuisioner){
        $this->db->where('no_kuisioner', $no_kuisioner);
        $this->db->delete("`".D_KUISIONER_SMP.$this->session->userdata('tahun')."`");
	}

	function getdatakuisioner($id_kuisioner) {
		$sql="SELECT * FROM `".M_KUISIONER_SMP."` where id_kuisioner=?";
		$query=$this->db->query($sql,array($id_kuisioner));
		return $query->result();
	}

	function getdatakuisioner2($id_kuisioner) {
		$sql="SELECT * FROM `".M_KUISIONER_SMP."` as a left join `".M_KELOMPOK_KOMPETENSI_SMP."` as b ON a.id_kelompok_kuisioner_smp=b.id_kelompok where a.id_kuisioner=?";
		$query=$this->db->query($sql,array($id_kuisioner));
		return $query->result();
	}

	function getdatahasilkuisioner($no_kuisioner) {
		$sql="SELECT nama_kuisioner, no_kuisioner, nama_guru FROM `".D_KUISIONER_SMP.$this->session->userdata('tahun')."` as a left join `".M_KUISIONER_SMP."` as b ON a.id_kuisioner_smp=b.id_kuisioner left join `".M_GURU_SMP."` as c ON a.nuptk_kuisioner_smp=c.nuptk where no_kuisioner=?";
		$query=$this->db->query($sql,array($no_kuisioner));
		return $query->result();
	}

	function getdatahasilkuisioner2($no_kuisioner) {
		$sql="SELECT nama_kuisioner, no_kuisioner, id_kelompok_kuisioner_smp, kelompok_kompetensi, nilai_kuisioner, nama_guru, id_kuisioner, nuptk_kuisioner_smp, upload_file_kuisioner_smp FROM `".D_KUISIONER_SMP.$this->session->userdata('tahun')."` as a left join `".M_KUISIONER_SMP."` as b ON a.id_kuisioner_smp=b.id_kuisioner left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kuisioner_smp=c.id_kelompok left join `".M_GURU_SMP."` as d ON a.nuptk_kuisioner_smp=d.nuptk where no_kuisioner=?";
		$query=$this->db->query($sql,array($no_kuisioner));
		return $query->result();
	}

	function getdatahasilkuisioner3($no_kuisioner) {
		$sql="SELECT nama_kuisioner, no_kuisioner, nilai_kuisioner, nama_guru, upload_file_kuisioner_smp FROM `".D_KUISIONER_SMP.$this->session->userdata('tahun')."` as a left join `".M_KUISIONER_SMP."` as b ON a.id_kuisioner_smp=b.id_kuisioner left join `".M_GURU_SMP."` as c ON a.nuptk_kuisioner_smp=c.nuptk where no_kuisioner=?";
		$query=$this->db->query($sql,array($no_kuisioner));
		return $query->result();
	}
	
	function editpenilaiankuisioner($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_smp) {
		$this->db->where('no_kuisioner', $no_kuisioner);
		$this->db->where('id_kuisioner_smp', $id_kuisioner);
		$this->db->where('nuptk_kuisioner_smp', $nuptk_guru_smp);
        $this->db->update("`".D_KUISIONER_SMP.$this->session->userdata('tahun')."`",$data_kuisioner);
	}
	function editpenilaiankuisioner2($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_smp) {
		$this->db->where('no_kuisioner', $no_kuisioner);
		$this->db->where('id_kuisioner_smp', $id_kuisioner);
		$this->db->where('nuptk_kuisioner_smp', $nuptk_guru_smp);
        $this->db->update("`".D_KUISIONER_SMP.$this->session->userdata('tahun')."`",$data_kuisioner);
	}

	function getdataguru($nuptk){
        $sql="SELECT nama_guru,nuptk FROM `".M_GURU_SMP."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function updatekuisioner($data_kuisioner,$id_kuisioner) {
        $this->db->where('id_kuisioner', $id_kuisioner);
        $this->db->update(M_KUISIONER_SMP,$data_kuisioner);
	}
	
    function deletekuisioner($id_kuisioner){
        $this->db->where('id_kuisioner', $id_kuisioner);
        $this->db->delete(M_KUISIONER_SMP);
	}
	
	function kuisioner_list($nuptk) {
		/* $queryku = $this->db->get_where(D_GURU_SMP.$this->session->userdata('tahun'), array('nuptk_guru_smp' => $nuptk));
        $rowku = $queryku->row_array();
		$jenis_guru = $rowku['jenis_guru'];
		$detail_guru = $rowku['detail_guru']; */
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_kuisioner','id_kuisioner','kelompok_kompetensi','nama_kuisioner','if(no_kuisioner IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','nilai_kuisioner','if(nilai_kuisioner IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','id_kuisioner_smp',"no_kuisioner");
		$sIndexColumn = "a.id_kuisioner";
		$sTable = "`".M_KUISIONER_SMP."` as a left join `".M_KELOMPOK_KOMPETENSI_SMP."` as b ON a.id_kelompok_kuisioner_smp=b.id_kelompok left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as c ON b.hub_jenis_guru=c.jenis_guru left join `".D_KUISIONER_SMP.$this->session->userdata("tahun")."` as d ON a.id_kuisioner=d.id_kuisioner_smp and nuptk_kuisioner_smp='".$nuptk."'";
		
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
                    if ($aRow["id_kuisioner_smp"] == "") {
                    $row[] = "<div class='btn-group-vertical center' role='group'>
					<a data-toggle='modal'  href='kuisioneruser/form_uploadfilekuisioner?id_kuisioner=".$aRow['id_kuisioner']."' class='btn btn-sm btn-success btnku btn-elevate btn-elevate-air' data-target='#upload_file'  id='upload-file' data-id='".$aRow['id_kuisioner']."'><i class='fa fa-cloud-upload-alt'></i> Upload File&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kuisioner</a>
					</div>";
                    } else {
                    $row[] = "
					<div class='btn-group-vertical center' role='group'>
					<a data-toggle='modal' href='kuisioneruser/form_lihatpdfkuisioner?no_kuisioner=".$aRow['no_kuisioner']."' data-target='#lihat_pdf' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' id='lihat-pdf' data-id='".$aRow['no_kuisioner']."'><i class='fa fa-file-pdf'></i> Lihat Berkas&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kuisioner</a>
					<a data-toggle='modal' href='kuisioneruser/form_gantiuploadfilekuisioner?no_kuisioner=".$aRow['no_kuisioner']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['no_kuisioner']."'><i class='fa fa-pencil-alt'></i> Ganti Berkas Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kuisioner</a>				
					<a data-toggle='modal'  href='kuisioneruser/form_hapushasilkuisioner?no_kuisioner=".$aRow['no_kuisioner']."' class='btn btn-sm btn-danger btnku btn-elevate btn-elevate-air' data-target='#hapus_data'  id='hapus-data' data-id='".$aRow['no_kuisioner']."'><i class='fa fa-eraser'></i> Hapus Data&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kuisioner</a>
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
