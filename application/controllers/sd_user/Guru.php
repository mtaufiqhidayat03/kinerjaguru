<?php
class Guru extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_guruuser'); 
    }
    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("Login"));
        } else {
       	// if ($this->session->userdata('level') =='Administrator Kota') {
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") { 
              $data['n20'] = $this->m_guruuser->namasekolah($npsn_nss); 
			  $this->load->view(FOLDER_SD_USER.'dataguru', $data);  
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SD_USER.'dataguru');
            }
        //} 
        }
    }
        
   /* function form_addguru(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            //$data['n1'] = $this->m_guruuser->getsekolah(); 
            $this->load->view(FOLDER_SD_USER.'form_addguru');
        } else {
            $this->load->view('v_sesiberakhir');
        }
        } else {
            show_404();
       }
    }
    
    function aksiaddguru(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $nuptk=$this->input->post('nuptk');
        $query = $this->db->get_where(M_GURU_SD, array('nuptk' => $nuptk));
            if ($query->num_rows() == 0) {
            $data_guru = array(
                'nuptk'=>$this->input->post('nuptk'),
                'nama_guru'=>$this->input->post('nama'),
                'nip'=>$this->input->post('nip'),
                'karpeg'=>$this->input->post('karpeg'),
                'tempat_lahir'=>$this->input->post('tempat_lahir'),
                'tgl_lahir'=>$this->input->post('tgl_lahir'),
                'pangkat_jabatan'=>$this->input->post('pangkat_jabatan'),
                'tmt_guru'=>$this->input->post('tmt_guru'),
                'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                'pendidikan_terakhir'=>$this->input->post('pendidikan_terakhir'),
				'program_keahlian'=>$this->input->post('program_keahlian'),
			);
			$query3 = "SELECT * FROM `".M_USERS."`";
			$r1 = $this->db->query($query3);
			$r2 = $r1->num_rows();
			if ($r2 == 0) {
			$idku = 1;			
			} else {
			$query4 = "SELECT max(id_user)+1 as id FROM `".M_USERS."`";
			$r3 = $this->db->query($query4);
			foreach ($r3->result() as $brs) {
				$idku = $brs->id;
			}
			}	
			$data_guru2 = array(
				'id_user'=>$idku,
                'username'=>$this->input->post('nuptk'),
				'password'=>md5($this->input->post('password')),
            );
			$data = $this->m_guruuser->addguru($data_guru);
			$data = $this->m_guruuser->addguru_p($data_guru2);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
                }
            } else {
             echo "NUPTK sudah terpakai";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
    } */
    
    function form_editguru() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $nuptk=$this->input->get('nuptk');
            //$data['n1'] = $this->m_guruuser->getsekolah(); 
            $data['n2'] = $this->m_guruuser->getdataguru($nuptk);
            $this->load->view(FOLDER_SD_USER.'form_editguru', $data);
        } else {
            show_404();
        }
	}

	function form_gantipasswordguru() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $nuptk=$this->input->get('nuptk');
		  //$data['n1'] = $this->m_guruuser->getsekolah(); 
		  $data['n2'] = $this->m_guruuser->getdataguru($nuptk);
		  $this->load->view(FOLDER_SD_USER.'form_gantipasswordguru', $data);
	  } else {
		  show_404();
	  }
  }

  function aksigantipasswordguru(){
	if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
	{
	$nuptk=$this->input->post('nuptk');
	$query = $this->db->get_where(M_USERS, array('username' => $nuptk));
		if ($query->num_rows() == 1) {
		$data_guru2 = array(
			'password'=>md5($this->input->post('editpassword'))
		);
		$data = $this->m_guruuser->updatepasswordguru($data_guru2, $nuptk);
			if ($this->db->affected_rows() != 1) {
				echo "Password sama dengan sebelumnya. Tidak ada yang berubah";
			} else {
				echo $data;
			}
		} else {
		 echo "NUPTK tidak ditemukan";   
		}
	}else{
		echo "session_expired";
	}
	} else {
		show_404();
	}
	}

	function form_gurumapel() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $nuptk=$this->input->get('nuptk');
		  //$data['n1'] = $this->m_guruuser->getsekolah(); 
		 // $data['n1'] = $this->m_guruuser->getdataguru($nuptk);
		  $data['n1'] = $this->m_guruuser->getdataguru2($nuptk);
		  $this->load->view(FOLDER_SD_USER.'form_gurumapel', $data);
	  	} else {
		  show_404();
	  	}
	}
	  
  	function ambildatasekolahsd () {
	if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
		$search = $this->input->get('search');
		$page = $this->input->get('page');
		$data = $this->m_guruuser->datasekolahsd($search, $page);
		$key=0;
		$list = array();
		foreach ($data as $row)
		{
			$list[$key]['id'] = $row->npsn_nss;
         	$list[$key]['text'] = $row->nama_sekolah;
     		$key++;
		}
		$list2["results"] = $list;
		$list3 = array();
		$sIndexColumn = "npsn_nss";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_SD."` where nama_sekolah like '%".$search."%' or npsn_nss like '%".$search."%'";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_SD."`";
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
    
    function aksieditguru(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $nuptk=$this->input->post('nuptk');
        $query = $this->db->get_where(M_GURU_SD, array('nuptk' => $nuptk));
            if ($query->num_rows() == 1) {
            $data_guru = array(
               // 'nuptk'=>$this->input->post('nuptk'),
                'nama_guru'=>$this->input->post('nama_guru'),
                'nip'=>$this->input->post('nip'),
                'karpeg'=>$this->input->post('karpeg'),
                'tempat_lahir'=>$this->input->post('tempat_lahir'),
                'tgl_lahir'=>$this->input->post('edittgl_lahir'),
                'pangkat_jabatan'=>$this->input->post('pangkat_jabatan'),
                'tmt_guru'=>$this->input->post('edittmt_guru'),
                'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                'pendidikan_terakhir'=>$this->input->post('pendidikan_terakhir'),
                'program_keahlian'=>$this->input->post('program_keahlian'),
            );
            $data = $this->m_guruuser->updateguru($data_guru,$nuptk);
            if ($this->db->affected_rows() != 1) {
            echo "Tidak ada data yang berhasil diubah";
            } else {
            echo $data;
            }
            } else {
             echo "NUPTK tidak ditemukan";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
    }  
    
    function form_hapusguru() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $nuptk = $this->input->get('nuptk');
            $data['n2'] = $this->m_guruuser->getdataguru($nuptk);
            $this->load->view(FOLDER_SD_USER.'form_hapusguru', $data);
        } else {
            show_404();
        }
    }
    
    function aksihapusguru(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $nuptk = $this->input->post('nuptk');
		$query = $this->db->get_where(M_GURU_SD, array('nuptk' => $nuptk));
		$query2 = $this->db->get_where(M_GURU_SD, array('nuptk' => $nuptk));
		foreach ($query2->result() as $row)
		{
			$nipkepala = $row->nip;
		}
		$query4 = $this->db->get_where("`".D_GURU_SD.$this->session->userdata('tahun')."`", array('nuptk_guru_sd' => $nuptk));
		$query3 = $this->db->get_where("`".D_SD.$this->session->userdata('tahun')."`", array('nip_kepala' => $nipkepala));
            if ($query->num_rows() == 1) {		
			if ($query3->num_rows() == 1) {
				$data = $this->m_guruuser->deleteguru($nuptk);
				$data = $this->m_guruuser->deletekepalasekolah($nipkepala);
				if ($query4->num_rows() == 1) {
					$data = $this->m_guruuser->deleteguru2($nuptk);
				}
			} else {
				$data = $this->m_guruuser->deleteguru($nuptk);
				if ($query4->num_rows() == 1) {
					$data = $this->m_guruuser->deleteguru2($nuptk);
				}
			}		
                if ($this->db->affected_rows() != 1) {
                echo "Tidak ada data yang berhasil dihapus";
                } else {
                echo $data;
                }
            } else {
             echo "NUPTK tidak ditemukan";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
	}  
	
	function form_hapusgurumapel() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $nuptk = $this->input->get('nuptk');
		  $data['n1'] = $this->m_guruuser->getdataguru($nuptk);
		  $npsn_nss = $this->input->get('npsn_nss');
		  $data['n2'] = $this->m_guruuser->namasekolah($npsn_nss);
		  $this->load->view(FOLDER_SD_USER.'form_hapusgurumapel', $data);
	  } else {
		  show_404();
	  }
  }

  function aksihapusgurusekolah(){
	if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
	if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
	{
	$nuptk=$this->input->post('nuptk');
	$query = $this->db->get_where("`".D_GURU_SD.$this->session->userdata('tahun')."`", array('nuptk_guru_sd' => $nuptk));
		if ($query->num_rows() == 1) {
		$nuptk=$this->input->post('nuptk');
		$data = $this->m_guruuser->deletejenisguru($nuptk);
			if ($this->db->affected_rows() != 1) {
			echo "Tidak ada data yang berhasil dihapus";
			} else {
			echo $data;
			}
		} else {
		 echo "NPSN/NSS tidak ditemukan";   
		}
	}else{
		echo "session_expired";
	}
	} else {
		show_404();
	}
}

	function aksieditgurusekolah(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
			{
			$nuptk=$this->input->post('nuptk');
			$edit_gurusekolah=$this->input->post('edit_gurusekolah3');
			$jenis_guru=$this->input->post('jenis_guru');
			$detail_guru=$this->input->post('detail_guru');
			$query = $this->db->get_where("`".D_GURU_SD.$this->session->userdata('tahun')."`", array('nuptk_guru_sd' => $nuptk, 'npsn_nss_guru_sd' => $edit_gurusekolah));
			if ($jenis_guru === "Guru Kelas") {
				$query2 = $this->db->get_where("`".D_GURU_SD.$this->session->userdata('tahun')."`", array('jenis_guru' => $jenis_guru, 'detail_guru' => $detail_guru,'npsn_nss_guru_sd' => $edit_gurusekolah));
				if ($query->num_rows() == 1 && $query2->num_rows() == 0) {	
					$data_guru = array(  
						'jenis_guru' => $jenis_guru,
						'detail_guru' => $detail_guru
					);
					$data = $this->m_guruuser->updategurusekolah($data_guru, $nuptk);
					if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil diubah";
					} else {
					echo $data;
					}
				}
				else {
					echo "Guru wali kelas sudah pada sekolah ini sudah digunakan";   
				}
			} else {
				if ($query->num_rows() == 1) {
					$data_guru = array(  
							'jenis_guru' => $jenis_guru,
							'detail_guru' => $detail_guru
					);
					$data = $this->m_guruuser->updategurusekolah($data_guru, $nuptk);
					if ($this->db->affected_rows() != 1) {
					echo "Tidak ada data yang berhasil diubah";
					} else {
					echo $data;
					}
				} else {
					echo "Guru ini sudah mengajar di sekolah ini";   
				}
			}		
			}else{
				echo "session_expired";
			}
			} else {
				show_404();
			}
	}
    
    function ajax_data_guru() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
			{
			$nuptk = $this->session->userdata("username");
			$cek = $this->m_guruuser->getdatasekolah2($nuptk);
			foreach ($cek as $row)
            {
            $npsn_nss = $row->npsn_nss;
           	}
            $data = $this->m_guruuser->guru_list($npsn_nss, $nuptk);
                         
			echo json_encode($data);
			}
        } else {
            show_404();
        }
    }
}
?>
