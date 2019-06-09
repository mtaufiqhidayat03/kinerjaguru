<?php
class M_penilaianadmin extends CI_Model {

	function getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk, $id_penilaian) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_smp where a.id_indikator=? and b.id_kompetensi=? and c.id_kelompok=? and d.nuptk_penilaian_smp=? and d.id_penilaian=?";
		$query=$this->db->query($sql,array($id_indikator, $id_kompetensi, $id_kelompok, $nuptk, $id_penilaian));
		return $query->result();
	}

	function getdatakinerja3($id_indikator, $id_kompetensi, $nuptk, $id_penilaian) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_smp where a.id_indikator=? and b.id_kompetensi=? and d.nuptk_penilaian_smp=? and d.id_penilaian=?";
		$query=$this->db->query($sql,array($id_indikator, $id_kompetensi, $nuptk, $id_penilaian));
		return $query->result();
	}

	function getdataguru($nuptk){
        $sql="SELECT nama_guru,nuptk FROM `".M_GURU_SMP."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function deletehasilpenilaian($id_indikator, $nuptk_guru_smp, $id_penilaian){
        $this->db->where('id_indikator_penilaian_smp', $id_indikator);
		$this->db->where('nuptk_penilaian_smp', $nuptk_guru_smp);
		$this->db->where('id_penilaian', $id_penilaian);
        $this->db->delete("`".D_PENILAIAN_SMP.$this->session->userdata('tahun')."`");
	}

	function penilaian_list() {
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_penilaian','id_penilaian','nuptk_penilaian_smp','nama_guru','if(kelompok_kompetensi IS NOT NULL, kelompok_kompetensi,"<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Guru pindah mengajar kelas/mata pelajaran lain</span>")','nama_kompetensi','nama_indikator', 'if(id_penilaian IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','skor','if(skor IS NOT NULL,"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Sudah</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Belum</span>")','id_kelompok','id_indikator_penilaian_smp','id_kompetensi','no_urut_kompetensi','no_urut_indikator','id_indikator','kelompok_kompetensi');
		$sIndexColumn = "e.id_penilaian";
		$sTable = "`".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as e left join `".M_INDIKATOR_SMP."` as a ON a.id_indikator=e.id_indikator_penilaian_smp left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON d.nuptk_guru_smp=e.nuptk_penilaian_smp left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok and c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET(d.detail_guru,c.hub_detail_guru) left join `".M_GURU_SMP."` as f ON e.nuptk_penilaian_smp=f.nuptk ";
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
					if ($aRow["id_indikator_penilaian_smp"] == "") {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='' data-target='' class='btn btn-danger btn-sm btnku btn-elevate btn-elevate-air disabled' id='upload-file' data-id='".$aRow['id_indikator']."'><i class='fa fa-exclamation'></i> Belum Ada Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					</div>";
					} else {
					if ($aRow["kelompok_kompetensi"] == "") {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='penilaian/form_hapuspenilaian?id_indikator=".$aRow['id_indikator']."&id_kompetensi=".$aRow['id_kompetensi']."&id_penilaian=".$aRow['id_penilaian']."&nuptk=".$aRow['nuptk_penilaian_smp']."'   data-target='#hapus_data' class='btn btn-danger btn-sm btnku btn-elevate btn-elevate-air' id='hapus-data' data-id='".$aRow['id_indikator']."'><i class='fa fa-eraser'></i> Hapus Data&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					</div>";
					} else {
                    $row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a data-toggle='modal' href='penilaian/form_lihatpdfpenilaian?id_indikator=".$aRow['id_indikator']."&id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."&id_penilaian=".$aRow['id_penilaian']."&nuptk=".$aRow['nuptk_penilaian_smp']."'   data-target='#lihat_pdf' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' id='lihat-pdf' data-id='".$aRow['id_indikator']."'><i class='fa fa-file-pdf'></i> Lihat Bukti&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penilaian Kinerja</a>
					</div>";
                    }
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