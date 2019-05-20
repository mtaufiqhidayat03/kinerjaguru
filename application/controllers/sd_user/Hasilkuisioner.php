<?php
class Hasilkuisioner extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_hasilkuisioneruser');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            $this->load->view(FOLDER_SD_USER.'datahasilkuisioner' );
        }
	}

	function form_hapushasilkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_hasilkuisioneruser->getdatahasilkuisioner($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_hapushasilkuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function form_lihatpdfkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_hasilkuisioneruser->getdatahasilkuisioner3($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_lihatpdfkuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function form_gantiuploadfile() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_hasilkuisioneruser->getdatahasilkuisioner2($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_gantiuploadfile', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	function aksihapushasilkuisioner() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $no_kuisioner=$this->input->post('no_kuisioner');
                $query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('no_kuisioner' => $no_kuisioner));
                if ($query->num_rows() == 1) {
                    $queryku = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('no_kuisioner' => $no_kuisioner));
                    $rowku = $queryku->row_array();
                    $file = $rowku['upload_file_kuisioner_sd'];
                    if (is_readable($file) && unlink($file)) {
                        $data = $this->m_hasilkuisioneruser->deletehasilkuisioner($no_kuisioner);
                        if ($this->db->affected_rows() != 1) {
                            echo "Tidak ada data yang berhasil dihapus";
                        } else {
                            echo $data;
                        }
                    } else {
                        echo "Proses penghapusan data gagal dilakukan";
                    }
                } else {
                    echo "Kuisioner tidak ditemukan";
                }
            } else {
                echo "session_expired";
            }
        } else {
            show_404();
        }
	}

	function aksigantiuploadkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$no_kuisioner=$this->input->post('no_kuisioner');
			$id_kuisioner=$this->input->post('editid_kuisioner');
			$nuptk_guru_sd=$this->input->post('edit_guru');			
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_guru_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$queryku = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_guru_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
            $rowku = $queryku->row_array();
            $file = $rowku['upload_file_kuisioner_sd'];
            if (is_readable($file) && unlink($file)) {
			$new_name ="kuisioner_tahun_".$this->session->userdata('tahun')."_id_".$id_kuisioner."_nuptk_".$nuptk_guru_sd;
			$config['upload_path']          = './kuisioner/sd/'.$this->session->userdata('tahun').'/'.$nuptk_guru_sd.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1572864;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} else {
			$data_kuisioner = array(
				'upload_file_kuisioner_sd'=>$config['upload_path'].$this->upload->data('file_name')
			);
            $data = $this->m_hasilkuisioneruser->editpenilaiankuisioner($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_sd);
			} 
			} else {
				echo "Proses edit data gagal dilakukan";
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

	function form_gantinilai() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_hasilkuisioneruser->getdatahasilkuisioner2($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_gantinilaikuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function aksigantinilaikuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$no_kuisioner=$this->input->post('no_kuisioner');
			$id_kuisioner=$this->input->post('editid_kuisioner');
			$nuptk_guru_sd=$this->input->post('edit_guru');		
			$nilai_kuisioner=$this->input->post('editnilai_kuisioner');		
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_guru_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$data_kuisioner = array(
				'nilai_kuisioner'=>$nilai_kuisioner
			);
			$data = $this->m_hasilkuisioneruser->editpenilaiankuisioner2($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_sd);
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
	
	function ajax_data_hasilkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $data = $this->m_hasilkuisioneruser->hasilkuisioner_list();
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
