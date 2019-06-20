<?php
class Sekolah extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(FOLDER_SD.'m_sekolahadmin');        
    }

    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) {
                $this->load->view(FOLDER_SD.'datasekolah');
            } else {
				show_404();
			}
        }
	}
	

	function ambildatagurusd(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) 
		{
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$search = $this->input->get('search');
        $page = $this->input->get('page');
        $npsn_nss = $this->input->get('npsn_nss');
		$data = $this->m_sekolahadmin->datagurusd($search, $page, $npsn_nss);
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
			$sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_GURU_SD."` as a left join `".D_GURU_SD.$this->session->userdata('tahun')."` as b ON a.nuptk=b.nuptk_guru_sd where npsn_nss_guru_sd='".$npsn_nss."' and (nip like '%".$search."%' or nama_guru like '%".$search."%')";
		} else {
            $sQuery = "SELECT COUNT(".$sIndexColumn.") as 'Count' FROM `".M_GURU_SD."` as a left join `".D_GURU_SD.$this->session->userdata('tahun')."` as b ON a.nuptk=b.nuptk_guru_sd where npsn_nss_guru_sd='".$npsn_nss."'";
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
		$data = $this->m_sekolahadmin->datagurusdmengajar($search, $page, $id_kelompok);
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
            $data = $this->m_sekolahadmin->kotakab($nama_provinsi);
            echo "<option value=''>Silahkan pilih kota/kabupaten dibawah ini</option>";
            foreach ($data as $row)
            {
            echo "<option value='$row->nama_kota_kab'>".$row->nama_kota_kab."</option>";
            }
    }
    
    function ambildatakecamatan(){
            $nama_provinsi = $this->input->get('nama_provinsi');
            $nama_kotakab = $this->input->get('nama_kotakab');
            $data = $this->m_sekolahadmin->kecamatan($nama_provinsi,$nama_kotakab);
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
            $data = $this->m_sekolahadmin->kelurahan($nama_provinsi,$nama_kotakab,$nama_kec);
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
            $data = $this->m_sekolahadmin->no_daerah($nama_provinsi,$nama_kotakab,$nama_kec,$nama_desa_kel);
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
				$data = $this->m_sekolahadmin->updatekepalasekolah($data_kepala);
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
            $data = $this->m_sekolahadmin->addsekolah($data_sekolah);
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
            $data = $this->m_sekolahadmin->updatesekolah($data_sekolah,$npsn_nss);
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
            $data = $this->m_sekolahadmin->deletesekolah($npsn_nss);
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
            $data = $this->m_sekolahadmin->deletekepalasekolah($npsn_nss);
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
            $data['n1'] = $this->m_sekolahadmin->prov(); 
            $this->load->VIEW(FOLDER_SD.'form_addsekolah', $data);
        } else {
            $this->load->VIEW(FOLDER_SD.'v_sesiberakhir');
        }
        } else {
            show_404();
        }
    }
    
    function form_hapussekolah() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $npsn_nss = $this->input->get('npsn_nss');
            $data['n2'] = $this->m_sekolahadmin->getdatasekolah($npsn_nss);
            $this->load->VIEW(FOLDER_SD.'form_hapussekolah', $data);
        } else {
            show_404();
        }
    }
    
    function form_editsekolah() {
          if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $npsn_nss = $this->input->get('npsn_nss');
            $data['n1'] = $this->m_sekolahadmin->prov();
            $data['n2'] = $this->m_sekolahadmin->getdatasekolah($npsn_nss);
            foreach ($data['n2'] as $row)
            {
                $no_daerah = $row->no_daerah;
            }
            $daerahku = $this->m_sekolahadmin->getdaerah($no_daerah);
            foreach ($daerahku as $row)
            {
                $nama_provinsi = $row->nama_provinsi;
                $nama_kotakab = $row->nama_kota_kab;
                $nama_kec = $row->nama_kec;
            }
            $data['kabkota'] = $this->m_sekolahadmin->kotakab($nama_provinsi);
            $data['kec'] = $this->m_sekolahadmin->kecamatan($nama_provinsi,$nama_kotakab);
            $data['kel'] = $this->m_sekolahadmin->kelurahan($nama_provinsi,$nama_kotakab,$nama_kec);
            $this->load->view(FOLDER_SD.'form_editsekolah', $data);
        } else {
            show_404();
        }
	}
	
    function form_kepalasekolah(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$npsn_nss = $this->input->get('npsn_nss');
			$data['n1'] = $this->m_sekolahadmin->getdatasekolah($npsn_nss);
			$this->load->view(FOLDER_SD.'form_kepalasekolah', $data);
            
        } else {
            show_404();
        }
	}

	function form_hapuskepalasekolah() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		  $npsn_nss = $this->input->get('npsn_nss');
		  $data['n1'] = $this->m_sekolahadmin->getdatasekolah($npsn_nss);
		  $this->load->view(FOLDER_SD.'form_hapuskepalasekolah', $data);
	  } else {
		  show_404();
	  }
  }

  function exportguru(){
	$npsn_nss = $this->input->get('npsn_nss');
	// Load plugin PHPExcel nya
	$success = include APPPATH.'third_party/phpexcel/PHPExcel.php';
	if (!$success) {
		echo "error";
	} else {		
	// Panggil class PHPExcel nya
	$objPHPExcel = new PHPExcel();
	// Settingan awal fil excel
	$objPHPExcel->getProperties()->setCreator('Aplikasi PKG')
				 ->setLastModifiedBy('Aplikasi PKG')
				 ->setTitle("Data Guru")
				 ->setSubject("Guru")
				 ->setDescription("Laporan Data Guru")
				 ->setKeywords("Data Guru");
	$default_border = array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb'=>'000000')
				);
	$style_header = array(
					'borders' => array(
						'bottom' => $default_border,
						'left' => $default_border,
						'top' => $default_border,
						'right' => $default_border,
						'vertical' => $default_border,
						'horizontal' => $default_border,
					),
					'font' => array(
						'bold' => true,
					)
				);
	$style_header2 = array(
					'borders' => array(
						'bottom' => $default_border,
						'left' => $default_border,
						'top' => $default_border,
						'right' => $default_border,
						'vertical' => $default_border,
						'horizontal' => $default_border,
					),
					'font' => array(
						'bold' => false,
					)
	); 
	$style_header3 = array(
					'font' => array(
						'bold' => true,
					)
	); 
	$tahun = $this->m_sekolahadmin->viewtahun();
	foreach ($tahun as $rowthn) {
		$tahun2 = $rowthn->tahun;
	}
	if (isset($npsn_nss) and $npsn_nss !== "") {
		$namaku = $this->m_sekolahadmin->nama_sekolah($npsn_nss);
		foreach ($namaku as $rownama) {
			$namasekolah = $rownama->nama_sekolah;
		}
	}
	if (isset($npsn_nss) and $npsn_nss !== "") {
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A1:L1')
		->setCellValue('A1', 'Data Guru '.$namasekolah)
		->mergeCells('A2:L2')
		->setCellValue('A2', 'Tahun '.$tahun2)
		->setCellValue('A4', 'No')
		->setCellValue('B4', 'NUPTK')
		->setCellValue('C4', 'Nama Guru')
		->setCellValue('D4', 'NIP')
		->setCellValue('E4', 'No Karpeg')
		->setCellValue('F4', 'Tempat Lahir')
		->setCellValue('G4', 'Tanggal Lahir')
		->setCellValue('H4', 'Pangkat Jabatan')
		->setCellValue('I4', 'TMT Guru')
		->setCellValue('J4', 'Jenis Kelamin')
		->setCellValue('K4', 'Pendidikan Terakhir')
		->setCellValue('L4', 'Program Keahlian')
		->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	} else {
		$objPHPExcel->setActiveSheetIndex(0)
				 ->mergeCells('A1:L1')
				 ->setCellValue('A1', 'Data Guru Sekolah Dasar (SD)')
				 ->mergeCells('A2:L2')
				 ->setCellValue('A2', 'Tahun '.$tahun2)
				 ->setCellValue('A4', 'No')
				 ->setCellValue('B4', 'NUPTK')
				 ->setCellValue('C4', 'Nama Guru')
				 ->setCellValue('D4', 'NIP')
				 ->setCellValue('E4', 'No Karpeg')
				 ->setCellValue('F4', 'Tempat Lahir')
				 ->setCellValue('G4', 'Tanggal Lahir')
				 ->setCellValue('H4', 'Pangkat Jabatan')
				 ->setCellValue('I4', 'TMT Guru')
				 ->setCellValue('J4', 'Jenis Kelamin')
				 ->setCellValue('K4', 'Pendidikan Terakhir')
				 ->setCellValue('L4', 'Program Keahlian')
				 ->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	}
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->applyFromArray( $style_header3 );
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A2')->applyFromArray( $style_header3 );
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:L4')->applyFromArray( $style_header );
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$rowNya = 5;
	$no = 0;
	if (isset($npsn_nss) and $npsn_nss !== "") {
		$guruku = $this->m_sekolahadmin->viewguru2($npsn_nss);
	} else {
		$guruku = $this->m_sekolahadmin->viewguru();
	}
	foreach ($guruku as $row) {
	$no++;
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue("A".$rowNya, $no)
	->setCellValue("B".$rowNya, $row->nuptk)
	->setCellValue("C".$rowNya, $row->nama_guru)
	->setCellValue("D".$rowNya, $row->nip)
	->setCellValue("E".$rowNya, $row->karpeg)
	->setCellValue("F".$rowNya, $row->tempat_lahir)
	->setCellValue("G".$rowNya, $row->tgl_lahir)
	->setCellValue("H".$rowNya, $row->pangkat_jabatan)
	->setCellValue("I".$rowNya, $row->tmt_guru)
	->setCellValue("J".$rowNya, $row->jenis_kelamin)
	->setCellValue("K".$rowNya, $row->pendidikan_terakhir)
	->setCellValue("L".$rowNya, $row->program_keahlian);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNya.':L'.$rowNya.'')->applyFromArray( $style_header2);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$rowNya.':A'.$rowNya.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('B'.$rowNya.':L'.$rowNya.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$rowNya++;
	}					

	$sheet = $objPHPExcel->getActiveSheet();
	$sheet->getColumnDimension('A')->setWidth(10);
	$sheet->getColumnDimension('B')->setWidth(20);
	$sheet->getColumnDimension('C')->setWidth(40);
	$sheet->getColumnDimension('D')->setWidth(20);
	$sheet->getColumnDimension('E')->setWidth(20);
	$sheet->getColumnDimension('F')->setWidth(30);
	$sheet->getColumnDimension('G')->setWidth(30);
	$sheet->getColumnDimension('H')->setWidth(30);
	$sheet->getColumnDimension('I')->setWidth(30);
	$sheet->getColumnDimension('J')->setWidth(30);
	$sheet->getColumnDimension('K')->setWidth(30);
	$sheet->getColumnDimension('L')->setWidth(30);	

	// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

	// Set judul file excel nya
	$objPHPExcel->getActiveSheet(0)->setTitle("Laporan Data Guru ".$tahun2);
	$objPHPExcel->setActiveSheetIndex(0);
	if (isset($npsn_nss) and $npsn_nss !== "") {
		$judul = "Data Guru ".$namasekolah." Tahun ".$tahun2;
	} else {
		$judul = "Data Guru SD Tahun ".$tahun2;
	}
	//office 2007	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="'.$judul.'.xlsx'); // Set nama file excel nya
	header('Cache-Control: max-age=0');
	$write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$write->save('php://output');					 
	}
}

    function ajax_data_sekolah() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
                $data = $this->m_sekolahadmin->sekolah_list();
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
