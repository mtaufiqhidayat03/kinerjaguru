<?php
class Kuisioneruser extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_kuisioneruser');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            $this->load->view(FOLDER_SD_USER.'datakuisioner' );
        }
	}

	function form_addkuisioner(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            $this->load->view(FOLDER_SD_USER.'form_addkuisioner');
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}
	
	function aksiaddkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$data_kuisioner = array(
				'id_kelompok_kuisioner_sd'=>$this->input->post('kelompok_kompetensi'),
				'nama_kuisioner'=>$this->input->post('nama_kuisioner'),
            );
            $data = $this->m_kuisioneruser->addkuisioner($data_kuisioner);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
				}	
		} else {
			echo "session_expired";
		}
		} else {
			show_404();
		}
	}

	function form_editkuisioner(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->get('id_kuisioner');
            $data['n2'] = $this->m_kuisioneruser->getdatakuisioner($id_kuisioner);
            $this->load->view(FOLDER_SD_USER.'form_editkuisioner', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function form_uploadfilekuisioner(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->get('id_kuisioner');
			$nuptk=$this->session->userdata("username");
			$data['n2'] = $this->m_kuisioneruser->getdatakuisioner2($id_kuisioner);
			$data['n1'] = $this->m_kuisioneruser->getdataguru($nuptk);
            $this->load->view(FOLDER_SD_USER.'form_uploadfilekuisioner', $data);
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
		  $data['n2'] = $this->m_kuisioneruser->getdatahasilkuisioner3($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_lihatpdfkuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	function aksieditkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->post('editid_kuisioner');
			$query = $this->db->get_where(M_KUISIONER_SD, array('id_kuisioner' => $id_kuisioner));
			if ($query->num_rows() == 1) {
				$data_kuisioner = array(
					'id_kelompok_kuisioner_sd'=>$this->input->post('editkelompok_kompetensi'),
					'nama_kuisioner'=>$this->input->post('editnama_kuisioner'),
				);
				$data = $this->m_kuisioneruser->updatekuisioner($data_kuisioner,$id_kuisioner);
				if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diubah";
				} else {
				echo $data;
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

	function form_hapuskuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $id_kuisioner = $this->input->get('id_kuisioner');
		  $data['n2'] = $this->m_kuisioneruser->getdatakuisioner($id_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_hapuskuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	function aksihapuskuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
			$id_kuisioner=$this->input->post('id_kuisioner');
			$query = $this->db->get_where(M_KUISIONER_SD, array('id_kuisioner' => $id_kuisioner));
			if ($query->num_rows() == 1) {
				$data = $this->m_kuisioneruser->deletekuisioner($id_kuisioner);
					if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil dihapus";
					} else {
					echo $data;
					}	
			} else {
				echo "Kuisioner tidak ditemukan";   
			}
		} else{
			echo "session_expired";
		}
	  	} else {
			show_404();
	  	}
	  }
	  
	  function aksiuploadfilekuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->post('editid_kuisioner');
			$nuptk_guru_sd=$this->input->post('editid_guru');
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_kuisioner_sd' => $nuptk_guru_sd));
			if ($query->num_rows() == 0) {
			$new_name ="kuisioner_tahun_".$this->session->userdata('tahun')."_id_".$id_kuisioner."_nuptk_".$nuptk_guru_sd."_tanggal_".date("d-m-Y")."_jam_".date("H-i-s");
			$config['upload_path']          = './kuisioner/sd/'.$this->session->userdata('tahun').'/'.$nuptk_guru_sd.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1048576;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} 
			$data_kuisioner = array(
				'id_kuisioner_sd'=>$id_kuisioner,
				'nuptk_kuisioner_sd'=>$nuptk_guru_sd,
				'upload_file_kuisioner_sd'=>$config['upload_path'].$this->upload->data('file_name'),
			);
            $data = $this->m_kuisioneruser->addpenilaiankuisioner($data_kuisioner);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
				}
			} else {
				echo "Penilaian kuisioner sudah pernah dilakukan";
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
		  $data['n2'] = $this->m_kuisioneruser->getdatahasilkuisioner2($no_kuisioner);
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
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_kuisioner_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$data_kuisioner = array(
				'nilai_kuisioner'=>$nilai_kuisioner
			);
			$data = $this->m_kuisioneruser->editpenilaiankuisioner2($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_sd);
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

	function form_hapushasilkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_kuisioneruser->getdatahasilkuisioner($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_hapushasilkuisioner', $data);
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
                        $data = $this->m_kuisioneruser->deletehasilkuisioner($no_kuisioner);
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

	function form_gantiuploadfilekuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_kuisioneruser->getdatahasilkuisioner2($no_kuisioner);
		  $this->load->view(FOLDER_SD_USER.'form_gantiuploadfilekuisioner', $data);
		} else {
            $this->load->view('v_sesiberakhir');
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
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_kuisioner_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$queryku = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_kuisioner_sd' => $nuptk_guru_sd,'no_kuisioner' => $no_kuisioner));
            $rowku = $queryku->row_array();
            $file = $rowku['upload_file_kuisioner_sd'];
            if (is_readable($file) && unlink($file)) {
			$new_name ="kuisioner_tahun_".$this->session->userdata('tahun')."_id_".$id_kuisioner."_nuptk_".$nuptk_guru_sd."_tanggal_".date("d-m-Y")."_jam_".date("H-i-s");
			$config['upload_path']          = './kuisioner/sd/'.$this->session->userdata('tahun').'/'.$nuptk_guru_sd.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1048576;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} else {
			$data_kuisioner = array(
				'upload_file_kuisioner_sd'=>$config['upload_path'].$this->upload->data('file_name')
			);
            $data = $this->m_kuisioneruser->editpenilaiankuisioner($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_sd);
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
	function ajax_data_kuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$nuptk = $this->session->userdata("username");
                $data = $this->m_kuisioneruser->kuisioner_list($nuptk);
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
