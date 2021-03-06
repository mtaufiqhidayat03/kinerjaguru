<?php
class M_sekolahuser extends CI_Model {
    
    function getdatasekolah($npsn_nss){
        $sql="SELECT * FROM `".M_SMP."` as a left join master_daerah as b on a.no_daerah=b.no_daerah where npsn_nss=?";
        $query=$this->db->query($sql,array($npsn_nss));
        return $query->result();
	}
	
    function getdatasekolah2($nuptk) {
		$sql= "SELECT * FROM `".D_GURU_SMP.$_SESSION["tahun"]."` as a left join `".M_SMP."` as b ON b.npsn_nss=a.npsn_nss_guru_smp left join master_daerah as c on b.no_daerah=c.no_daerah where nuptk_guru_smp=?";
		$query=$this->db->query($sql,array($nuptk));
        return $query->result();
	}

    function prov(){
        $query=$this->db->query("SELECT nama_provinsi FROM master_daerah group by nama_provinsi");
        return $query->result();
	}

	function datagurusmp($search, $page){
		$array = array('nama_guru' => $search, 'nip' => $search);
		$this->db->or_like($array);
		if ($page == 1) {
			$pageku = $page - 1;
            $this->db->limit($page*10, $pageku);
        } else if ($page > 1) {
			$pageku = ($page - 1) * 10;
			$this->db->limit($page*10, $pageku);
		}		
		$query2=$this->db->get(M_GURU_SMP);
        return $query2->result();
	}
	
	function datagurusmpmengajar($search, $page, $id_kelompok){
		$query3 = $this->db->get_where(M_KELOMPOK_KOMPETENSI_SMP, array('id_kelompok' => $id_kelompok));
		foreach ($query3->result() as $brs) {
			$jenis_guru = $brs->hub_jenis_guru;
			$detail_guru = $brs->hub_detail_guru;
		}
		if ($jenis_guru =="Guru Kelas") {
			$tambahan = " and FIND_IN_SET(detail_guru,'$detail_guru')";
		} else {
			$tambahan = "";
		}
		if ($page == 1) {
		$pageku = $page - 1;
		$page2 = $page*10;
		$sQuery = "SELECT b.nuptk, b.nama_guru FROM `".D_GURU_SMP.$this->session->userdata('tahun')."` as a left join `".M_GURU_SMP."` as b ON b.nuptk=a.nuptk_guru_smp and jenis_guru='".$jenis_guru."'".$tambahan." where nama_guru like '%".$search."%' or nuptk like '%".$search."%' LIMIT ".$pageku.",".$page2;
		} else if ($page > 1) {
		$pageku = ($page - 1) * 10;
		$page2 = $page*10;
		$sQuery = "SELECT b.nuptk, b.nama_guru FROM `".D_GURU_SMP.$this->session->userdata('tahun')."` as a left join `".M_GURU_SMP."` as b ON b.nuptk=a.nuptk_guru_smp and jenis_guru='".$jenis_guru."'".$tambahan." where nama_guru like '%".$search."%' or nuptk like '%".$search."%' LIMIT ".$pageku.",".$page2;
		}
		$query=$this->db->query($sQuery);
		return $query->result();
    }
    
    function kotakab($nama_provinsi){
        $sql="SELECT nama_kota_kab FROM master_daerah where nama_provinsi=? group by nama_kota_kab";
        $query=$this->db->query($sql,array($nama_provinsi));
        return $query->result();
    }
    
    function kecamatan($nama_provinsi,$nama_kotakab){
        $sql="SELECT nama_kec FROM master_daerah where nama_provinsi=? and nama_kota_kab=? group by nama_kec";
        $query=$this->db->query($sql,array($nama_provinsi, $nama_kotakab));
        return $query->result();
    }
    
    function kelurahan($nama_provinsi,$nama_kotakab,$nama_kec){
        $sql="SELECT nama_desa_kel FROM master_daerah where nama_provinsi=? and nama_kota_kab=? and nama_kec=? group by nama_desa_kel";
        $query=$this->db->query($sql,array($nama_provinsi, $nama_kotakab, $nama_kec));
        return $query->result();
    }
    
