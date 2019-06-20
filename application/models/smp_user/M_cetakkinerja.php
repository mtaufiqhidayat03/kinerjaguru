<?php
class M_cetakkinerja extends CI_Model {

	function cek_tahun($tahun) {
		$sql="SELECT * FROM master_tahun where id_tahun=?";
		$query=$this->db->query($sql,array($tahun));
		return $query->result();
	}

	function tanggal_showdetail($tanggal)
	{
		$tgl1=explode("-",$tanggal);
		switch($tgl1[1])
		{
			case "1":
			$bulan="Januari";
			break;
			
			case "2":
			$bulan="Februari";
			break;
			
			case "3":
			$bulan="Maret";
			break;
			
			case "4":
			$bulan="April";
			break;
			
			case "5":
			$bulan="Mei";
			break;
			
			case "6":
			$bulan="Juni";
			break;
			
			case "7":
			$bulan="Juli";
			break;
			
			case "8":
			$bulan="Agustus";
			break;
			
			case "9":
			$bulan="September";
			break;
			
			case "10":
			$bulan="Oktober";
			break;
			
			case "11":
			$bulan="November";
			break;
			
			case "12":
			$bulan="Desember";
			break;
			
			default:
			$bulan="";
			break;
		}
		$tgl2=$tgl1[2]." ".$bulan." ".$tgl1[0];
		return $tgl2;
	}

	function getdataguru($nuptk){
        $sql="SELECT * FROM `".M_GURU_SMP."` where nuptk=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatajenisguru($nuptk){
        $sql="SELECT * FROM `".D_GURU_SMP.$this->session->userdata("tahun")."` where nuptk_guru_smp=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdataassesor($nuptk){
        $sql="SELECT nuptk_assesor, nama_guru FROM `".D_ASSESOR_SMP.$this->session->userdata("tahun")."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_assesor=b.nuptk where tugas_assesor=?";
        $query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatasekolah($nuptk) {
		$sql= "SELECT * FROM `".D_GURU_SMP.$_SESSION["tahun"]."` as a left join `".M_SMP."` as b ON b.npsn_nss=a.npsn_nss_guru_smp left join master_daerah as c on b.no_daerah=c.no_daerah where nuptk_guru_smp=?";
		$query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

	function getdatakepalasekolah($npsn_nss) {
		$sql= "SELECT * FROM `".D_SMP.$_SESSION["tahun"]."` as a left join `".M_GURU_SMP."` as b ON b.nip=a.nip_kepala where npsn_nss_smp=?";
		$query=$this->db->query($sql,array($npsn_nss));
        return $query->result();
	}

	function getdaerah($no_daerah) {
        $sql="SELECT * FROM master_daerah where no_daerah=?";
        $query=$this->db->query($sql,array($no_daerah));
        return $query->result();
	}
	
	function getdatacetakkinerja($id_kompetensi, $id_kelompok) {
		$sql="SELECT * FROM `".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok where b.id_kompetensi=? and c.id_kelompok=?";
		$query=$this->db->query($sql,array($id_kompetensi, $id_kelompok));
		return $query->result();
	}

	function getdatagurukompetensi($nuptk) {
		$sql="SELECT * FROM `".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_GURU_SMP.$_SESSION["tahun"]."` as a ON c.hub_jenis_guru=a.jenis_guru and FIND_IN_SET(a.detail_guru,c.hub_detail_guru) where a.nuptk_guru_smp=?";
		$query=$this->db->query($sql,array($nuptk));
		return $query->result();
	}

	function getdatacetakkinerja2($id_kompetensi, $id_kelompok, $nuptk) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_smp where b.id_kompetensi=? and c.id_kelompok=? and d.nuptk_penilaian_smp=? order by no_urut_indikator ASC";
		$query=$this->db->query($sql,array($id_kompetensi, $id_kelompok, $nuptk));
		return $query->result();
	}

	function getdatacetakkinerja3($id_kelompok) {
		$sql="SELECT * FROM `".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok where c.id_kelompok=?";
		$query=$this->db->query($sql,array($id_kelompok));
		return $query->result();
	}

	function getdatacetakkinerja4( $id_kelompok, $nuptk) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_smp where c.id_kelompok=? and d.nuptk_penilaian_smp=? order by no_urut_indikator ASC";
		$query=$this->db->query($sql,array($id_kelompok, $nuptk));
		return $query->result();
	}

