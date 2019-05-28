<?php
class Kinerjadinilai extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model(FOLDER_SMP_USER.'m_kinerjadinilai');   
        
    }
    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("Login"));
        } else {
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") { 
              $data['n20'] = $this->m_assesoruser->namasekolah($npsn_nss); 
			  $this->load->view(FOLDER_SMP_USER.'datakinerjadinilai', $data);  
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SMP_USER.'datakinerjadinilai');
            }
        }
	}

    function ambildataassesor(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) 
		{
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$search = $this->input->get('search');
		$page = $this->input->get('page');
		$nuptk = $this->session->userdata("username");
		$queryku = $this->db->get_where(D_GURU_SMP.$this->session->userdata('tahun'), array('nuptk_guru_smp' => $nuptk));
		$rowku = $queryku->row_array();
		$npsn_nss_assesor=$rowku['npsn_nss_guru_smp'];
		$data = $this->m_assesoruser->dataassesor($search, $page, $npsn_nss_assesor);
		$key=0;
		$list = array();
		foreach ($data as $row)
		{
			$list[$key]['id'] = $row->nuptk;
         	$list[$key]['text'] = $row->nama_guru;
     		$key++;
		}
		$list2["results"] = $list;
		$list3 = array();
		$sIndexColumn = "nuptk_guru_smp";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SMP.$this->session->userdata('tahun')."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_guru_smp=b.nuptk where npsn_nss_guru_smp='".$npsn_nss_assesor."' and  (nuptk like '%".$search."%' or nama_guru like '%".$search."%')";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SMP.$this->session->userdata('tahun')."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_guru_smp=b.nuptk where npsn_nss_guru_smp='".$npsn_nss_assesor."'";
        }
		$rResultTotal = $this->db->query($sQuery);
		$aResultTotal = $rResultTotal->row()->Count;
		$iTotal = $aResultTotal;
		if(($iTotal - $page2) > 0 ) {
		$list3["more"] =true;
		} else {
		$list3["more"] =false;
		}
		$list2["pagination"] = $list3;
     	echo json_encode($list2);
		}
	} else {
		show_404();
	}
	}

	function ambildatagurudinilai(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) 
		{
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$search = $this->input->get('search');
		$page = $this->input->get('page');
		$assesor = $this->input->get('assesor');
		$queryku = $this->db->get_where(D_GURU_SMP.$this->session->userdata('tahun'), array('nuptk_guru_smp' => $assesor));
		$rowku = $queryku->row_array();
		$npsn_nss_assesor=$rowku['npsn_nss_guru_smp'];
		$data = $this->m_assesoruser->datagurudinilai($search, $page, $assesor, $npsn_nss_assesor);
		$key=0;
		$list = array();
		foreach ($data as $row)
		{
			$list[$key]['id'] = $row->nuptk;
         	$list[$key]['text'] = $row->nama_guru;
     		$key++;
		}
		$list2["results"] = $list;
		$list3 = array();
		$sIndexColumn = "nuptk_guru_smp";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SMP.$this->session->userdata('tahun')."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_guru_smp=b.nuptk where npsn_nss_guru_smp='".$npsn_nss_assesor."' and nuptk_guru_smp !='".$assesor."' and (nuptk like '%".$search."%' or nama_guru like '%".$search."%')";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SMP.$this->session->userdata('tahun')."` as a left join `".M_GURU_SMP."` as b ON a.nuptk_guru_smp=b.nuptk where npsn_nss_guru_smp = '".$npsn_nss_assesor."' and nuptk_guru_smp !='".$assesor."'";
        }
		$rResultTotal = $this->db->query($sQuery);
		$aResultTotal = $rResultTotal->row()->Count;
		$iTotal = $aResultTotal;
		if(($iTotal - $page2) > 0 ) {
		$list3["more"] =true;
		} else {
		$list3["more"] =false;
		}
		$list2["pagination"] = $list3;
     	echo json_encode($list2);
		}
	} else {
		show_404();
	}
	}

	function form_persetujuankinerja(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$id_kelompok=$this->input->get('id_kelompok');
			$id_kompetensi=$this->input->get('id_kompetensi');
			$nuptk= $this->input->get('nuptk');
			$data['n2'] = $this->m_kinerjadinilai->getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk);
			$data['n1'] = $this->m_kinerjadinilai->getdataguru($nuptk);
            $this->load->view(FOLDER_SMP_USER.'form_persetujuankinerja', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function aksipersetujuankinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator = $this->input->post('id_indikator');
			$id_kelompok = $this->input->post('id_kelompok');
			$id_kompetensi = $this->input->post('id_kompetensi');
			$nuptk_guru_smp= $this->input->post('nuptk');
			$skor= $this->input->post('skor');
			$query = $this->db->get_where(D_PENILAIAN_SMP.$this->session->userdata('tahun'), array('id_indikator_penilaian_smp' => $id_indikator,'nuptk_penilaian_smp' => $nuptk_guru_smp));
			if ($query->num_rows() == 1) {
				$data_persetujuan = array(
					'skor'=>$skor,
				);
				$data = $this->m_kinerjadinilai->persetujuankinerja($data_persetujuan, $id_indikator, $nuptk_guru_smp);
			if ($this->db->affected_rows() != 1) {
				echo "Proses persetujuan penilaian indikator kinerja gagal dilakukan";
			} else {
				echo $data;
			}

			} else {
				echo "Penilaian indikator kinerja tidak ditemukan";
			}	
		} else {
			echo "session_expired";
		}
		} else {
			show_404();
		}
	}

    function form_hapusassesor() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$id_assesor = $this->input->get('id_assesor');
			$data['n2'] = $this->m_assesoruser->getdataassesor($id_assesor);
            $this->load->view(FOLDER_SMP_USER.'form_hapusassesor', $data);
        } else {
            show_404();
        }
    }
    
    function aksihapusassesor(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $id_assesor = $this->input->post('id_assesor');
        $query = $this->db->get_where(D_ASSESOR_SMP.$this->session->userdata("tahun"), array('id_assesor' => $id_assesor));
            if ($query->num_rows() == 1) {
            $data = $this->m_assesoruser->deleteassesor($id_assesor);
                if ($this->db->affected_rows() != 1) {
                echo "Tidak ada data yang berhasil dihapus";
                } else {
                echo $data;
                }
            } else {
             echo "NUPTK tidak ditemukan";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
    }  
	
	function form_lihatpdfkinerjadinilai() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$id_kelompok=$this->input->get('id_kelompok');
			$id_kompetensi=$this->input->get('id_kompetensi');
			$nuptk= $this->input->get('nuptk');
			$data['n2'] = $this->m_kinerjadinilai->getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk);
			$data['n1'] = $this->m_kinerjadinilai->getdataguru($nuptk);
		  	$this->load->view(FOLDER_SMP_USER.'form_lihatpdfkinerjadinilai', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }
    
    function ajax_data_kinerjadinilai() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$nuptk = $this->session->userdata('username');
            $data = $this->m_kinerjadinilai->dinilai_list($nuptk);         
            echo json_encode($data);
        } else {
            show_404();
        }
	}

	function ajax_data_kinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$nuptk = $this->input->get("nuptk");
				$data = $this->m_kinerjadinilai->kinerja_list($nuptk);
                echo json_encode($data);
            }
			else {
				show_404();
			}
        } else {
            show_404();
        }
	}
}
?>