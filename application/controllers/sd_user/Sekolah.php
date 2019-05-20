<?php
class Sekolah extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_sekolahuser');        
    }

    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            $this->load->view(FOLDER_SD_USER.'datasekolah' );
        }
    }

	function ambildatagurusd(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) 
		{
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$search = $this->input->get('search');
		$page = $this->input->get('page');
		$data = $this->m_sekolahuser->datagurusd($search, $page);
		$key=0;
		$list = array();
		foreach ($data as $row)
		{
			$list[$key]['id'] = $row->nip;
         	$list[$key]['text'] = $row->nama_guru;
     		$key++;
		}
		$list2["results"] = $list;
		$list3 = array();
		$sIndexColumn = "nuptk";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_GURU_SD."` where nip like '%".$search."%' or nama_guru like '%".$search."%'";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_GURU_SD."`";
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

	function ambildatagurusdmengajar(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) 
		{
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$search = $this->input->get('search');
		$page = $this->input->get('page');
		$id_kelompok = $this->input->get('kelompok');
		$data = $this->m_sekolahuser->datagurusdmengajar($search, $page, $id_kelompok);
		$key=0;
		$list = array();
		foreach ($data as $row)
		{
			$list[$key]['id'] = $row->nuptk;
         	$list[$key]['text'] = $row->nama_guru;
     		$key++;
		}
		$query3 = $this->db->get_where(M_KELOMPOK_KOMPETENSI_SD, array('id_kelompok' => $id_kelompok));
		foreach ($query3->result() as $brs) {
			$jenis_guru = $brs->hub_jenis_guru;
			$detail_guru = $brs->hub_detail_guru;
		}
		if ($jenis_guru =="Guru Kelas") {
			$tambahan = " and FIND_IN_SET(detail_guru,'$detail_guru')";
		} else {
			$tambahan = "";
		}
		$list2["results"] = $list;
		$list3 = array();
		$sIndexColumn = "nuptk";
		$page2 = $page * 10;
		if ($search !== "" ) {
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SD.$this->session->userdata('tahun')."` as a left join `".M_GURU_SD."` as b ON b.nuptk=a.nuptk_guru_sd and jenis_guru='".$jenis_guru."'".$tambahan." where nama_guru like '%".$search."%' or nuptk like '%".$search."%'";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".D_GURU_SD.$this->session->userdata('tahun')."` as a left join `".M_GURU_SD."` as b ON b.nuptk=a.nuptk_guru_sd and jenis_guru='".$jenis_guru."'".$tambahan;
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

    function ambildatakotakab(){
            $nama_provinsi = $this->input->get('nama_provinsi');
            $data = $this->m_sekolahuser->kotakab($nama_provinsi);
            echo "<option value=''>Silahkan pilih kota/kabupaten dibawah ini</option>";
            foreach ($data as $row)
            {
            echo "<option value='$row->nama_kota_kab'>".$row->nama_kota_kab."</option>";
            }
    }
    
    function ambildatakecamatan(){
            $nama_provinsi = $this->input->get('nama_provinsi');
            $nama_kotakab = $this->input->get('nama_kotakab');
            $data = $this->m_sekolahuser->kecamatan($nama_provinsi,$nama_kotakab);
            echo "<option value=''>Silahkan pilih kecamatan dibawah ini</option>";
            foreach ($data as $row)
            {
            echo "<option value='$row->nama_kec'>".$row->nama_kec."</option>";
            }
    }
    
    function ambildatakelurahan(){
            $nama_provinsi = $this->input->get('nama_provinsi');
            $nama_kotakab = $this->input->get('nama_kotakab');
            $nama_kec = $this->input->get('nama_kec');
            $data = $this->m_sekolahuser->kelurahan($nama_provinsi,$nama_kotakab,$nama_kec);
            echo "<option value=''>Silahkan pilih kelurahan/desa dibawah ini</option>";
            foreach ($data as $row)
            {
            echo "<option value='$row->nama_desa_kel'>".$row->nama_desa_kel."</option>";
            }
    }
    
    function ambildatanodaerah(){
            $nama_provinsi = $this->input->get('nama_provinsi');
            $nama_kotakab = $this->input->get('nama_kotakab');
            $nama_kec = $this->input->get('nama_kec');
            $nama_desa_kel = $this->input->get('nama_desa_kel');
            $data = $this->m_sekolahuser->no_daerah($nama_provinsi,$nama_kotakab,$nama_kec,$nama_desa_kel);
            foreach ($data as $row)
            {
            echo $row->no_daerah;
            }
	}
	
    function aksieditkepalasekolah(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
			{
			$npsn_nss=$this->input->post('npsn_nss');
			$query = $this->db->get_where("`".D_SD.$this->session->userdata('tahun')."`", array('npsn_nss_sd' => $npsn_nss));
			$nipkepala=$this->input->post('editkepala_sekolah');
			$query2 = $this->db->get_where("`".D_SD.$this->session->userdata('tahun')."`", array('nip_kepala' => $nipkepala));
				if ($query->num_rows() == 0 && $query2->num_rows() == 0) {
				$data_kepala = array(  
					'npsn_nss_sd'=>$npsn_nss,            
					'nip_kepala'=>$nipkepala
				);
				$data = $this->m_sekolahuser->updatekepalasekolah($data_kepala);
				if ($this->db->affected_rows() != 1) {
				echo "Tidak ada data yang berhasil diubah";
				} else {
				echo $data;
				}
				} else {
				 echo "Kepala sekolah tersebut sudah digunakan di sekolah yang lain";   
				}
			}else{
				echo "session_expired";
			}
			} else {
				show_404();
			}
	}

    function aksiaddsekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $npsn_nss=$this->input->post('npsn_nss');
        $query = $this->db->get_where(M_SD, array('npsn_nss' => $npsn_nss));
            if ($query->num_rows() == 0) {
            $data_sekolah = array(
                'npsn_nss'=>$this->input->post('npsn_nss'),
                'nama_sekolah'=>$this->input->post('nama_sekolah'),
                'telp_fax'=>$this->input->post('telp_fax'),
                'no_daerah'=>$this->input->post('no_daerah')
            );
            $data = $this->m_sekolahuser->addsekolah($data_sekolah);
                if ($this->db->affected_rows() != 1) {
                    echo "Tidak ada data yang berhasil diinput";
                } else {
                    echo $data;
                }
            } else {
             echo "NPSN/NSS sudah terpakai";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
    }
    
    function aksieditsekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $npsn_nss=$this->input->post('npsn_nss');
        $query = $this->db->get_where(M_SD, array('npsn_nss' => $npsn_nss));
            if ($query->num_rows() == 1) {
            $data_sekolah = array(                
                'nama_sekolah'=>$this->input->post('nama_sekolah'),
                'telp_fax'=>$this->input->post('telp_fax'),
                'no_daerah'=>$this->input->post('no_daerah')
            );
            $npsn_nss=$this->input->post('npsn_nss');
            $data = $this->m_sekolahuser->updatesekolah($data_sekolah,$npsn_nss);
            if ($this->db->affected_rows() != 1) {
            echo "Tidak ada data yang berhasil diubah";
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
    
    function aksihapussekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $npsn_nss=$this->input->post('npsn_nss');
        $query = $this->db->get_where(M_SD, array('npsn_nss' => $npsn_nss));
            if ($query->num_rows() == 1) {
            $npsn_nss=$this->input->post('npsn_nss');
            $data = $this->m_sekolahuser->deletesekolah($npsn_nss);
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

	function aksihapuskepalasekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $npsn_nss=$this->input->post('npsn_nss');
        $query = $this->db->get_where("`".D_SD.$this->session->userdata('tahun')."`", array('npsn_nss_sd' => $npsn_nss));
            if ($query->num_rows() == 1) {
            $npsn_nss=$this->input->post('npsn_nss');
            $data = $this->m_sekolahuser->deletekepalasekolah($npsn_nss);
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
    
    function form_addsekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
            $data['n1'] = $this->m_sekolahuser->prov(); 
            $this->load->VIEW(FOLDER_SD_USER.'form_addsekolah', $data);
        } else {
            $this->load->VIEW(FOLDER_SD_USER.'v_sesiberakhir');
        }
        } else {
            show_404();
        }
    }
    
    function form_hapussekolah() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $npsn_nss = $this->input->get('npsn_nss');
            $data['n2'] = $this->m_sekolahuser->getdatasekolah($npsn_nss);
            $this->load->VIEW(FOLDER_SD_USER.'form_hapussekolah', $data);
        } else {
            show_404();
        }
    }
    
    function form_editsekolah() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $npsn_nss = $this->input->get('npsn_nss');
            $data['n1'] = $this->m_sekolahuser->prov();
            $data['n2'] = $this->m_sekolahuser->getdatasekolah($npsn_nss);
            foreach ($data['n2'] as $row)
            {
                $no_daerah = $row->no_daerah;
            }
            $daerahku = $this->m_sekolahuser->getdaerah($no_daerah);
            foreach ($daerahku as $row)
            {
                $nama_provinsi = $row->nama_provinsi;
                $nama_kotakab = $row->nama_kota_kab;
                $nama_kec = $row->nama_kec;
            }
            $data['kabkota'] = $this->m_sekolahuser->kotakab($nama_provinsi);
            $data['kec'] = $this->m_sekolahuser->kecamatan($nama_provinsi,$nama_kotakab);
            $data['kel'] = $this->m_sekolahuser->kelurahan($nama_provinsi,$nama_kotakab,$nama_kec);
            $this->load->view(FOLDER_SD_USER.'form_editsekolah', $data);
        } else {
            show_404();
        }
	}
	
    function form_kepalasekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$npsn_nss = $this->input->get('npsn_nss');
			$data['n1'] = $this->m_sekolahuser->getdatasekolah($npsn_nss);
			$this->load->view(FOLDER_SD_USER.'form_kepalasekolah', $data);
            
        } else {
            show_404();
        }
	}

	function form_hapuskepalasekolah() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $npsn_nss = $this->input->get('npsn_nss');
		  $data['n1'] = $this->m_sekolahuser->getdatasekolah($npsn_nss);
		  $this->load->view(FOLDER_SD_USER.'form_hapuskepalasekolah', $data);
	  } else {
		  show_404();
	  }
  }
    function ajax_data_sekolah() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $data = $this->m_sekolahuser->sekolah_list();
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
