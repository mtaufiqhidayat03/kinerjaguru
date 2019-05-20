<?php
class Guru extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(FOLDER_SD.'m_guruadmin'); 
    }
    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("Login"));
        } else {
       	if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) {
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") { 
              $data['n20'] = $this->m_guruadmin->namasekolah($npsn_nss); 
			  $this->load->view(FOLDER_SD.'dataguru', $data);  
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SD.'dataguru');
            }
        } else {
			show_404();
		}
        }
    }
        
    function form_addguru(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            //$data['n1'] = $this->m_guruadmin->getsekolah(); 
            $this->load->view(FOLDER_SD.'form_addguru');
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
			$data = $this->m_guruadmin->addguru($data_guru);
			$data = $this->m_guruadmin->addguru_p($data_guru2);
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
    }
    
    function form_editguru() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $nuptk=$this->input->get('nuptk');
            //$data['n1'] = $this->m_guruadmin->getsekolah(); 
            $data['n2'] = $this->m_guruadmin->getdataguru($nuptk);
            $this->load->view(FOLDER_SD.'form_editguru', $data);
        } else {
            show_404();
        }
	}

	function form_gantipasswordguru() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $nuptk=$this->input->get('nuptk');
		  //$data['n1'] = $this->m_guruadmin->getsekolah(); 
		  $data['n2'] = $this->m_guruadmin->getdataguru($nuptk);
		  $this->load->view(FOLDER_SD.'form_gantipasswordguru', $data);
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
		$data = $this->m_guruadmin->updatepasswordguru($data_guru2, $nuptk);
			if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diinput";
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

	function form_gurusekolah() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $nuptk=$this->input->get('nuptk');
		  //$data['n1'] = $this->m_guruadmin->getsekolah(); 
		  $data['n1'] = $this->m_guruadmin->getdataguru($nuptk);
		  $this->load->view(FOLDER_SD.'form_gurusekolah', $data);
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
		$data = $this->m_guruadmin->datasekolahsd($search, $page);
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
            $data = $this->m_guruadmin->updateguru($data_guru,$nuptk);
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
            $data['n2'] = $this->m_guruadmin->getdataguru($nuptk);
            $this->load->view(FOLDER_SD.'form_hapusguru', $data);
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
            if ($query->num_rows() == 1) {
            $nuptk = $this->input->post('nuptk');
            $data = $this->m_guruadmin->deleteguru($nuptk);
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
	
	function form_hapusgurusekolah() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $nuptk = $this->input->get('nuptk');
		  $data['n1'] = $this->m_guruadmin->getdataguru($nuptk);
		  $npsn_nss = $this->input->get('npsn_nss');
		  $data['n2'] = $this->m_guruadmin->namasekolah($npsn_nss);
		  $this->load->view(FOLDER_SD.'form_hapusgurusekolah', $data);
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
		$data = $this->m_guruadmin->deletegurusekolah($nuptk);
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
			$edit_gurusekolah=$this->input->post('edit_gurusekolah');
			$jenis_guru=$this->input->post('jenis_guru');
			$detail_guru=$this->input->post('detail_guru');
			$query = $this->db->get_where("`".D_GURU_SD.$this->session->userdata('tahun')."`", array('nuptk_guru_sd' => $nuptk));
			if ($jenis_guru === "Guru Kelas") {
			$query2 = $this->db->get_where("`".D_GURU_SD.$this->session->userdata('tahun')."`", array('jenis_guru' => $jenis_guru, 'detail_guru' => $detail_guru));
			}	
			if ($jenis_guru == "Guru Kelas") {
				if ($query->num_rows() == 0 && $query2->num_rows() == 0) {	
					$data_guru = array(  
						'nuptk_guru_sd'=>$nuptk,            
						'npsn_nss_guru_sd'=>$edit_gurusekolah,
						'jenis_guru' => $jenis_guru,
						'detail_guru' => $detail_guru
					);
					$data = $this->m_guruadmin->updategurusekolah($data_guru);
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
				if ($query->num_rows() == 0) {
					$data_guru = array(  
							'nuptk_guru_sd'=>$nuptk,            
							'npsn_nss_guru_sd'=>$edit_gurusekolah,
							'jenis_guru' => $jenis_guru,
							'detail_guru' => $detail_guru
					);
					$data = $this->m_guruadmin->updategurusekolah($data_guru);
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
            $npsn_nss = $this->input->get('npsn_nss');
            if (isset($npsn_nss) and $npsn_nss !== "") { 
            $data = $this->m_guruadmin->guru_list($npsn_nss);
            } 
            else {
            $npsn_nss = "";
            $data = $this->m_guruadmin->guru_list($npsn_nss);
            }             
			echo json_encode($data);
			}
        } else {
            show_404();
        }
    }
}
?>
