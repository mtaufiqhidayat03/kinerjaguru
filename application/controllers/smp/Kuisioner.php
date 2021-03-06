<?php
class Kuisioner extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SMP.'m_kuisioneradmin');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) {
                $this->load->view(FOLDER_SMP.'datakuisioner');
            } else {
				show_404();
			}
        }
	}

	function form_addkuisioner(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            $this->load->view(FOLDER_SMP.'form_addkuisioner');
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
				'id_kelompok_kuisioner_smp'=>$this->input->post('kelompok_kompetensi'),
				'nama_kuisioner'=>$this->input->post('nama_kuisioner'),
            );
            $data = $this->m_kuisioneradmin->addkuisioner($data_kuisioner);
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
            $data['n2'] = $this->m_kuisioneradmin->getdatakuisioner($id_kuisioner);
            $this->load->view(FOLDER_SMP.'form_editkuisioner', $data);
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
            $data['n2'] = $this->m_kuisioneradmin->getdatakuisioner2($id_kuisioner);
            $this->load->view(FOLDER_SMP.'form_uploadfile', $data);
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
			$query = $this->db->get_where(M_KUISIONER_SMP, array('id_kuisioner' => $id_kuisioner));
			if ($query->num_rows() == 1) {
				$data_kuisioner = array(
					'id_kelompok_kuisioner_smp'=>$this->input->post('editkelompok_kompetensi'),
					'nama_kuisioner'=>$this->input->post('editnama_kuisioner'),
				);
				$data = $this->m_kuisioneradmin->updatekuisioner($data_kuisioner,$id_kuisioner);
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
		  $data['n2'] = $this->m_kuisioneradmin->getdatakuisioner($id_kuisioner);
		  $this->load->view(FOLDER_SMP.'form_hapuskuisioner', $data);
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
			$query = $this->db->get_where(M_KUISIONER_SMP, array('id_kuisioner' => $id_kuisioner));
			if ($query->num_rows() == 1) {
				$data = $this->m_kuisioneradmin->deletekuisioner($id_kuisioner);
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
			$nuptk_guru_smp=$this->input->post('edit_guru');
			$nilai_kuisioner=$this->input->post('nilai_kuisioner');
			$query = $this->db->get_where(D_KUISIONER_SMP.$this->session->userdata('tahun'), array('id_kuisioner_smp' => $id_kuisioner,'nuptk_kuisioner_smp' => $nuptk_guru_smp));
			if ($query->num_rows() == 0) {
			$new_name ="kuisioner_tahun_".$this->session->userdata('tahun')."_id_".$id_kuisioner."_nuptk_".$nuptk_guru_smp."_tanggal_".date("d-m-Y")."_jam_".date("H-i-s");
			$config['upload_path']          = './kuisioner/smp/'.$this->session->userdata('tahun').'/'.$nuptk_guru_smp.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1048576;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} 
			$data_kuisioner = array(
				'id_kuisioner_smp'=>$id_kuisioner,
				'nuptk_kuisioner_smp'=>$nuptk_guru_smp,
				'nilai_kuisioner'=>$nilai_kuisioner,
				'upload_file_kuisioner_smp'=>$config['upload_path'].$this->upload->data('file_name'),
			);
            $data = $this->m_kuisioneradmin->addpenilaiankuisioner($data_kuisioner);
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
                $data = $this->m_kuisioneradmin->kuisioner_list();
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