    function no_daerah($nama_provinsi,$nama_kotakab,$nama_kec,$nama_desa_kel){
        $sql="SELECT no_daerah FROM master_daerah where nama_provinsi=? and nama_kota_kab=? and nama_kec=? and nama_desa_kel=?";
        $query=$this->db->query($sql,array($nama_provinsi, $nama_kotakab, $nama_kec,$nama_desa_kel));
        return $query->result();
    }
    function getdaerah($no_daerah) {
        $sql="SELECT * FROM master_daerah where no_daerah=?";
        $query=$this->db->query($sql,array($no_daerah));
        return $query->result();
    }
    
    function updatesekolah($data_sekolah,$npsn_nss) {
        $this->db->where('npsn_nss', $npsn_nss);
        $this->db->update(M_SMP, $data_sekolah);
	}
	
    function updatekepalasekolah($data_kepala) {
		$this->db->insert("`".D_SMP.$this->session->userdata('tahun')."`", $data_kepala);
	}
	
    function deletesekolah($npsn_nss){
        $this->db->where('npsn_nss', $npsn_nss);
        $this->db->delete(M_SMP);
	}
	
	function deletekepalasekolah($npsn_nss){
        $this->db->where('npsn_nss_smp', $npsn_nss);
        $this->db->delete("`".D_SMP.$this->session->userdata('tahun')."`");
    }
    
    function addsekolah($data_sekolah) {
        $this->db->insert(M_SMP, $data_sekolah);
    }
    
    function sekolah_list($npsn_nss) {
	$db = get_instance()->db->conn_id;
	$params = $_REQUEST;
	$aColumns = array('npsn_nss','npsn_nss', 'npsn_nss', 'nama_guru', 'nip_kepala', 'nama_sekolah', 'telp_fax', 'nama_desa_kel', 'nama_kec', 'nama_kota_kab', 'nama_provinsi');
	$sIndexColumn = "a.npsn_nss";
	$sTable = "`".M_SMP."` as a left join master_daerah as b ON a.no_daerah=b.no_daerah left join `".D_SMP.$_SESSION["tahun"]."`  as a1 ON a.npsn_nss=a1.npsn_nss_smp left join `".M_GURU_SMP."` as c ON a1.nip_kepala=c.nip";
	/*  Paging */
	$sLimit = "";
	if ($this->input->post('start') !== "" && $this->input->post('length') != '-1' )
	{
		$sLimit .= "LIMIT ".mysqli_real_escape_string($db,$this->input->post('start')).", ".
			mysqli_real_escape_string($db,$this->input->post('length'));
	}	

	//$sOrder =  " ORDER BY `". $aColumns[$params['order'][0]['column']]."` ".$params['order'][0]['dir']."";
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
	$sWhere = "where npsn_nss='".$npsn_nss."' ";
	if (!empty($params['search']['value']))
	{
		$sWhere .= "and (";
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
	$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM  $sTable where npsn_nss='".$npsn_nss."'";
	$rResultTotal = $this->db->query($sQuery);
	$aResultTotal = $rResultTotal->row()->Count;
	$iTotal = $aResultTotal;
	/* Output	 */
	$output = array(
		"sEcho" => intval($params['draw']),   
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
					if ($this->session->userdata("level") == "Kepsek") {
                	$row[] = "<div class='btn-group-vertical' role='group'>
					<a data-toggle='modal' href='sekolah/form_editsekolah?npsn_nss=".$aRow['npsn_nss']."' data-target='#edit_data' class='btn btn-info btn-sm btnku btn-elevate btn-elevate-air' id='edit-data' data-id='".$aRow['npsn_nss']."'><i class='fa fa-pen'></i> Edit Data</a>
					<a href='guru?npsn_nss=".$aRow['npsn_nss']."' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' data-target='#cek_data' id='cek_data' data-id='".$aRow['npsn_nss']."'><i class='fa fa-search-plus'></i> Tampilkan Guru</a></div>
					";
					} else {
					$row[] = "<div class='btn-group-vertical' role='group'>
					<a href='guru?npsn_nss=".$aRow['npsn_nss']."' class='btn btn-dark btn-sm btnku btn-elevate btn-elevate-air' data-target='#cek_data' id='cek_data' data-id='".$aRow['npsn_nss']."'><i class='fa fa-search-plus'></i> Tampilkan Guru</a></div>
					";
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