	function getdatacetakkinerja5( $id_kelompok, $nuptk) {
		$sql="SELECT * FROM `".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` as d ON a.id_indikator=d.id_indikator_penilaian_smp where c.id_kelompok=? and d.nuptk_penilaian_smp=? group by no_urut_kompetensi ASC";
		$query=$this->db->query($sql,array($id_kelompok, $nuptk));
		return $query->result();
	}

	function getdatahasilkuisioner($nuptk) {
		$sql="SELECT nama_kuisioner, no_kuisioner, id_kelompok_kuisioner_smp, kelompok_kompetensi, nilai_kuisioner, nama_guru, id_kuisioner, nuptk_kuisioner_smp, upload_file_kuisioner_smp FROM `".D_KUISIONER_SMP.$this->session->userdata('tahun')."` as a left join `".M_KUISIONER_SMP."` as b ON a.id_kuisioner_smp=b.id_kuisioner left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kuisioner_smp=c.id_kelompok left join `".M_GURU_SMP."` as d ON a.nuptk_kuisioner_smp=d.nuptk where nuptk=?";
		$query=$this->db->query($sql,array($nuptk));
		return $query->result();
	}

	function cetakkinerja_list($nuptk) {
		$queryku = $this->db->get_where(D_GURU_SMP.$this->session->userdata('tahun'), array('nuptk_guru_smp' => $nuptk));
        $rowku = $queryku->row_array();
		$jenis_guru = $rowku['jenis_guru'];
		$detail_guru = $rowku['detail_guru'];
		$db = get_instance()->db->conn_id;
		$params = $_REQUEST;
		$aColumns = array('id_kompetensi','id_indikator','kelompok_kompetensi','nama_kompetensi','if(count(id_indikator) = (select count(skor) from `'.D_PENILAIAN_SMP.$this->session->userdata("tahun").'` where id_kompetensi_penilaian_smp=id_kompetensi and nuptk_penilaian_smp="'.$nuptk.'"),"<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Kompetensi selesai dinilai</span>","<span class=\"kt-badge kt-badge--inline kt-badge--danger\"><i class=\"flaticon2-delete\"></i>Kompetensi belum selesai dinilai</span>") as hitung','id_indikator','id_kelompok','no_urut_kompetensi','no_urut_indikator');
		$sIndexColumn = "b.id_kompetensi";
		//$sTable = "`".M_INDIKATOR_SMP."` as a left join `".M_KOMPETENSI_SMP."` as b ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET(".$detail_guru.",c.hub_detail_guru) where nuptk_guru_smp='".$nuptk."'".$sWhere." group by id_kompetensi";
		$sTable = "`".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".M_INDIKATOR_SMP."` as a ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET('".$detail_guru."',c.hub_detail_guru) where nuptk_guru_smp='".$nuptk."'".$sWhere." group by id_kompetensi";
		$sTable2 = "`".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".M_INDIKATOR_SMP."` as a ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET('".$detail_guru."',c.hub_detail_guru) where nuptk_guru_smp='".$nuptk."'".$sWhere;
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

		//$sWhere = "where nuptk_guru_smp=".$nuptk;

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
		$sQuery = "SELECT COUNT(DISTINCT ".$sIndexColumn.") as 'Count' FROM  $sTable2";
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
                    if ($aRow['hitung'] == "<span class=\"kt-badge kt-badge--inline kt-badge--success\"><i class=\"flaticon2-checkmark\"></i>Kompetensi selesai dinilai</span>") {
                    $row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a href='cetakkinerja/cetakpenilaian?id_kelompok=".$aRow['id_kelompok']."&id_kompetensi=".$aRow['id_kompetensi']."' data-target='#' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='upload-file' data-id='".$aRow['id_indikator']."'><i class='fa fa-file-pdf'></i> Cetak PDF Penilaian&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Komptensi</a>
					</div>";
                    } else {
					$row[] = "<div class='btn-group-vertical center' role='group' style='white-space: nowrap !important;'>
					<a href='' data-target='#' class='btn btn-danger btn-sm btnku btn-elevate btn-elevate-air disabled' id='upload-file' data-id='".$aRow['id_indikator']."'><i class='fa fa-times'></i> Penilaian Kompetensi&nbsp;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Belum Selesai</a>
					</div>";
					}
				}
				else if ( $i == 4)
				{
					$row[] = $aRow['hitung'];
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
