<?php
    date_default_timezone_set('Asia/Jakarta');
	function tanggal($tanggal)
	{
		$tgl1=explode("/",$tanggal);
		$tgl2=$tgl1[2]."-".$tgl1[0]."-".$tgl1[1];
		return $tgl2;
	}
	function tanggal_show($tanggal)
	{
		$tgl1=explode("-",$tanggal);
		$tgl2=$tgl1[2]."/".$tgl1[1]."/".$tgl1[0];
		return $tgl2;
	}
	function tanggal_showdetail($tanggal)
	{
		$tgl1=explode("-",$tanggal);
		switch($tgl1[1])
		{
			case "1":
			$bulan="Januari";
			break;
			
			case "2":
			$bulan="Februari";
			break;
			
			case "3":
			$bulan="Maret";
			break;
			
			case "4":
			$bulan="April";
			break;
			
			case "5":
			$bulan="Mei";
			break;
			
			case "6":
			$bulan="Juni";
			break;
			
			case "7":
			$bulan="Juli";
			break;
			
			case "8":
			$bulan="Agustus";
			break;
			
			case "9":
			$bulan="September";
			break;
			
			case "10":
			$bulan="Oktober";
			break;
			
			case "11":
			$bulan="November";
			break;
			
			case "12":
			$bulan="Desember";
			break;
			
			default:
			$bulan="";
			break;
		}
		$tgl2=$tgl1[2]." ".$bulan." ".$tgl1[0];
		return $tgl2;
	}
	function tanggal_edit($tanggal)
	{
		$tgl1=explode("-",$tanggal);
		$tgl2=$tgl1[1]."/".$tgl1[2]."/".$tgl1[0];
		return $tgl2;
	}
	function tanggal_cek($tanggal)
	{
		$tgl1=explode("/",$tanggal);
		if(checkdate($tgl1[0],$tgl1[1],$tgl1[2])){
			return 1;
		}
		else{
			return 0;
		}
	}
	function cek_angka($angka){
		if(is_numeric($angka)){
			return 1;
		}
		else{
			return 0;
		}
	}
?>