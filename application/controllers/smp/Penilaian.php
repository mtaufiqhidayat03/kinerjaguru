<?php
class Penilaian extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(FOLDER_SMP.'m_penilaianadmin');        
	}

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) {
                $this->load->view(FOLDER_SMP.'datapenilaian');
            } else {
				show_404();
			}
        }
	}

	function ajax_data_penilaian() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$data = $this->m_penilaianadmin->penilaian_list();
                echo json_encode($data);
            }
			else {
				show_404();
			}
        } else {
            show_404();
        }
	}

	function form_lihatpdfpenilaian() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$id_kelompok=$this->input->get('id_kelompok');
			$id_kompetensi=$this->input->get('id_kompetensi');
			$nuptk= $this->input->get('nuptk');
			$id_penilaian= $this->input->get('id_penilaian');
			$data['n2'] = $this->m_penilaianadmin->getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk, $id_penilaian);
			$data['n1'] = $this->m_penilaianadmin->getdataguru($nuptk);
		  	$this->load->view(FOLDER_SMP.'form_lihatpdfpenilaian', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function form_hapuspenilaian() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		$id_indikator=$this->input->get('id_indikator');
		$id_kompetensi=$this->input->get('id_kompetensi');
		$nuptk= $this->input->get("nuptk");
		$id_penilaian= $this->input->get("id_penilaian");
		$data['n2'] = $this->m_penilaianadmin->getdatakinerja3($id_indikator, $id_kompetensi, $nuptk, $id_penilaian);
		$data['n1'] = $this->m_penilaianadmin->getdataguru($nuptk);
		$this->load->view(FOLDER_SMP.'form_hapuspenilaian', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	}

	function aksihapuspenilaian() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$id_indikator=$this->input->post('id_indikator');
				$id_penilaian= $this->input->post("id_penilaian");
				$nuptk_guru_smp= $this->input->post("nuptk_penilaian_smp");
                $query = $this->db->get_where(D_PENILAIAN_SMP.$this->session->userdata('tahun'), array('id_indikator_penilaian_smp' => $id_indikator,'nuptk_penilaian_smp' => $nuptk_guru_smp,'id_penilaian' => $id_penilaian));
                if ($query->num_rows() == 1) {
                    $queryku = $this->db->get_where(D_PENILAIAN_SMP.$this->session->userdata('tahun'), array('id_indikator_penilaian_smp' => $id_indikator,'nuptk_penilaian_smp' => $nuptk_guru_smp,'id_penilaian' => $id_penilaian));
           			$rowku = $queryku->row_array();
					$file = $rowku['upload_file_penilaian_smp'];
                    if (is_readable($file) && unlink($file)) {
                        $data = $this->m_penilaianadmin->deletehasilpenilaian($id_indikator, $nuptk_guru_smp, $id_penilaian);
                        if ($this->db->affected_rows() != 1) {
                            echo "Tidak ada data yang berhasil dihapus";
                        } else {
                            echo $data;
                        }
                    } else {
                        echo "Proses penghapusan data gagal dilakukan";
                    }
                } else {
                    echo "Penilaian kinerja tidak ditemukan";
                }
            } else {
                echo "session_expired";
            }
        } else {
            show_404();
        }
	}

}
?>