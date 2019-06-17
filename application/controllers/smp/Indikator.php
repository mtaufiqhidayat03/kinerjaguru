<?php
class Indikator extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SMP.'m_indikatoradmin');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
		if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah"))  {
			$id_kompetensi = $this->input->get('id_kompetensi');
            if (isset($id_kompetensi) and $id_kompetensi !== "") { 
			  $data['n20'] = $this->m_indikatoradmin->namaindikator($id_kompetensi);  
			  $data['n20'] = 
			  $this->load->view(FOLDER_SMP.'dataindikator', $data); 
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SMP.'dataindikator' );
			}
		} else {
			show_404();
		}            
        }
	}
	function ambildatakompetensi2() {
		$id_kompetensi = $this->input->get('id_kompetensi');
		$data = $this->m_indikatoradmin->datakompetensi2($id_kompetensi);
		$key = 0;
		$list = array();
			foreach ($data as $row)
			{
				$list[$key]['id'] = $row->id_kompetensi;
				$list[$key]['text'] = $row->nama_kompetensi;
				$key++;
			}
		echo json_encode($list);
	}

	function ambildatakompetensi() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
			{
			$id_kelompok = $this->input->get('id_kelompok');
			$search = $this->input->get('search');
			$page = $this->input->get('page');
			$data = $this->m_indikatoradmin->datakompetensi($search, $page, $id_kelompok);
			$key=0;
			$list = array();
			foreach ($data as $row)
			{
				$list[$key]['id'] = $row->id_kompetensi;
				 $list[$key]['text'] = $row->nama_kompetensi;
				 $key++;
			}
			$list2["results"] = $list;
			$list3 = array();
			$sIndexColumn = "id_kelompok_kompetensi_smp";
			$page2 = $page * 10;
			if ($search !== "" ) {
				$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_KOMPETENSI_SMP."` where nama_kompetensi like '%".$search."%'";
			} else {
				$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_KOMPETENSI_SMP."`";
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

	function form_addindikator(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            $this->load->view(FOLDER_SMP.'form_addindikator');
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}
	
	function aksiaddindikator() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$no_urut_indikator = $this->input->post('no_urut_indikator');
			$id_kompetensi_indikator_smp = $this->input->post('id_kompetensi_indikator_smp');
			$query = $this->db->get_where(M_INDIKATOR_SMP, array('no_urut_indikator' => $no_urut_indikator, 'id_kompetensi_indikator_smp' => $id_kompetensi_indikator_smp));
			if ($query->num_rows() == 0) {
			$data_indikator = array(
				'nama_indikator'=>$this->input->post('nama_indikator'),
				'id_kompetensi_indikator_smp'=>$this->input->post('id_kompetensi_indikator_smp'),
				'no_urut_indikator'=>$this->input->post('no_urut_indikator'),
				'keaktifan_indikator'=>$this->input->post('keaktifan_indikator'),
            );
            $data = $this->m_indikatoradmin->addindikator($data_indikator);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
				}
			} else {
				echo "No urut indikator tidak boleh sama dalam satu kompetensi";
			}	
		} else {
			echo "session_expired";
		}
		} else {
			show_404();
		}
	}

	function form_editindikator(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$data['n2'] = $this->m_indikatoradmin->getdataindikator($id_indikator);
            $this->load->view(FOLDER_SMP.'form_editindikator', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function aksieditindikator() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->post('id_indikator');
			$no_urut_indikator = $this->input->post('editno_urut_indikator');
			$id_kompetensi_indikator_smp = $this->input->post('editid_kompetensi_indikator_smp');
			$query = $this->db->get_where(M_INDIKATOR_SMP, array('id_indikator' => $id_indikator));
			if ($query->num_rows() == 1) {
				$queryku = $this->db->get_where(M_INDIKATOR_SMP, array('id_indikator' => $id_indikator));
				$rowku = $queryku->row_array();		
				$query = $this->db->get_where(M_INDIKATOR_SMP, array('id_indikator' => $id_indikator, 'no_urut_indikator' => $no_urut_indikator, 'id_kompetensi_indikator_smp' => $id_kompetensi_indikator_smp));
				$query2 = $this->db->get_where(M_INDIKATOR_SMP, array('no_urut_indikator' => $no_urut_indikator, 'id_kompetensi_indikator_smp' => $id_kompetensi_indikator_smp));
				if ($query->num_rows() == 1 and $rowku['no_urut_indikator'] === $no_urut_indikator and $rowku['id_kompetensi_indikator_smp'] === $id_kompetensi_indikator_smp) {
				$data_indikator = array(
						'nama_indikator'=>$this->input->post('editnama_indikator'),
						'keaktifan_indikator'=>$this->input->post('editkeaktifan_indikator'),
					);
				$data = $this->m_indikatoradmin->updateindikator($data_indikator,$id_indikator);
				if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil diubah";
					} else {
					echo $data;
					}
				}
				else if ($query2->num_rows() == 0) {
				$data_indikator = array(
					'nama_indikator'=>$this->input->post('editnama_indikator'),
					'id_kompetensi_indikator_smp'=>$this->input->post('editid_kompetensi_indikator_smp'),
					'no_urut_indikator'=>$this->input->post('editno_urut_indikator'),
					'keaktifan_indikator'=>$this->input->post('editkeaktifan_indikator'),
				);
				$data = $this->m_indikatoradmin->updateindikator($data_indikator,$id_indikator);
				if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diubah";
				} else {
				echo $data;
				}				
			} 
			else {
				echo "No urut tidak boleh sama dalam satu kelompok indikator";
			}	
			} else {
				echo "Nama indikator tidak ditemukan"; 
			}
		} else {
            echo "session_expired";
        }
		} else {
			show_404();
		}
	}

	function form_hapusindikator() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		  $id_indikator = $this->input->get('id_indikator');
		  $data['n2'] = $this->m_indikatoradmin->getdataindikator($id_indikator);
		  $this->load->view(FOLDER_SMP.'form_hapusindikator', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	function aksihapusindikator() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
			$id_indikator=$this->input->post('id_indikator');
			$query = $this->db->get_where(M_INDIKATOR_SMP, array('id_indikator' => $id_indikator));
			if ($query->num_rows() == 1) {
				$data = $this->m_indikatoradmin->deleteindikator($id_indikator);
					if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil dihapus";
					} else {
					echo $data;
					}	
			} else {
				echo "Nama indikator tidak ditemukan";   
			}
		} else{
			echo "session_expired";
		}
	  	} else {
			show_404();
	  	}
  	}

	function ajax_data_indikator() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$id_kompetensi = $this->input->get('id_kompetensi');
				if (isset($id_kompetensi) and $id_kompetensi  !== "") { 
				$data = $this->m_indikatoradmin->indikator_list($id_kompetensi);
				} 
           	 	else {
				$id_kompetensi = "";
				$data = $this->m_indikatoradmin->indikator_list($id_kompetensi);
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
