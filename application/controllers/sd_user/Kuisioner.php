<?php
class Kuisioner extends CI_Controller {

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

	function form_uploadfile(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kuisioner=$this->input->get('id_kuisioner');
            $data['n2'] = $this->m_kuisioneruser->getdatakuisioner2($id_kuisioner);
            $this->load->view(FOLDER_SD_USER.'form_uploadfile', $data);
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
			$nuptk_guru_sd=$this->input->post('edit_guru');
			$nilai_kuisioner=$this->input->post('nilai_kuisioner');
			$query = $this->db->get_where(D_KUISIONER_SD.$this->session->userdata('tahun'), array('id_kuisioner_sd' => $id_kuisioner,'nuptk_guru_sd' => $nuptk_guru_sd));
			if ($query->num_rows() == 0) {
			$new_name ="kuisioner_tahun_".$this->session->userdata('tahun')."_id_".$id_kuisioner."_nuptk_".$nuptk_guru_sd;
			$config['upload_path']          = './kuisioner/sd/'.$this->session->userdata('tahun').'/'.$nuptk_guru_sd.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1572864;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} 
			$data_kuisioner = array(
				'id_kuisioner_sd'=>$id_kuisioner,
				'nuptk_guru_sd'=>$nuptk_guru_sd,
				'nilai_kuisioner'=>$nilai_kuisioner,
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

	function ajax_data_kuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $data = $this->m_kuisioneruser->kuisioner_list();
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
