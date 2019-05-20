<?php
class Kompetensi extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_kompetensiuser');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            $this->load->view(FOLDER_SD_USER.'datakompetensi' );
        }
	}
	
	function ambildatakelompokkompetensi2() {
		$id_kelompok = $this->input->get('id_kelompok');
		$data = $this->m_kompetensiuser->datakelompokkompetensi2($id_kelompok);
		$key = 0;
		$list = array();
			foreach ($data as $row)
			{
				$list[$key]['id'] = $row->id_kelompok;
				$list[$key]['text'] = $row->kelompok_kompetensi;
				$key++;
			}
		echo json_encode($list);
	}

	function ambildatakelompokkompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
			{
			$search = $this->input->get('search');
			$page = $this->input->get('page');
			$data = $this->m_kompetensiuser->datakelompokkompetensi($search, $page);
			$key=0;
			$list = array();
			foreach ($data as $row)
			{
				$list[$key]['id'] = $row->id_kelompok;
				 $list[$key]['text'] = $row->kelompok_kompetensi;
				 $key++;
			}
			$list2["results"] = $list;
			$list3 = array();
			$sIndexColumn = "id_kelompok";
			$page2 = $page * 10;
			if ($search !== "" ) {
				$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_KELOMPOK_KOMPETENSI_SD."` where kelompok_kompetensi like '%".$search."%'";
			} else {
				$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_KELOMPOK_KOMPETENSI_SD."`";
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

	function form_addkompetensi(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            $this->load->view(FOLDER_SD_USER.'form_addkompetensi');
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}
	
	function aksiaddkompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$no_urut_kompetensi = $this->input->post('no_urut_kompetensi');
			$kelompok_kompetensi = $this->input->post('kelompok_kompetensi');
			$query = $this->db->get_where(M_KOMPETENSI_SD, array('no_urut_kompetensi' => $no_urut_kompetensi, 'id_kelompok_kompetensi_sd' => $kelompok_kompetensi));
			if ($query->num_rows() == 0) {
			$data_kompetensi = array(
				'nama_kompetensi'=>$this->input->post('nama_kompetensi'),
				'id_kelompok_kompetensi_sd'=>$this->input->post('kelompok_kompetensi'),
				'no_urut_kompetensi'=>$this->input->post('no_urut_kompetensi'),
				'keaktifan'=>$this->input->post('keaktifan'),
            );
            $data = $this->m_kompetensiuser->addkompetensi($data_kompetensi);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
				}
			} else {
				echo "No urut kompetensi tidak boleh sama dalam satu kelompok kompetensi";
			}	
		} else {
			echo "session_expired";
		}
		} else {
			show_404();
		}
	}

	function form_editkompetensi(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kompetensi=$this->input->get('id_kompetensi');
            $data['n2'] = $this->m_kompetensiuser->getdatakompetensi($id_kompetensi);
            $this->load->view(FOLDER_SD_USER.'form_editkompetensi', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function aksieditkompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_kompetensi=$this->input->post('id_kompetensi');
			$no_urut_kompetensi = $this->input->post('editno_urut_kompetensi');
			$kelompok_kompetensi = $this->input->post('editkelompok_kompetensi');
			$query = $this->db->get_where(M_KOMPETENSI_SD, array('id_kompetensi' => $id_kompetensi));
			if ($query->num_rows() == 1) {
				$queryku = $this->db->get_where(M_KOMPETENSI_SD, array('id_kompetensi' => $id_kompetensi));
				$rowku = $queryku->row_array();		
				$query = $this->db->get_where(M_KOMPETENSI_SD, array('id_kompetensi' => $id_kompetensi, 'no_urut_kompetensi' => $no_urut_kompetensi, 'id_kelompok_kompetensi_sd' => $kelompok_kompetensi));
				$query2 = $this->db->get_where(M_KOMPETENSI_SD, array('no_urut_kompetensi' => $no_urut_kompetensi, 'id_kelompok_kompetensi_sd' => $kelompok_kompetensi));
				if ($query->num_rows() == 1 and $rowku['no_urut_kompetensi'] === $no_urut_kompetensi and $rowku['id_kelompok_kompetensi_sd'] === $kelompok_kompetensi) {
				$data_kompetensi = array(
						'nama_kompetensi'=>$this->input->post('editnama_kompetensi'),
						'keaktifan'=>$this->input->post('editkeaktifan'),
				);
				$data = $this->m_kompetensiuser->updatekompetensi($data_kompetensi,$id_kompetensi);
				if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil diubah";
					} else {
					echo $data;
					}
				}
				else if ($query2->num_rows() == 0) {
				$data_kompetensi = array(
					'nama_kompetensi'=>$this->input->post('editnama_kompetensi'),
					'id_kelompok_kompetensi_sd'=>$this->input->post('editkelompok_kompetensi'),
					'no_urut_kompetensi'=>$this->input->post('editno_urut_kompetensi'),
					'keaktifan'=>$this->input->post('editkeaktifan'),
				);
				$data = $this->m_kompetensiuser->updatekompetensi($data_kompetensi,$id_kompetensi);
				if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diubah";
				} else {
				echo $data;
				}				
			} 
			else {
				echo "No urut kompetensi tidak boleh sama dalam satu kelompok kompetensi";
			}	
			} else {
				echo "Nama Kompetensi tidak ditemukan"; 
			}
		} else {
            echo "session_expired";
        }
		} else {
			show_404();
		}
	}

	function form_hapuskompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $id_kompetensi = $this->input->get('id_kompetensi');
		  $data['n2'] = $this->m_kompetensiuser->getdatakompetensi($id_kompetensi);
		  $this->load->view(FOLDER_SD_USER.'form_hapuskompetensi', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	function aksihapuskompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
			$id_kompetensi=$this->input->post('id_kompetensi');
			$query = $this->db->get_where(M_KOMPETENSI_SD, array('id_kompetensi' => $id_kompetensi));
			if ($query->num_rows() == 1) {
				$data = $this->m_kompetensiuser->deletekompetensi($id_kompetensi);
					if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil dihapus";
					} else {
					echo $data;
					}	
			} else {
				echo "Nama Kompetensi tidak ditemukan";   
			}
		} else{
			echo "session_expired";
		}
	  	} else {
			show_404();
	  	}
  	}

	function ajax_data_kompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$id_kelompok = $this->input->get('id_kelompok');
				if (isset($id_kelompok) and $id_kelompok !== "") { 
					$data = $this->m_kompetensiuser->kompetensi_list($id_kelompok);
				} 
				else {
					$id_kelompok = "";
					$data = $this->m_kompetensiuser->kompetensi_list($id_kelompok);
				}    
               
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
