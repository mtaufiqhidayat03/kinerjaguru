<?php
class Assesor extends CI_Controller {
    function __construct() {
		parent::__construct();

            $this->load->model(FOLDER_SD.'m_assesoradmin');

    }
    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("Login"));
        } else {
		if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) {
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") {
                $data['n20'] = $this->m_assesoradmin->namasekolah($npsn_nss);
                $this->load->view(FOLDER_SD.'dataassesor', $data);
            } else {
                $data['n20'] = "";
                $this->load->view(FOLDER_SD.'dataassesor');
            }
        } else {
			show_404();
		}
        }
    }
        
    function form_addassesor(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        { 
            $this->load->view(FOLDER_SD.'form_addassesor');
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
    }
    
    function aksiaddassesor(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		$nuptk_assesor=$this->input->post('assesor');
		$tugas_assesor=$this->input->post('guru_dinilai');
        $query = $this->db->get_where(D_ASSESOR_SD.$this->session->userdata("tahun"), array('nuptk_assesor' => $nuptk_assesor, 'tugas_assesor' => $tugas_assesor));
            if ($query->num_rows() == 0) {
            $data_assesor = array(
                'nuptk_assesor'=>$this->input->post('assesor'),
                'tugas_assesor'=>$this->input->post('guru_dinilai'),
            );
            $data = $this->m_assesoradmin->addassesor($data_assesor);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
                }
            } else {
             echo "Guru sudah mendapatkan assesor";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
	}
	
    function ambildataassesor(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) 
		{
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$search = $this->input->get('search');
		$page = $this->input->get('page');
		$data = $this->m_assesoradmin->dataassesor($search, $page);
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
		$sIndexColumn = "nuptk_guru_sd";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SD.$this->session->userdata('tahun')."` as a left join `".M_GURU_SD."` as b ON a.nuptk_guru_sd=b.nuptk where nuptk like '%".$search."%' or nama_guru like '%".$search."%'";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SD.$this->session->userdata('tahun')."` as a left join `".M_GURU_SD."` as b ON a.nuptk_guru_sd=b.nuptk";
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
		$queryku = $this->db->get_where(D_GURU_SD.$this->session->userdata('tahun'), array('nuptk_guru_sd' => $assesor));
		$rowku = $queryku->row_array();
		$npsn_nss_assesor=$rowku['npsn_nss_guru_sd'];
		$data = $this->m_assesoradmin->datagurudinilai($search, $page, $assesor, $npsn_nss_assesor);
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
		$sIndexColumn = "nuptk_guru_sd";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SD.$this->session->userdata('tahun')."` as a left join `".M_GURU_SD."` as b ON a.nuptk_guru_sd=b.nuptk where npsn_nss_guru_sd='".$npsn_nss_assesor."' and nuptk_guru_sd !='".$assesor."' and npsn_nss_guru_sd ='".$npsn_nss_assesor."'  and (nuptk like '%".$search."%' or nama_guru like '%".$search."%')";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SD.$this->session->userdata('tahun')."` as a left join `".M_GURU_SD."` as b ON a.nuptk_guru_sd=b.nuptk where npsn_nss_guru_sd = '".$npsn_nss_assesor."' and nuptk_guru_sd !='".$assesor."' and npsn_nss_guru_sd ='".$npsn_nss_assesor."'";
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

    function form_hapusassesor() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$id_assesor = $this->input->get('id_assesor');
			$data['n2'] = $this->m_assesoradmin->getdataassesor($id_assesor);
            $this->load->view(FOLDER_SD.'form_hapusassesor', $data);
        } else {
            show_404();
        }
    }
    
    function aksihapusassesor(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $id_assesor = $this->input->post('id_assesor');
        $query = $this->db->get_where(D_ASSESOR_SD.$this->session->userdata("tahun"), array('id_assesor' => $id_assesor));
            if ($query->num_rows() == 1) {
            $data = $this->m_assesoradmin->deleteassesor($id_assesor);
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
    
    
    function ajax_data_assesor() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") { 
            $data = $this->m_assesoradmin->assesor_list($npsn_nss);
            } 
            else {
            $npsn_nss = "";
            $data = $this->m_assesoradmin->assesor_list($npsn_nss);
            }             
            echo json_encode($data);
        } else {
            show_404();
        }
    }
}
?>