<?php
class Kinerja extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_kinerjauser');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
			$id_kompetensi = $this->input->get('id_kompetensi');
            if (isset($id_kompetensi) and $id_kompetensi !== "") { 
			  $this->load->view(FOLDER_SD_USER.'datakinerja', $data); 
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SD_USER.'datakinerja' );
            }
            
        }
	}
	function ambildatakompetensi2() {
		$id_kompetensi = $this->input->get('id_kompetensi');
		$data = $this->m_kinerjauser->datakompetensi2($id_kompetensi);
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
			$data = $this->m_kinerjauser->datakompetensi($search, $page, $id_kelompok);
			$key=0;
			$list = array();
			foreach ($data as $row)
			{
				$list[$key]['id'] = $row->id_kelompok_kompetensi_sd;
				 $list[$key]['text'] = $row->nama_kompetensi;
				 $key++;
			}
			$list2["results"] = $list;
			$list3 = array();
			$sIndexColumn = "id_kelompok_kompetensi_sd";
			$page2 = $page * 10;
			if ($search !== "" ) {
				$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_KOMPETENSI_SD."` where nama_kompetensi like '%".$search."%'";
			} else {
				$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_KOMPETENSI_SD."`";
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
            $this->load->view(FOLDER_SD_USER.'form_addindikator');
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
			$id_kompetensi_indikator_sd = $this->input->post('id_kompetensi_indikator_sd');
			$query = $this->db->get_where(M_INDIKATOR_SD, array('no_urut_indikator' => $no_urut_indikator, 'id_kompetensi_indikator_sd' => $id_kompetensi_indikator_sd));
			if ($query->num_rows() == 0) {
			$data_indikator = array(
				'nama_indikator'=>$this->input->post('nama_indikator'),
				'id_kompetensi_indikator_sd'=>$this->input->post('id_kompetensi_indikator_sd'),
				'no_urut_indikator'=>$this->input->post('no_urut_indikator'),
				'keaktifan_indikator'=>$this->input->post('keaktifan_indikator'),
            );
            $data = $this->m_kinerjauser->addindikator($data_indikator);
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
			$data['n2'] = $this->m_kinerjauser->getdataindikator($id_indikator);
            $this->load->view(FOLDER_SD_USER.'form_editindikator', $data);
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
			$id_kompetensi_indikator_sd = $this->input->post('editid_kompetensi_indikator_sd');
			$query = $this->db->get_where(M_INDIKATOR_SD, array('id_indikator' => $id_indikator));
			if ($query->num_rows() == 1) {
				$queryku = $this->db->get_where(M_INDIKATOR_SD, array('id_indikator' => $id_indikator));
				$rowku = $queryku->row_array();		
				$query = $this->db->get_where(M_INDIKATOR_SD, array('id_indikator' => $id_indikator, 'no_urut_indikator' => $no_urut_indikator, 'id_kompetensi_indikator_sd' => $id_kompetensi_indikator_sd));
				$query2 = $this->db->get_where(M_INDIKATOR_SD, array('no_urut_indikator' => $no_urut_indikator, 'id_kompetensi_indikator_sd' => $id_kompetensi_indikator_sd));
				if ($query->num_rows() == 1 and $rowku['no_urut_indikator'] === $no_urut_indikator and $rowku['id_kompetensi_indikator_sd'] === $id_kompetensi_indikator_sd) {
				$data_indikator = array(
						'nama_indikator'=>$this->input->post('editnama_indikator'),
						'keaktifan_indikator'=>$this->input->post('editkeaktifan_indikator'),
					);
				$data = $this->m_kinerjauser->updateindikator($data_indikator,$id_indikator);
				if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil diubah";
					} else {
					echo $data;
					}
				}
				else if ($query2->num_rows() == 0) {
				$data_indikator = array(
					'nama_indikator'=>$this->input->post('editnama_indikator'),
					'id_kompetensi_indikator_sd'=>$this->input->post('editid_kompetensi_indikator_sd'),
					'no_urut_indikator'=>$this->input->post('editno_urut_indikator'),
					'keaktifan_indikator'=>$this->input->post('editkeaktifan_indikator'),
				);
				$data = $this->m_kinerjauser->updateindikator($data_indikator,$id_indikator);
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

	function form_uploadfilekinerja(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$id_kelompok=$this->input->get('id_kelompok');
			$id_kompetensi=$this->input->get('id_kompetensi');
			$nuptk= $this->session->userdata("username");
			$data['n2'] = $this->m_kinerjauser->getdatakinerja($id_indikator, $id_kompetensi, $id_kelompok);
			$data['n1'] = $this->m_kinerjauser->getdataguru($nuptk);
            $this->load->view(FOLDER_SD_USER.'form_uploadfilekinerja', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function aksiuploadfilekinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator = $this->input->post('id_indikator');
			$id_kelompok = $this->input->post('id_kelompok');
			$id_kompetensi = $this->input->post('id_kompetensi');
			$nuptk_guru_sd= $this->session->userdata("username");
			$query = $this->db->get_where(D_PENILAIAN_SD.$this->session->userdata('tahun'), array('id_indikator_penilaian_sd' => $id_indikator,'nuptk_penilaian_sd' => $nuptk_guru_sd));
			if ($query->num_rows() == 0) {
			$new_name ="penilaian_tahun_".$this->session->userdata('tahun')."_id_".$id_indikator."_nuptk_".$nuptk_guru_sd."_tanggal_".date("d-m-Y")."_jam_".date("H-i-s");
			$config['upload_path']          = './penilaian/sd/'.$this->session->userdata('tahun').'/'.$nuptk_guru_sd.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1048576;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} 
			$data_kinerja = array(
				'id_indikator_penilaian_sd'=>$id_indikator,
				'id_kompetensi_penilaian_sd'=>$id_kompetensi,
				'nuptk_penilaian_sd'=>$nuptk_guru_sd,
				'upload_file_penilaian_sd'=>$config['upload_path'].$this->upload->data('file_name'),
			);
            $data = $this->m_kinerjauser->addpenilaiankinerja($data_kinerja);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
				}
			} else {
				echo "Penilaian kinerja sudah pernah dilakukan";
			}	
		} else {
			echo "session_expired";
		}
		} else {
			show_404();
		}
	}

	function form_gantifilekinerja(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$id_kelompok=$this->input->get('id_kelompok');
			$id_kompetensi=$this->input->get('id_kompetensi');
			$nuptk= $this->session->userdata("username");
			$data['n2'] = $this->m_kinerjauser->getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk);
			$data['n1'] = $this->m_kinerjauser->getdataguru($nuptk);
            $this->load->view(FOLDER_SD_USER.'form_gantifilekinerja', $data);
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
	}

	function aksigantifilekinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator = $this->input->post('id_indikator');
			$id_kelompok = $this->input->post('id_kelompok');
			$id_kompetensi = $this->input->post('id_kompetensi');
			$nuptk_guru_sd= $this->session->userdata("username");
			$query = $this->db->get_where(D_PENILAIAN_SD.$this->session->userdata('tahun'), array('id_indikator_penilaian_sd' => $id_indikator,'nuptk_penilaian_sd' => $nuptk_guru_sd));
			if ($query->num_rows() == 1) {
			$queryku = $this->db->get_where(D_PENILAIAN_SD.$this->session->userdata('tahun'), array('id_indikator_penilaian_sd' => $id_indikator,'nuptk_penilaian_sd' => $nuptk_guru_sd));
            $rowku = $queryku->row_array();
			$file = $rowku['upload_file_penilaian_sd'];
			if (is_readable($file) && unlink($file)) {
			$new_name ="penilaian_tahun_".$this->session->userdata('tahun')."_id_".$id_indikator."_nuptk_".$nuptk_guru_sd."_tanggal_".date("d-m-Y")."_jam_".date("H-i-s");
			$config['upload_path']          = './penilaian/sd/'.$this->session->userdata('tahun').'/'.$nuptk_guru_sd.'/';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 1048576;
			$config['file_name'] 			= $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pdf')){
				$error = array('error' => $this->upload->display_errors());
				echo $error;
			} else {
			$data_kinerja = array(
				'upload_file_penilaian_sd'=>$config['upload_path'].$this->upload->data('file_name'),
			);
			$data = $this->m_kinerjauser->editpenilaiankinerja($data_kinerja, $id_indikator, $nuptk_guru_sd);
			if ($this->db->affected_rows() != 1) {
				echo "Proses edit data gagal dilakukan";
			} else {
				echo $data;
			}
			}
			} else {
				echo "Proses edit data gagal dilakukan";
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

	function form_lihatpdfkinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
			$id_indikator=$this->input->get('id_indikator');
			$id_kelompok=$this->input->get('id_kelompok');
			$id_kompetensi=$this->input->get('id_kompetensi');
			$nuptk= $this->session->userdata("username");
			$data['n2'] = $this->m_kinerjauser->getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk);
			$data['n1'] = $this->m_kinerjauser->getdataguru($nuptk);
		  	$this->load->view(FOLDER_SD_USER.'form_lihatpdfkinerja', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function form_hapuskinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		$id_indikator=$this->input->get('id_indikator');
		$id_kelompok=$this->input->get('id_kelompok');
		$id_kompetensi=$this->input->get('id_kompetensi');
		$nuptk= $this->session->userdata("username");
		$data['n2'] = $this->m_kinerjauser->getdatakinerja2($id_indikator, $id_kompetensi, $id_kelompok, $nuptk);
		$data['n1'] = $this->m_kinerjauser->getdataguru($nuptk);
		$this->load->view(FOLDER_SD_USER.'form_hapuskinerja', $data);
		} else {
            $this->load->view('v_sesiberakhir');
        }
	  	} else {
		  show_404();
	  	}
	  }

	  function aksihapuskinerja() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $id_indikator=$this->input->post('id_indikator');
				$nuptk_guru_sd= $this->input->post("nuptk_penilaian_sd");
                $query = $this->db->get_where(D_PENILAIAN_SD.$this->session->userdata('tahun'), array('id_indikator_penilaian_sd' => $id_indikator,'nuptk_penilaian_sd' => $nuptk_guru_sd));
                if ($query->num_rows() == 1) {
                    $queryku = $this->db->get_where(D_PENILAIAN_SD.$this->session->userdata('tahun'), array('id_indikator_penilaian_sd' => $id_indikator,'nuptk_penilaian_sd' => $nuptk_guru_sd));
           			$rowku = $queryku->row_array();
					$file = $rowku['upload_file_penilaian_sd'];
                    if (is_readable($file) && unlink($file)) {
                        $data = $this->m_kinerjauser->deletehasilkinerja($id_indikator, $nuptk_guru_sd);
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
	
	function cetakpenilaian(){
		$success = require_once "dompdf/autoload.inc.php";
		if (!$success) {
			echo "Error. Cannot include and initialize dompdf";
		} else {		

		$dompdf =  new Dompdf\Dompdf();		
		$dompdf->loadHtml('hello world');
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		// Output the generated PDF to Browser
		 $dompdf->stream();
		}
	}

	function ajax_data_kinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$nuptk = $this->session->userdata("username");
				$data = $this->m_kinerjauser->kinerja_list($nuptk);
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
