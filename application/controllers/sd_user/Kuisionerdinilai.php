<?php
class Kuisionerdinilai extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model(FOLDER_SD_USER.'m_kuisionerdinilai');   
        
    }
    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("Login"));
        } else {
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") { 
              $data['n20'] = $this->m_assesoruser->namasekolah($npsn_nss); 
			  $this->load->view(FOLDER_SD_USER.'datakuisionerdinilai', $data);  
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SD_USER.'datakuisionerdinilai');
            }
        }
	}
        
    function form_addassesor(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        { 
            $this->load->view(FOLDER_SD_USER.'form_addassesor');
        } else {
            $this->load->view('v_sesiberakhir');
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
            $this->load->view(FOLDER_SD_USER.'form_persetujuankinerja', $data);
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
			$nuptk_guru_sd= $this->input->post('nuptk');
			$skor= $this->input->post('skor');
			$query = $this->db->get_where(D_PENILAIAN_SD.$this->session->userdata('tahun'), array('id_indikator_penilaian_sd' => $id_indikator,'nuptk_penilaian_sd' => $nuptk_guru_sd));
			if ($query->num_rows() == 1) {
				$data_persetujuan = array(
					'skor'=>$skor,
				);
				$data = $this->m_kinerjadinilai->persetujuankinerja($data_persetujuan, $id_indikator, $nuptk_guru_sd);
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
            $this->load->view(FOLDER_SD_USER.'form_hapusassesor', $data);
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
	
	function form_lihatpdfkuisionerdinilai() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->get('id_kuisioner');
			$id_kelompok=$this->input->get('id_kelompok');
			$nuptk= $this->input->get('nuptk');
			$no_kuisioner = $this->input->get('no_kuisioner');
		  	$data['n2'] = $this->m_kuisionerdinilai->getdatahasilkuisioner3($no_kuisioner, $nuptk);
		  	$this->load->view(FOLDER_SD_USER.'form_lihatpdfkuisionerdinilai', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function form_persetujuankuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->get('id_kuisioner');
			$id_kelompok=$this->input->get('id_kelompok');
			$nuptk= $this->input->get('nuptk');
			$no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_kuisionerdinilai->getdatahasilkuisioner2($no_kuisioner,$nuptk);
		  $this->load->view(FOLDER_SD_USER.'form_persetujuankuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function aksipersetujuankuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$no_kuisioner=$this->input->post('no_kuisioner');
			$id_kuisioner=$this->input->post('editid_kuisioner');
			$nuptk_guru_sd=$this->input->post('edit_guru');		
			$nilai_kuisioner=$this->input->post('editnilai_kuisioner');		
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_kuisioner_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$data_kuisioner = array(
				'nilai_kuisioner'=>$nilai_kuisioner
			);
			$data = $this->m_kuisionerdinilai->editpenilaiankuisioner2($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_sd);
			if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diedit";
			} else {
				echo $data;
			}
			} else {
				echo "Penilaian kuisioner tidak ditemukan";
			}	
		} else {
			echo "session_expired";
		}
		} else {
			show_404();
		}
	}

    function ajax_data_kuisionerdinilai() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$nuptk = $this->session->userdata('username');
            $data = $this->m_kuisionerdinilai->dinilai_list($nuptk);         
            echo json_encode($data);
        } else {
            show_404();
        }
	}

	function ajax_data_kuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$nuptk = $this->input->get("nuptk");
				$data = $this->m_kuisionerdinilai->kinerja_list($nuptk);
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