<?php
class Cetakkinerja extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_cetakkinerja');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
			$id_kompetensi = $this->input->get('id_kompetensi');
            if (isset($id_kompetensi) and $id_kompetensi !== "") { 
			  $this->load->view(FOLDER_SD_USER.'datacetakkinerja'); 
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SD_USER.'datacetakkinerja');
            }
            
        }
	}

	function ajax_data_cetak_kinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$nuptk = $this->session->userdata("username");
				$data = $this->m_cetakkinerja->cetakkinerja_list($nuptk);
                echo json_encode($data);
            }
			else {
				show_404();
			}
        } else {
          show_404();
       }
	}
	
	
	function lampiransatub(){
		$success = require_once "dompdf/autoload.inc.php";
		if (!$success) {
			echo "Error. Cannot include and initialize dompdf";
		} else {	
		$nuptk = $this->session->userdata("username");
		$tahun = $this->session->userdata("tahun");
		$data2= $this->m_cetakkinerja->getdataguru($nuptk);
		$data3= $this->m_cetakkinerja->getdataassesor($nuptk);
		$data5= $this->m_cetakkinerja->getdatasekolah($nuptk);
		$cetak = "";
		foreach ($data3 as $row3) { $nama_assesor= $row3->nama_guru;};	
		foreach ($data5 as $row5) { $nama_sekolah= $row5->nama_sekolah; $no_daerah = $row5->no_daerah;};
		$data6= $this->m_cetakkinerja->getdaerah($no_daerah);
		foreach ($data6 as $row6) { $prov=$row6->nama_provinsi; $kabkota= $row6->kota_kab." ".$row6->nama_kota_kab;$kec=$row6->nama_kec; $desakel=$row6->nama_desa_kel; $kodepos=$row6->kode_pos;};	
		$data7= $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($data7 as $row7) { $tahunku= $row7->tahun;};
		foreach ($data2 as $row2) { 
		$nama_guru = $row2->nama_guru;
		$tanggal = $row2->tmt_guru;
		$tmt_guru = $this->m_cetakkinerja->tanggal_showdetail($tanggal);
		$cetak .="<style>table, th, td {border: 0px solid black;border-collapse: collapse;} table{page-break-inside: auto;}.page_break { page-break-before: always; }#right{float:right;width:100px;border:1px solid black;padding:5px;}#judul{font-size:16px;}#judul2{font-size:14px;}table.center{margin-left:auto;margin-right:auto;}.hangingindent{padding-left: 24px ;text-indent: -20px ;} table tbody tr td {word-wrap: break-word;word-break: break-word;}</style>";
		$cetak .= "<div id='right'><center><b>Lampiran 1B</b></center></div>";
		$cetak .= "<br/><br/><br/><br/>";
		$cetak .= "<div id='judul'><center><b>LAPORANAN EVALUASI<br/>PENILAIAN KINERJA GURU KELAS/GURU MATA PELAJARAN</center></b></div>";
		$cetak .= "<br/><br/>";
		$cetak .= "<table width=90% class='center'>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='40px'>Nama Guru</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nama_guru."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='40px'>NIP/Nomor Seri Karpeg</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nip." / ".$row2->karpeg."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='40px'>Pangkat / Golongan Ruang</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->pangkat_jabatan."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='40px'>Terhitung Mulai Tanggal</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$tmt_guru."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='40px'>NUPTK</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nuptk."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='40px'>Nama Sekolah</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$nama_sekolah."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='35%' height='60px'>Alamat Sekolah</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$desakel." ".$kec." ".$kabkota." ".$prov." Kode Pos ".$kodepos."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
					<td width='35%' height='40px'>Periode Penilaian</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>1 Januari ".$tahunku." sampai 31 Desember ".$tahunku."</td>
				   </tr>";
		$cetak .= "</table>";
		$cetak .= "<br/><br/><br/>";
		$cetak .= "<table width=90% class='center' style='padding:20px; outline-style: solid;outline-width: 1px;'>";
		$cetak .= "<tr valign='top'>
				   <td colspan=4 height='40px'><div id='judul2'><center><b>PERSETUJUAN</b><br/><i>(Persetujuan ini harus ditandatangi oleh penilai dan guru yang dinilai)</i></center></div></td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td colspan=4 height='40px'>
				   Penilai dan guru yang dinilai menyatakan telah membaca dan memahami semua aspek yang ditulis/dilaporkan dalam format ini dan menyatakan setuju.<br/><br/><br/>
				   </td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='15%' height='50px'>Nama Guru</td>
				   <td width='35%'>$row2->nama_guru</td>
				   <td width='15%'>Nama Penilai</td>
				   <td width='35%'>$nama_assesor</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='15%' height='40px'>Tandatangan</td>
				   <td width='35%' style='border-bottom: 1px solid black;'></td>
				   <td width='15%'>Tandatangan</td>
				   <td width='35%' style='border-bottom: 1px solid black;'></td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td colspan=4 height='30px'>&nbsp;</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
					<td width='15%' height='60px'>Tanggal</td>
				   <td colspan=3><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
				    bulan
				    <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
				    tahun
				    <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
				   </tr>";
		$cetak .= "</table>";
		};
		$dompdf =  new Dompdf\Dompdf();		
		$dompdf->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><a style="display: inline-block; font-size:13px; text-align: left; width: 100%;font-family:\'times new roman\';">'.$cetak.'</a>');
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		//get data tahun
		$tahun = $this->session->userdata("tahun");
		$gettahun = $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($gettahun as $rowku) {$tahunku=$rowku->tahun;}
		// Output the generated PDF to Browser
		$namefile = "Lampiran 1B (".$nama_guru.") Tahun ".$tahunku;
		$dompdf->stream($namefile.".pdf");
		}	
	}

	function lampiransatuc() {
		$success = require_once "dompdf/autoload.inc.php";
		if (!$success) {
			echo "Error. Cannot include and initialize dompdf";
		} else {	
		$nuptk = $this->session->userdata("username");
		$tahun = $this->session->userdata("tahun");
		$data2= $this->m_cetakkinerja->getdataguru($nuptk);
		$data3= $this->m_cetakkinerja->getdataassesor($nuptk);
		$data5= $this->m_cetakkinerja->getdatasekolah($nuptk);		
		$cetak = "";
		foreach ($data3 as $row3) { $nama_assesor= $row3->nama_guru;};	
		foreach ($data5 as $row5) { $nama_sekolah= $row5->nama_sekolah; $telp_fax= $row5->telp_fax; $no_daerah = $row5->no_daerah; $npsn_nss = $row5->npsn_nss;};
		$data8= $this->m_cetakkinerja->getdatakepalasekolah($npsn_nss);
		foreach ($data8 as $row8) {$kepala_sekolah = $row8->nama_guru;};
		$data6= $this->m_cetakkinerja->getdaerah($no_daerah);
		foreach ($data6 as $row6) { $prov=$row6->nama_provinsi; $kabkota= $row6->kota_kab." ".$row6->nama_kota_kab;$kec=$row6->nama_kec; $desakel=$row6->nama_desa_kel; $kodepos=$row6->kode_pos;};	
		$data7= $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($data7 as $row7) { $tahunku= $row7->tahun;};
		foreach ($data2 as $row2) { 
		$tanggal = $row2->tgl_lahir;
		$tgl_lahir = $this->m_cetakkinerja->tanggal_showdetail($tanggal);
		$nama_guru = $row2->nama_guru;
		$tanggal = $row2->tmt_guru;
		$tmt_guru = $this->m_cetakkinerja->tanggal_showdetail($tanggal);
		$cetak .="<style>#dataguru{border: 0px solid black;border-collapse: collapse;} #periode{border-collapse: collapse;} #kompetensi{border-collapse: collapse; font-size:12px;} table{page-break-inside: auto;}.page_break { page-break-before: always; } #right{float:right;width:100px;border:2px solid black;padding:5px;}#judul{font-size:16px;}#judul2{font-size:14px;}table.center {margin-left:auto;margin-right:auto;} .hangingindent {padding-left: 10px ; text-indent: 0px ;}.hangingindent2 {padding-left: 10px ; text-indent: 0px ; font-size:14px}  table tbody tr td {word-wrap: break-word;word-break: break-word;}</style>";
		$cetak .= "<div id='right'><center><b>Lampiran 1C</b></center></div>";
		$cetak .= "<br/><br/><br/><br/>";
		$cetak .= "<div id='judul'><center><b>REKAP HASIL PENILAIAN KINERJA GURU KELAS/MATA PELAJARAN</b></center></div>";
		$cetak .= "<br/><br/>";
		$cetak .= "<table width=100% class='center dataguru' id='dataguru'>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'>a.</td>
				   <td width='40%'>Nama</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nama_guru."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>NIP</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nip." / ".$row2->karpeg."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Tempat/Tanggal Lahir</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->tempat_lahir.", ".$tgl_lahir."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>NUPTK</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nuptk."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Pangkat/Jabatan/Golongan</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->pangkat_jabatan."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>TMT Sebagai Guru</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$tmt_guru."</td>
				   </tr>";
		/*$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Masa Kerja</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>"."</td>
				   </tr>"; */
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Jenis Kelamin</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->jenis_kelamin."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Pendidikan Terakhir/Spesialisasi</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->pendidikan_terakhir."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Keahlian yang diampu</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->program_keahlian."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'>b.</td>
				   <td width='40%'>Nama Instansi/Sekolah</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$nama_sekolah."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Telp/Fax</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$telp_fax."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Kelurahan</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$desakel."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Kecamatan</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$kec."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Kabupaten/Kota</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$kabkota."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Provinsi</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$prov."</td>
				   </tr>";
		$cetak .= "</table>";
		$cetak .= "<br/>";
		$cetak .= "<table width=100% class='center periode' id='periode'>";
		$cetak .= "<tr valign='top'>
				   <td width='45%' height='40px' rowspan=3 style='border: 1px solid black;'>Periode Penilaian<br/>1 Januari ".$tahunku." sampai 31 Desember ".$tahunku."</td>
				   <td width='20%' style='border: 1px solid black;'>Formatif</td>
				   <td width='10%' style='border: 1px solid black;'></td>
				   <td width='30%' class='underline' rowspan=3 style='border: 1px solid black;'>Tahun : ".$tahunku."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='20%' style='border: 1px solid black;'>Sumatif</td>
				   <td width='10%' style='border: 1px solid black;'></td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='20%' style='border: 1px solid black;'>Kemajuan</td>
				   <td width='10%' style='border: 1px solid black;'></td>
				   </tr>";
		$cetak .= "</table>";
		$cetak .= "<br/>";
		$cetak .= "<table width=100% class='center' id='kompetensi'>";
		$cetak .= "<tr valign='middle' height='30px'>
				   <td width='8%' height='30px' style='border: 1px solid black; background:#D3D3D3;'><center><b>NO</b></center></td>
				   <td width='70%' style='border: 1px solid black; background:#D3D3D3;'><center><b>KOMPETENSI</b></center></td>
				   <td width='22%' style='border: 1px solid black; background:#D3D3D3;'><center><b>NILAI</b></center></td>
					</tr>";	
		$nuptk = $this->session->userdata("username");
		$data20= $this->m_cetakkinerja->getdatagurukompetensi($nuptk);
		foreach ($data20 as $row20) {$id_kelompok = $row20->id_kelompok;};
		$data= $this->m_cetakkinerja->getdatacetakkinerja5($id_kelompok, $nuptk);
		$jumkompetensi = 0;	
		$nilaimakspk= 0;	
		foreach ($data as $row) {
		$id_kompetensi = $row->id_kompetensi;
		$data4= $this->m_cetakkinerja->getdatacetakkinerja2($id_kompetensi, $id_kelompok, $nuptk);
		$jumindikator = 0;
		$totalskor = 0;
		$jumhasilakhir = 0;		
		foreach ($data4 as $row4) {				
		$jumindikator = $jumindikator + 1;
		$totalskor = $totalskor + $row4->skor;
		$skormaks = $jumindikator * 2;
		$prosentase = ($totalskor / $skormaks) * 100;
		if ($prosentase >= 0 and $prosentase <= 25 ) {
		$nilaiakhir = 1;
		} else if ($prosentase > 25 and $prosentase <= 50 ) {
		$nilaiakhir = 2;
		} else if ($prosentase > 50 and $prosentase <= 75 ) {
		$nilaiakhir = 3;
		}
		else if ($prosentase > 75 and $prosentase <= 100 ) {
		$nilaiakhir = 4;
		}
		$id_indikator = $row4->id_indikator;
		}
		$cetak .= "<tr>
			<td style='border: 1px solid black;'><p class='hangingindent2'><center>".$row->no_urut_kompetensi."</center></p></td>
			<td style='border: 1px solid black;'><p class='hangingindent2'>".$row->nama_kompetensi."</p></td>
			<td style='border: 1px solid black;'><center><b>". $nilaiakhir."</b></center></td>
			</tr>";			
			$gabungan = $gabungan + $nilaiakhir;
			$nilaiakhir = 0;
			$jumkompetensi = $jumkompetensi + 1;
		};
		$jumhasilakhir = $jumhasilakhir + $gabungan;		
		$nilaimakspk = $nilaimakspk + ($jumkompetensi * 4);
		$konversi = ($jumhasilakhir/$nilaimakspk)*100;
		};
		$cetak .= "<tr valign='top'>
				   <td style='border: 1px solid black;' colspan='2'><b>Jumlah (Hasil penilaian kinerja guru)</b></td>
				   <td style='border: 1px solid black;'><center><b>".$jumhasilakhir."</b></center></td>
				   </tr>";
		$cetak .= "<tr>
				   <td style='border: 1px solid black;' colspan='2' valign='top'>Konversi nilai PK Guru ke dalam skala 0 - 100<br/>Nilai PK Guru (100) = <u><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nilai PK Guru&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></u> x 100<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>nilai maksimum PK Guru</i></td>
				   <td style='border: 1px solid black;' valign='middle'><center><b>".round($konversi,3)."</b></center></td>
					</tr>";
		$cetak .= "</table>";
		$cetak .= "<p style='font-size:11px;'>*) Nilai diisi berdasarkan laporan dan evaluasi PK Guru. Nilai minimum per kompetensi = 1 dan nilai maksimum = 4</p>";
		$cetak .= "<br/>";
		$cetak .= "<table width=100% class='center'>";
		$cetak .= "<tr valign='top'>
				   <td colspan=5 align='right'>.......................... , .............................................</td>
					</tr>";
		$cetak .= "<tr valign='top'>
				   <td width='30%'>Guru Yang Dinilai</td>
				   <td width='2%'></td>
				   <td width='30%'>Penilai</td>
				   <td width='2%'></td>
				   <td width='35%'>Kepala Sekolah/Atasan Langsung</td>
					</tr>";
		$cetak .= "<tr valign='top'><td height=60px></td><td></td><td></td><td></td><td></td></tr>";
		$cetak .= "<tr valign='top'>
				   <td>( ".$row2->nama_guru." )</td>
				   <td></td>
				   <td>( ".$nama_assesor." )</td>
				   <td></td>
				   <td>( ".$kepala_sekolah." )</td>
					</tr>";
		$cetak .= "</table>";
		$dompdf =  new Dompdf\Dompdf();		
		$dompdf->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><a style="display: inline-block; font-size:13px; text-align: left; width: 100%;font-family:\'times new roman\';">'.$cetak.'</a>');
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		//get data tahun
		$tahun = $this->session->userdata("tahun");
		$gettahun = $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($gettahun as $rowku) {$tahunku=$rowku->tahun;}
		// Output the generated PDF to Browser
		$namefile = "Lampiran 1C (".$row2->nama_guru.") Tahun ".$tahunku;
		$dompdf->stream($namefile.".pdf");
		}	
	}

	
	function lampiransatud() {
		$success = require_once "dompdf/autoload.inc.php";
		if (!$success) {
			echo "Error. Cannot include and initialize dompdf";
		} else {	
		$nuptk = $this->session->userdata("username");
		$tahun = $this->session->userdata("tahun");
		$data2= $this->m_cetakkinerja->getdataguru($nuptk);
		$data3= $this->m_cetakkinerja->getdataassesor($nuptk);
		$data5= $this->m_cetakkinerja->getdatasekolah($nuptk);		
		$cetak = "";
		foreach ($data3 as $row3) { $nama_assesor= $row3->nama_guru;};	
		foreach ($data5 as $row5) { $nama_sekolah= $row5->nama_sekolah; $telp_fax= $row5->telp_fax; $no_daerah = $row5->no_daerah; $npsn_nss = $row5->npsn_nss;};
		$data8= $this->m_cetakkinerja->getdatakepalasekolah($npsn_nss);
		foreach ($data8 as $row8) {$kepala_sekolah = $row8->nama_guru;};
		$data6= $this->m_cetakkinerja->getdaerah($no_daerah);
		foreach ($data6 as $row6) { $prov=$row6->nama_provinsi; $kabkota= $row6->kota_kab." ".$row6->nama_kota_kab;$kec=$row6->nama_kec; $desakel=$row6->nama_desa_kel; $kodepos=$row6->kode_pos;};	
		$data7= $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($data7 as $row7) { $tahunku= $row7->tahun;};
		foreach ($data2 as $row2) { 
		$tanggal = $row2->tgl_lahir;
		$tgl_lahir = $this->m_cetakkinerja->tanggal_showdetail($tanggal);
		$nama_guru = $row2->nama_guru;
		$tanggal = $row2->tmt_guru;
		$tmt_guru = $this->m_cetakkinerja->tanggal_showdetail($tanggal);
		$cetak .="<style>#dataguru{border: 0px solid black;border-collapse: collapse;} #periode{border-collapse: collapse;} #kompetensi{border-collapse: collapse; font-size:12px;} #penilaian{border-collapse: collapse; font-size:12px;}  table{page-break-inside: auto;}.page_break { page-break-before: always; } #right{float:right;width:100px;border:2px solid black;padding:5px;}#judul{font-size:16px;}#judul2{font-size:14px;}table.center {margin-left:auto;margin-right:auto;} .hangingindent {padding-left: 10px ; text-indent: 0px ;}.hangingindent2 {padding-left: 10px ; text-indent: 0px ; font-size:14px;}  table tbody tr td {word-wrap: break-word;word-break: break-word;}</style>";
		$cetak .= "<div id='right'><center><b>Lampiran 1D</b></center></div>";
		$cetak .= "<br/><br/><br/><br/>";
		$cetak .= "<div id='judul'><center><b>FORMAT PERHITUNGAN ANGKA KREDIT PK GURU KELAS/<br/>GURU MATA PELAJARAN</b></center></div>";
		$cetak .= "<br/><br/>";
		$cetak .= "<table width=100% class='center dataguru' id='dataguru'>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'>a.</td>
				   <td width='40%'>Nama</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nama_guru."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>NIP</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nip." / ".$row2->karpeg."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Tempat/Tanggal Lahir</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->tempat_lahir.", ".$tgl_lahir."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>NUPTK</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->nuptk."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Pangkat/Jabatan/Golongan</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->pangkat_jabatan."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>TMT Sebagai Guru</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$tmt_guru."</td>
				   </tr>";
		/*$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Masa Kerja</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>"."</td>
				   </tr>"; */
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Jenis Kelamin</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->jenis_kelamin."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Pendidikan Terakhir/Spesialisasi</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->pendidikan_terakhir."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Keahlian yang diampu</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$row2->program_keahlian."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'>b.</td>
				   <td width='40%'>Nama Instansi/Sekolah</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$nama_sekolah."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Telp/Fax</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$telp_fax."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Kelurahan</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$desakel."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Kecamatan</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$kec."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Kabupaten/Kota</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$kabkota."</td>
				   </tr>";
		$cetak .= "<tr valign='top'>
				   <td width='5%' height='20px'></td>
				   <td width='40%'>Provinsi</td>
				   <td width='2%'>:</td>
				   <td width='63%' class='underline'>".$prov."</td>
				   </tr>";
		$cetak .= "</table>";
		$cetak .= "<br/>";
		$cetak .= "<table width=100% class='center' id='penilaian'>";
		$cetak .= "<tr valign='middle' height='60px'>
				   <td width='8%' style='border: 1px solid black; background:#D3D3D3;'><center><b>No</b></center></td>
				   <td width='53%' style='border: 1px solid black; background:#D3D3D3;'><center><b>Penilaian</b></center></td>
				   <td width='13%' style='border: 1px solid black; background:#D3D3D3;'><center><b>Hasil<br/>Penilaian<br/>Skala 100</b></center></td>
				   <td width='13%' style='border: 1px solid black; background:#D3D3D3;'><center><b>Proporsi</b></center></td>
				   <td width='13%' style='border: 1px solid black; background:#D3D3D3;'><center><b>Nilai</b></center></td>
					</tr>";
		$jumpkg = 0;
		$nuptk = $this->session->userdata("username");
		$data20= $this->m_cetakkinerja->getdatagurukompetensi($nuptk);
					foreach ($data20 as $row20) {$id_kelompok = $row20->id_kelompok;};
					$data= $this->m_cetakkinerja->getdatacetakkinerja5($id_kelompok, $nuptk);
					$jumkompetensi = 0;	
					$nilaimakspk= 0;	
					foreach ($data as $row) {
					$id_kompetensi = $row->id_kompetensi;
					$data4= $this->m_cetakkinerja->getdatacetakkinerja2($id_kompetensi, $id_kelompok, $nuptk);
					$jumindikator = 0;
					$totalskor = 0;
					$jumhasilakhir = 0;		
					foreach ($data4 as $row4) {				
					$jumindikator = $jumindikator + 1;
					$totalskor = $totalskor + $row4->skor;
					$skormaks = $jumindikator * 2;
					$prosentase = ($totalskor / $skormaks) * 100;
					if ($prosentase >= 0 and $prosentase <= 25 ) {
					$nilaiakhir = 1;
					} else if ($prosentase > 25 and $prosentase <= 50 ) {
					$nilaiakhir = 2;
					} else if ($prosentase > 50 and $prosentase <= 75 ) {
					$nilaiakhir = 3;
					}
					else if ($prosentase > 75 and $prosentase <= 100 ) {
					$nilaiakhir = 4;
					}
					$id_indikator = $row4->id_indikator;
					}		
						$gabungan = $gabungan + $nilaiakhir;
						$nilaiakhir = 0;
						$jumkompetensi = $jumkompetensi + 1;
					};
					$jumhasilakhir = $jumhasilakhir + $gabungan;		
					$nilaimakspk = $nilaimakspk + ($jumkompetensi * 4);
					$konversi = ($jumhasilakhir/$nilaimakspk)*100;
					$hasilkonversi = $konversi * 0.7;
					$jumpkg = $jumpkg + $hasilkonversi;
					};		
		$cetak .=	"<tr valign='top'>
					<td style='border: 1px solid black;' class='hangingindent2'><center>1</center></td>
					<td style='border: 1px solid black;' class='hangingindent2'>Atasan (Kepala Sekolah/Pengawas/Guru Senior)</td>
					<td style='border: 1px solid black;'><center>".round($konversi,3)."</center></td>
					<td style='border: 1px solid black;'><center>70%</center></td>
					<td style='border: 1px solid black;'><center>".round($hasilkonversi,3)."</center></td>
					</tr>";
		$nuptk = $this->session->userdata("username");
		$no = 1;
		$data10 = $this->m_cetakkinerja->getdatahasilkuisioner($nuptk);
		foreach ($data10 as $row10) {
            if (strtolower($row10->nama_kuisioner) != "tidak hadir tanpa keterangan" and strtolower($row10->nama_kuisioner) != "jumlah jam mengajar") {
                $no = $no + 1;
				$nilai_kuisioner2 = $row10->nilai_kuisioner * 0.1;
				$jumpkg = $jumpkg + $nilai_kuisioner2;
                $cetak .=	"<tr valign='top'>
					<td style='border: 1px solid black;' class='hangingindent2'><center>".$no."</center></td>
					<td style='border: 1px solid black;' class='hangingindent2'>".$row10->nama_kuisioner."</td>
					<td style='border: 1px solid black;'><center>".$row10->nilai_kuisioner."</center></td>
					<td style='border: 1px solid black;'><center>10%</center></td>
					<td style='border: 1px solid black;'><center>".$nilai_kuisioner2."</center></td>
					</tr>";
            }
		}
		$cetak .=	"<tr valign='top'>
					<td colspan='2' style='border: 1px solid black;'>Nilai PKG = <i>Jumlah Nilai</i></td>
					<td colspan='3' style='border: 1px solid black;'><center>".$jumpkg."</center></td>
					</tr>";
		$data11 = $this->m_cetakkinerja->getdatahasilkuisioner($nuptk);
		foreach ($data11 as $row11) {
			if (strtolower($row11->nama_kuisioner) == "tidak hadir tanpa keterangan") 
			{
			$tidakhadir = $row11->nilai_kuisioner;
			$cetak .=	"<tr valign='top'>
				<td colspan='2' style='border: 1px solid black;'>Tidak Hadir Tanpa Keterangan = <i>(a hari)</i></Tidak></td>
				<td colspan='3' style='border: 1px solid black;'><center>".$tidakhadir." hari</center></td>
				</tr>";
			}
		}
		$persentasetidakhadir = 1 - ($tidakhadir/46) * 1;
		$hasilpersentasetidakhadir = $persentasetidakhadir * 100;
		$nilaiakhirpkg = $persentasetidakhadir * $jumpkg;
		$cetak .=	"<tr valign='top'>
					<td colspan='2' style='border: 1px solid black;'>Persentase Nilai PKG dari Kehadiran = 100% - (a/46) x 100%</td>
					<td colspan='3' style='border: 1px solid black;'><center>".round($hasilpersentasetidakhadir,2)." %</center></td>
					</tr>";
		$cetak .=	"<tr valign='top'>
					<td colspan='2' style='border: 1px solid black;'>Nilai Akhir PKG = Nilai PKG x Persentase Nilai PKG dari Kehadiran</td>
					<td colspan='3' style='border: 1px solid black;'><center>".round($nilaiakhirpkg,2)."</center></td>
					</tr>";
					if ($nilaiakhirpkg > 90 and $nilaiakhirpkg <=100) {
						$sebutan = "Amat Baik";
						$sebutan2 = "125%";
						$npk = 1.25;
					} else if ($nilaiakhirpkg > 75 and $nilaiakhirpkg <=90) {
						$sebutan = "Baik";
						$sebutan2 = "100%";
						$npk = 1;
					} else if ($nilaiakhirpkg > 60 and $nilaiakhirpkg <=75) {
						$sebutan = "Cukup";
						$sebutan2 = "75%";
						$npk = 0.75;
					} else if ($nilaiakhirpkg > 50 and $nilaiakhirpkg <=60) {
						$sebutan = "Sedang";
						$sebutan2 = "50%";
						$npk = 0.5;
					} else if ($nilaiakhirpkg <= 50) {
						$sebutan = "Kurang";
						$sebutan2 = "25%";
						$npk = 0.25;
					}
		$cetak .=	"<tr valign='middle'>
					<td colspan='2' style='border: 1px solid black;'>
					<table width='100%'><tr><td width='50%' style='border-right: 1px solid black;'>Sebutan</td><td width='50%'>Nilai Persentase Kinerja<br/>(NPK)</td></tr></table>
					</td>					
					<td colspan='2' style='border: 1px solid black;'><center>".$sebutan."</center></td>
					<td style='border: 1px solid black;'><center>".$sebutan2."</center></td>
					</tr>";
		$golongan =	$this->m_cetakkinerja->getdataguru($nuptk);
		foreach ($golongan as $getgol) {$getgolongan = $getgol->pangkat_jabatan;}
		$golonganku = substr($getgolongan, strpos($getgolongan, "/") + 1); 
		if ($golonganku ==" III A") {
			$akk = 50;
			$akpkb = 3+0;
			$akp = 5;

		} else if ($golonganku ==" III B") {
			$akk = 50;
			$akpkb = 3+4;
			$akp = 5;
		}
		else if ($golonganku ==" III C") {
			$akk = 100;
			$akpkb = 3+6;
			$akp = 10;
		}
		else if ($golonganku ==" III D") {
			$akk = 100;
			$akpkb = 4+8;
			$akp = 10;
		}
		else if ($golonganku ==" IV A") {
			$akk = 150;
			$akpkb = 4+12;
			$akp = 15;
		}
		else if ($golonganku ==" IV B") {
			$akk = 150;
			$akpkb = 4+12;
			$akp = 15;
		}
		else if ($golonganku ==" IV C") {
			$akk = 150;
			$akpkb = 5+14;
			$akp = 15;
		}
		else if ($golonganku ==" IV D") {
			$akk = 200;
			$akpkb = 4+12;
			$akp = 15;
		}
		else if ($golonganku ==" IV E") {
			$akk = 200;
			$akpkb = 4+12;
			$akp = 15;
		}
		$data111 = $this->m_cetakkinerja->getdatahasilkuisioner($nuptk);
		foreach ($data111 as $row111) {
			if (strtolower($row111->nama_kuisioner) == "jumlah jam mengajar") 
			{
			$jm = $row111->nilai_kuisioner;
			}
		}
		$data1111 = $this->m_cetakkinerja->getdatasekolah($nuptk);
		foreach ($data1111 as $row1111) {
			if (strtolower($row1111->jenis_guru) == "guru kelas") 
			{
			$jwm = 24;
			if ($jm > $jwm) {
				$jm = 24;
			}
			}
			else if (strtolower($row1111->jenis_guru) == "guru mata pelajaran") 
			{
			$jwm = 24;
			if ($jm > $jwm) {
				$jm = 24;
			}
			}
		}
		$angkakredit = (($akk - $akpkb - $akp) * $jm / $jwm * $npk ) / 4;
		$cetak .=	"<tr valign='middle'>
					<td colspan='2' style='border: 1px solid black;'>Angka Kredit : <i><u>(AKK - AKPKB - AKP) x JM / JWM x NPK</u></i><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4</Angka></td>
					<td colspan='3' style='border: 1px solid black;'><center>".$angkakredit."</center></td>
					</tr>";
		$cetak .= "</table>";	
		$cetak .= "<br/>";
		$cetak .= "<table width=100% class='center'>";
		$cetak .= "<tr valign='top'>
				   <td width='100%' colspan=5 align='right'>.......................... , .............................................</td>
					</tr>";
		$cetak .= "<tr valign='top'>
				   <td width='27%'>Guru Yang Dinilai</td>
				   <td width='7%'></td>
				   <td width='27%'>Penilai</td>
				   <td width='7%'></td>
				   <td width='30%'>Kepala Sekolah/Atasan Langsung</td>
					</tr>";
		$cetak .= "<tr valign='top'><td height=60px></td><td></td><td></td><td></td><td></td></tr>";
		$cetak .= "<tr valign='top'>
				   <td>( ".$row2->nama_guru." )</td>
				   <td></td>
				   <td>( ".$nama_assesor." )</td>
				   <td></td>
				   <td>( ".$kepala_sekolah." )</td>
					</tr>";
		$cetak .= "</table>";
		$dompdf =  new Dompdf\Dompdf();		
		$dompdf->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><a style="display: inline-block; font-size:13px; text-align: left; width: 100%;font-family:\'times new roman\';">'.$cetak.'</a>');
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		//get data tahun
		$tahun = $this->session->userdata("tahun");
		$gettahun = $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($gettahun as $rowku) {$tahunku=$rowku->tahun;}
		// Output the generated PDF to Browser
		$namefile = "Lampiran 1D (".$row2->nama_guru.") Tahun ".$tahunku;
		$dompdf->stream($namefile.".pdf");
		}	
	}

	function cetakpenilaian(){
		$success = require_once "dompdf/autoload.inc.php";
		if (!$success) {
			echo "Error. Cannot include and initialize dompdf";
		} else {		
		$nuptk = $this->session->userdata("username");
		$id_kelompok= $this->input->get('id_kelompok');
		$id_kompetensi = $this->input->get('id_kompetensi');
		$data= $this->m_cetakkinerja->getdatacetakkinerja($id_kompetensi, $id_kelompok);
		$data2= $this->m_cetakkinerja->getdataguru($nuptk);
		$data3= $this->m_cetakkinerja->getdataassesor($nuptk);
		$data4= $this->m_cetakkinerja->getdatacetakkinerja2($id_kompetensi, $id_kelompok,$nuptk);
		$cetak = "";
		foreach ($data2 as $row2) { $nama_guru= $row2->nama_guru; };
		foreach ($data3 as $row3) { $nama_assesor= $row3->nama_guru; };
		foreach ($data as $row) {
		$cetak .="<style>table, th, td {border: 1px solid black;border-collapse: collapse;} table{page-break-inside: auto;}.page_break { page-break-before: always; }
		.hangingindent {padding-left: 24px; text-indent: -20px;}.circle.small{border: 2px solid #000000;border-radius: 50%;width:20px;height:20px;z-index: 86;margin-left: 40%;}</style>";
		$cetak .= "<div style='font-size:17px;'><b>Kompetensi ".$row->no_urut_kompetensi." : <a style='border-bottom: 1px solid #000000;'>".$row->nama_kompetensi."</a></b></div>";
		$cetak .= "<a style='font-size:17px;'>Nama Guru&nbsp;&nbsp;&nbsp;&nbsp;: ".$nama_guru;
		$cetak .= "</a><br/>";
		$cetak .= "<a style='font-size:17px;'>Nama Penilai&nbsp;: ".$nama_assesor."</a>";
		//sebelum pengamatan jika status ya
        if ($row->sebelum_pengamatan =="Ya") {
            $cetak .= "<br/><br/>";
            $cetak .= "<b>Sebelum Pengamatan</b><br/><br/>";
            $cetak .= "<table width='100%'> 
					<tr>
					<td width='25%'>Tanggal<br/></td>
					<td><br/><br/></td>
					</tr>
					<tr>
					<td width='25%'>Dokumen dan bahan<br/>lain yang diperiksa<br/></td>
					<td><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Tanggapan Penilai terhadap dokumen dan/atau keterangan guru</i><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Tindak lanjut yang diperlukan:</i><br/><br/><br/><br/><br/><br/></td>
					</tr>
				   </table>";
		}
		//selama pengamatan jika status ya
        if ($row->selama_pengamatan =="Ya") {
            $cetak .= "<br/><br/>";
            $cetak .= "<b>Selama Pengamatan</b><br/><br/>";
            $cetak .= "<table width='100%'> 
					<tr>
					<td width='25%'>Tanggal<br/></td>
					<td><br/><br/></td>
					</tr>
					<tr>
					<td width='25%'>Dokumen dan bahan<br/>lain yang diperiksa<br/></td>
					<td><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Kegiatan/aktivitas guru dan peserta didik selama pengamatan:</i><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Tindak lanjut yang diperlukan:</i><br/><br/><br/><br/><br/><br/></td>
					</tr>
				   </table>";
		}
		//setelah pengamatan jika status ya
        if ($row->setelah_pengamatan =="Ya") {
            $cetak .= "<br/><br/>";
            $cetak .= "<b>Setelah Pengamatan</b><br/><br/>";
            $cetak .= "<table width='100%'> 
					<tr>
					<td width='25%'>Tanggal<br/></td>
					<td><br/><br/></td>
					</tr>
					<tr>
					<td width='25%'>Dokumen dan bahan<br/>lain yang diperiksa<br/></td>
					<td><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Setelah Pengamatan: Tanggapan Penilai terhadap dokumen dan/atau keterangan guru</i><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Tindak lanjut yang diperlukan:</i><br/><br/><br/><br/><br/><br/></td>
					</tr>
				   </table>";
		}
		//pemantauan jika status ya 
        if ($row->pemantauan == "Ya" ) {
            $cetak .= "<br/><br/>";
            $cetak .= "<b>Pemantauan</b><br/><br/>";
            $cetak .= "<table width='100%'> 
					<tr>
					<td width='25%'>Tanggal<br/></td>
					<td><br/><br/></td>
					</tr>
					<tr>
					<td width='25%'>Dokumen dan bahan<br/>lain yang diperiksa<br/></td>
					<td><br/><br/><br/></td>
					</tr>
					<tr>
					<td colspan=2><i>Catatan dan Tanggapan Penilai terhadap dokumen dan/atau keterangan guru<br/>(catat kegiatan yang dilakukan)</i><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
					</tr>
				   </table>";
		}
		$cetak .="<div class='page_break'></div>";
		$cetak .= "<table width='100%'> ";
		$cetak .= "<tr><td colspan=4><b> Penilaian untuk Kompetensi ".$row->no_urut_kompetensi." : ".$row->nama_kompetensi."</b></td></tr>";
		$cetak .= "<tr><td rowspan=2 width='55%'><center><b>Indikator</b></center></td><td colspan=3><center><b>Skor</b></center></td></tr>";
		$cetak .= "<tr>
					<td width='15%'><center><b>Tidak Ada Bukti<br/>(Tidak Terpenuhi)</b></center></td>
					<td width='15%'><center><b>Terpenuhi Sebagian</b></center></td>
					<td width='15%'><center><b>Terpenuhi Seluruhnya</b></center></td>
				  </tr>";
		$jumindikator = 0;
		$totalskor = 0;
		foreach ($data4 as $row4) {	
		$jumindikator = $jumindikator + 1;			
        if ($row4->skor == 0) {
            $cetak .= "<tr>
			<td><p class='hangingindent'>".$row4->no_urut_indikator.". ".$row4->nama_indikator."</p></td>
			<td><div class='circle small'><center><b>0</b></center></div></td>
			<td><center><b>1</b></center></td>
			<td><center><b>2</b></center></td>
			</tr>";
        } else if ($row4->skor == 1) {
			$cetak .= "<tr>
			<td><p class='hangingindent'>".$row4->no_urut_indikator.". ".$row4->nama_indikator."</p></td>
			<td><center><b>0</b></center></td>
			<td><div class='circle small'><center><b>1</b></center></div></td>
			<td><center><b>2</b></center></td>
			</tr>";
		} else if ($row4->skor == 2) {
			$cetak .= "<tr>
			<td><p class='hangingindent'>".$row4->no_urut_indikator.". ".$row4->nama_indikator."</p></td>
			<td><center><b>0</b></center></td>
			<td><center><b>1</b></center></td>
			<td><div class='circle small'><center><b>2</b></center></div></td>
			</tr>";
		}
		$totalskor = $totalskor + $row4->skor;
		}
		$skormaks = $jumindikator * 2;
		$prosentase = ($totalskor / $skormaks) * 100;
		if ($prosentase >= 0 and $prosentase <= 25 ) {
		$nilaiakhir = 1;
		} else if ($prosentase > 25 and $prosentase <= 50 ) {
		$nilaiakhir = 2;
		} else if ($prosentase > 50 and $prosentase <= 75 ) {
		$nilaiakhir = 3;
		}
		else if ($prosentase > 75 and $prosentase <= 100 ) {
		$nilaiakhir = 4;
		}
		$cetak .= "<tr><td>Total Skor untuk Kompetensi ".$row->no_urut_kompetensi." </td><td colspan=3><center><b>".$totalskor."</b></center></td></tr>";
		$cetak .= "<tr><td>Skor maksimum Kompetensi ".$row->no_urut_kompetensi." = jumlah indikator x 2</td><td colspan=3><center><b>".$skormaks."</b></center></td></tr>";
		$cetak .= "<tr><td>Prosentase = (total skor / ".$skormaks.") x 100%</td><td colspan=3><center><b>".$prosentase." %</b></center></td></tr>";
		$cetak .= "<tr><td>Nilai untuk Kompetensi ".$row->no_urut_kompetensi."<br/>(0% &lt; X <a style='border-bottom: 1px solid #000000;'>&lt;</a> 25% = 1; 25% &lt; X <a style='border-bottom: 1px solid #000000;'>&lt;</a> 50% = 2;<br/>50% &lt; X <a style='border-bottom: 1px solid #000000;'>&lt;</a> 75% = 3; 75% &lt; X <a style='border-bottom: 1px solid #000000;'>&lt;</a> 100% = 4)</td><td colspan=3><center><b>".round($nilaiakhir,3)."</b></center></td></tr>";
		$cetak .= "</table>";
		}
		$dompdf =  new Dompdf\Dompdf();		
		$dompdf->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><a style="display: inline-block; font-size:14px; text-align: left; width: 100%;font-family:\'times new roman\';">'.$cetak.'</a>');
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		//get data tahun
		$tahun = $this->session->userdata("tahun");
		$gettahun = $this->m_cetakkinerja->cek_tahun($tahun);
		foreach ($gettahun as $rowku) {$tahunku=$rowku->tahun;}
		// Output the generated PDF to Browser
		$namefile = "Kompetensi ".$row->no_urut_kompetensi." ".$row->nama_kompetensi." (".$nama_guru.") Tahun ".$tahunku;
		$dompdf->stream($namefile.".pdf");
		//$dompdf->stream();
		}
	}
}
?>
