<?php
class Hasilkuisioner extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SMP.'m_hasilkuisioneradmin');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) {
                $this->load->view(FOLDER_SMP.'datahasilkuisioner');
            } else {
				show_404();
			}
        }
	}

	function form_hapushasilkuisioner() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $no_kuisioner = $this->input->get('no_kuisioner');
		  $data['n2'] = $this->m_hasilkuisioneradmin->getdatahasilkuisioner($no_kuisioner);
		  $this->load->view(FOLDER_SMP.'form_hapushasilkuisioner', $data);
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
		  $data['n2'] = $this->m_hasilkuisioneradmin->getdatahasilkuisioner3($no_kuisioner);
		  $this->load->view(FOLDER_SMP.'form_lihatpdfkuisioner', $data);
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
		  $data['n2'] = $this->m_hasilkuisioneradmin->getdatahasilkuisioner2($no_kuisioner);
		  $this->load->view(FOLDER_SMP.'form_gantiuploadfile', $data);
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
                $query = $this->db->get_where(D_KUISIONER_SMP.$this->session->userdata('tahun'), array('no_kuisioner' => $no_kuisioner));
                if ($query->num_rows() == 1) {
                    $queryku = $this->db->get_where(D_KUISIONER_SMP.$this->session->userdata('tahun'), array('no_kuisioner' => $no_kuisioner));
                    $rowku = $queryku->row_array();
                    $file = $rowku['upload_file_kuisioner_smp'];
                    if (is_readable($file) && unlink($file)) {
                        $data = $this->m_hasilkuisioneradmin->deletehasilkuisioner($no_kuisioner);
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
			$nuptk_guru_smp=$this->input->post('edit_guru');			
			$query = $this->db->get_where(D_KUISIONER_SMP.$this->session->userdata('tahun'), array('id_kuisioner_smp' => $id_kuisioner,'nuptk_kuisioner_smp' => $nuptk_guru_smp,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$queryku = $this->db->get_where(D_KUISIONER_SMP.$this->session->userdata('tahun'), array('id_kuisioner_smp' => $id_kuisioner,'nuptk_kuisioner_smp' => $nuptk_guru_smp,'no_kuisioner' => $no_kuisioner));
            $rowku = $queryku->row_array();
            $file = $rowku['upload_file_kuisioner_smp'];
            if (is_readable($file) && unlink($file)) {
			$new_name ="kuisioner_tahun_".$this->session->userdata('tahun')."_id_".$id_kuisioner."_nuptk_".$nuptk_guru_smp."_tanggal_".date("d-m-Y")."_jam_".date("H-i-s");
			$config['upload_path']          = './kuisioner/smp/'.$this->session->userdata('tahun').'/'.$nuptk_guru_smp.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1048576;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} else {
			$data_kuisioner = array(
				'upload_file_kuisioner_smp'=>$config['upload_path'].$this->upload->data('file_name')
			);
            $data = $this->m_hasilkuisioneradmin->editpenilaiankuisioner($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_smp);
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
		  $data['n2'] = $this->m_hasilkuisioneradmin->getdatahasilkuisioner2($no_kuisioner);
		  $this->load->view(FOLDER_SMP.'form_gantinilaikuisioner', $data);
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
			$nuptk_guru_smp=$this->input->post('edit_guru');		
			$nilai_kuisioner=$this->input->post('editnilai_kuisioner');		
			$query = $this->db->get_where(D_KUISIONER_SMP.$this->session->userdata('tahun'), array('id_kuisioner_smp' => $id_kuisioner,'nuptk_kuisioner_smp' => $nuptk_guru_smp,'no_kuisioner' => $no_kuisioner));
			if ($query->num_rows() == 1) {
			$data_kuisioner = array(
				'nilai_kuisioner'=>$nilai_kuisioner
			);
			$data = $this->m_hasilkuisioneradmin->editpenilaiankuisioner2($data_kuisioner, $no_kuisioner, $id_kuisioner, $nuptk_guru_smp);
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
                $data = $this->m_hasilkuisioneradmin->hasilkuisioner_list();
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
