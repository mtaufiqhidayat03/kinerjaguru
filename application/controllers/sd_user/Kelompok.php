<?php
class Kelompok extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD.'m_kelompokadmin');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            $this->load->view(FOLDER_SD.'datakelompok' );
        }
	}
	

	function form_addkelompok(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            $this->load->view(FOLDER_SD.'form_addkelompok');
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}
	
	function aksiaddkelompok() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$data_kelompok = array(
                'kelompok_kompetensi'=>$this->input->post('nama_kelompok')
            );
            $data = $this->m_kelompokadmin->addkelompok($data_kelompok);
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

	function form_editkelompok(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kelompok=$this->input->get('id_kelompok');
            $data['n2'] = $this->m_kelompokadmin->getdatakelompok($id_kelompok);
            $this->load->view(FOLDER_SD.'form_editkelompok', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function form_hubkelompok(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kelompok=$this->input->get('id_kelompok');
            $data['n2'] = $this->m_kelompokadmin->getdatakelompok($id_kelompok);
            $this->load->view(FOLDER_SD.'form_hubkelompok', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function aksieditkelompok() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kelompok=$this->input->post('id_kelompok');
			$query = $this->db->get_where(M_KELOMPOK_KOMPETENSI_SD, array('id_kelompok' => $id_kelompok));
			if ($query->num_rows() == 1) {
				$data_kelompok = array(
					'kelompok_kompetensi'=>$this->input->post('editnama_kelompok')
				);
				$data = $this->m_kelompokadmin->updatekelompok($data_kelompok,$id_kelompok);
				if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diubah";
				} else {
				echo $data;
				}	
			} else {
				echo "Nama Kelompok Kompetensi tidak ditemukan"; 
			}
		} else {
            echo "session_expired";
        }
		} else {
			show_404();
		}
	}

	function aksiedithubkelompok() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kelompok=$this->input->post('id_kelompok');
			$query = $this->db->get_where(M_KELOMPOK_KOMPETENSI_SD, array('id_kelompok' => $id_kelompok));
			if ($query->num_rows() == 1) {
				$data_kelompok = array(
					'hub_jenis_guru'=>$this->input->post('jenis_guru'),
					'hub_detail_guru'=>$this->input->post('detail_guru'),
				);
				$data = $this->m_kelompokadmin->updatekelompok($data_kelompok,$id_kelompok);
				if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diubah";
				} else {
				echo $data;
				}	
			} else {
				echo "Nama Kelompok Kompetensi tidak ditemukan"; 
			}
		} else {
            echo "session_expired";
        }
		} else {
			show_404();
		}
	}


	function form_hapuskelompok() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $id_kelompok = $this->input->get('id_kelompok');
		  $data['n2'] = $this->m_kelompokadmin->getdatakelompok($id_kelompok);
		  $this->load->view(FOLDER_SD.'form_hapuskelompok', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	function aksihapuskelompok() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
			$id_kelompok=$this->input->post('id_kelompok');
			$query = $this->db->get_where(M_KELOMPOK_KOMPETENSI_SD, array('id_kelompok' => $id_kelompok));
			if ($query->num_rows() == 1) {
				$data = $this->m_kelompokadmin->deletekelompok($id_kelompok);
					if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil dihapus";
					} else {
					echo $data;
					}	
			} else {
				echo "Nama Kelompok Kompetensi tidak ditemukan";   
			}
		} else{
			echo "session_expired";
		}
	  	} else {
			show_404();
	  	}
  	}

	function ajax_data_kelompok() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $data = $this->m_kelompokadmin->kelompok_list();
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
