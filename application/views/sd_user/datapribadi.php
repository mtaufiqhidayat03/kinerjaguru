<?php 
$this->load->view("header.php" ); 
$this->load->view(FOLDER_SD_USER.'date.php');
$this->load->view(FOLDER_SD_USER.'panel_user.php');
?>
<style type="text/css">
div.dataTables_wrapper div.dataTables_filter input {
	 /* width:150px; */
	 display: -moz-inline-stack;
	 display:-moz-inline-box;
	 display:-moz-inline-block;
	 vertical-align:top;
}
table.dataTable thead tr th{
	/*word-wrap: break-word;
	word-break: break-all; */ 
	 white-space: nowrap; 
}
table.dataTable tbody tr td {
  /* word-wrap: break-word;
	word-break: break-all; */
	white-space: nowrap;
}
table.dataTable.dtr-inline.collapsed > tbody > tr > td.details-control:first-child:before {
  display: none;
}
label {
	font-weight: 500 !important;
}
.kt-badge.kt-badge--danger {
	font-size : 1rem !important;
}
.kt-badge.kt-badge--success {
	font-size : 1rem !important;
}
[class^="flaticon2-"]:before, [class*=" flaticon2-"]:before {
	padding-right:0.5rem !important;
}
.badgeku {
	height : 40px !important;
}
</style>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

		<!-- begin:: Subheader -->
		<!-- <div class="kt-subheader kt-grid__item" id="kt_subheader">
			<div class="kt-subheader__main">
			</div>
		</div> -->
		<!-- end:: Subheader -->
		<!-- begin:: Content -->
		<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div class="row">
				<div class="col-md-6">
				<div class="row">
				<div class="col-sm-12 col-md-12 col-xl-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="flaticon-buildings" style="padding-right:5px"></i> Data Sekolah
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<!-- isian -->
							<table width="100%" height="100%">
							<?php foreach($n2 as $baris) {  ?>
							<tr valign="top">
								<td width="11" height="70"></td>
								<td width="211"><label>NPSN/NSS</label><br/></td>
								<td width="20">:</td>
								<td width="380">
								<label><?php echo $baris->npsn_nss;?></label>
								</td>
								<td width="27"></td>
								</tr>
								<tr valign="top">
								<td height="70"></td>
								<td><label>Nama Sekolah</label></td>
								<td>:</td>
								<td><label><?php echo $baris->nama_sekolah;?></label></td>
								<td></td>
							</tr>
							<tr valign="top">
								<td height="60">&nbsp;</td>
								<td valign="top"><label>Provinsi</label></td>
								<td valign="top">:</td>
								<td valign="top"><label><?php echo $baris->nama_provinsi;?></label>
								</td>
								<td></td>
							</tr>
							<tr valign="top">
								<td height="70">&nbsp;</td>
								<td><label>Kabupaten/Kota</label></td>
								<td>:</td>
								<td><label><?php echo $baris->nama_kota_kab; ?></label>
								</td>
								<td></td>
							</tr>
							<tr valign="top">
								<td height="70">&nbsp;</td>
								<td valign="top"><label>Kecamatan</label></td>
								<td valign="top">:</td>
								<td valign="top"><label><?php echo $baris->nama_kec; ?></label>
								</td>
								<td></td>
							</tr>
							<tr valign="top">
								<td height="70">&nbsp;</td>
								<td><label>Kelurahan/Desa</label></td>
								<td>:</td>
								<td><label><?php echo $baris->nama_desa_kel;?></label>
								</td>
								<td></td>
							</tr>
							<tr valign="top">
								<td height="70">&nbsp;</td>
								<td valign="top"><label>No. Telepon/Fax</label></td>
								<td valign="top">:</td>
								<td valign="top"><label><?php echo $baris->telp_fax;?></label>
								</td>
								<td></td>
							</tr>
							<?php } ?>
							</table>
						</div>
					</div>
					</div>
					<div class="col-sm-12 col-md-12 col-xl-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="fa fa-portrait" style="padding-right:5px"></i> Data Kepala Sekolah
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<!-- isian -->
							<table width="100%" height="100%">
							<?php foreach($n4 as $baris) {  ?>
							<tr valign="top">
								<td width="11" height="70"></td>
								<td width="211"><label>NUPTK Kepala Sekolah</label><br/></td>
								<td width="20">:</td>
								<td width="380">
								<label><?php echo $baris->nuptk;?></label>
								</td>
								<td width="27"></td>
								</tr>
								<tr valign="top">
								<td height="70"></td>
								<td><label>NIP Sekolah</label></td>
								<td>:</td>
								<td><label><?php echo $baris->nip;?></label></td>
								<td></td>
							</tr>
							<tr valign="top">
								<td height="70">&nbsp;</td>
								<td><label>Nama Kepala Sekolah</label></td>
								<td>:</td>
								<td><label><?php echo $baris->nama_guru; ?></label>
								</td>
								<td></td>
							</tr>	
							<?php foreach($n3 as $baris2) {  
							if ($baris->nama_guru == $baris2->nama_guru) {?>
							<tr valign="top">
							<td height="70" colspan=5><label style="color: #0000ff !important;">Anda merupakan kepala sekolah Sekolah ini</label></td>
							</tr>
							<?php }?>	
							<?php }?>					
							<?php } ?>
							</table>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-xl-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="fa fa-users-cog" style="padding-right:5px"></i> Data Assesor
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<!-- isian -->
							<table width="100%" height="100%">
							<tr valign="top">
								<td width="11" height="70"></td>
								<td width="211"><label>NUPTK Assesor</label><br/></td>
								<td width="20">:</td>
								<td width="380">
								<label>
								<?php if (!empty($n5)) { foreach($n5 as $barisku) {
                                    echo $barisku->nuptk_assesor;}
                                	} else { 
									echo '<span class="kt-badge kt-badge--inline kt-badge--danger"><i class="flaticon2-delete"></i>Anda belum memiliki assesor</span>'; } ?>
								</label>
								</td>
								<td width="27"></td>
								</tr>
								<tr valign="top">
								<td height="70"></td>
								<td><label>Nama Assesor</label></td>
								<td>:</td>
								<td><label><?php if (!empty($n5)) {
                                    foreach ($n5 as $barisku) {
                                        echo $barisku->nama_guru;
                                    }
                                } else { 
									echo '<span class="kt-badge kt-badge--inline kt-badge--danger">-</span>'; } ?></label></td>
								<td></td>
							</tr>						
							</table>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-xl-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="fa fa-book" style="padding-right:5px"></i> Data Guru Mengajar
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<!-- isian -->
							<table width="100%" height="100%">
							<tr valign="top">
								<td width="11" height="70"></td>
								<td width="211"><label>Mengajar</label><br/></td>
								<td width="20">:</td>
								<td width="380">
								<label>
								<?php if (!empty($n6)) {foreach($n6 as $barisku2) {
									if ($barisku2->jenis_guru == ""){
										echo '<span class="kt-badge kt-badge--inline kt-badge--danger badgeku"><i class="flaticon2-delete"></i>Anda tidak mengajar mata pelajaran / mengampu guru kelas</span>';
									} else {
                                    	echo $barisku2->jenis_guru;}}
                                	} else { 
										echo '<span class="kt-badge kt-badge--inline kt-badge--danger badgeku"><i class="flaticon2-delete"></i>Anda tidak mengajar mata pelajaran / mengampu guru kelas</span>'; } ?>
								</label>
								</td>
								<td width="27"></td>
								</tr>
								<tr valign="top">
								<td height="70"></td>
								<td><label>Keterangan</label></td>
								<td>:</td>
								<td><label><?php if (!empty($n6)) {
                                    foreach ($n6 as $barisku2) {
										if ($barisku2->detail_guru == "")  {
											echo '<span class="kt-badge kt-badge--inline kt-badge--danger">-</span>';
										} else {
                                            echo $barisku2->detail_guru;
                                        }
                                    }
                                } else { 
									echo '<span class="kt-badge kt-badge--inline kt-badge--danger">-</span>'; } ?></label></td>
								<td></td>
							</tr>						
							</table>
						</div>
						</div>
					</div>
					</div>
					</div>
				<div class="col-md-6">
				<div class="row">
				<div class="col-sm-12 col-md-12 col-xl-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="flaticon2-user" style="padding-right:5px"></i> Data Pribadi
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body data_pribadi">						
							<!-- isian -->
							<form action="" method="post" id="form_edit_data" class="form_edit_data" enctype="multipart/form-data" >
							<table width="100%" border="0" height="100%" id="tabel_editdata">
							<tbody>
							<?php foreach($n3 as $baris) {  ?>
							<tr valign="top">
								<td width="6" height="60"></td>
								<td width="175"><label>NUPTK</label></td>
								<td width="16">:</td>
								<td width="378"><div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="nuptk" readonly type="text" required class="form-control" id="nuptk" placeholder="Silahkan masukkan NUPTK" value="<?php echo $baris->nuptk;?>" />
								</div></div></td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td><label>NIP</label></td>
								<td>:</td>
								<td><div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="nip" type="text" readonly required class="form-control"  id="nip"  placeholder="Silahkan masukkan NIP" value="<?php echo $baris->nip;?>" /></div></div>
								</td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td><label>Nama</label></td>
								<td>:</td>
								<td><div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="nama_guru" type="text" autofocus required class="form-control"  id="nama_guru"  placeholder="Silahkan masukkan nama Guru" value="<?php echo $baris->nama_guru;?>" /></div></div></td>
								<td width="8" valign="top">&nbsp;</td>
							</tr>
							
							<tr valign="top">
								<td height="60"></td>
								<td>
								<label>Karpeg</label></td>
								<td>:</td>
								<td><div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="karpeg" type="text" required class="form-control"  id="karpeg"  placeholder="Silahkan masukkan Karpeg" value="<?php echo $baris->karpeg;?>" /></div></div>
								</td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td><label>Tempat Lahir</label></td>
								<td>:</td>
								<td><div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="tempat_lahir" type="text" required class="form-control"  id="tempat_lahir"  placeholder="Silahkan masukkan tempat lahir" value="<?php echo $baris->tempat_lahir;?>" /></div></div>
								</td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td>
								<label>Tanggal Lahir</label><br/><small>Format (YYYY-MM-DD)</small></td>
								<td>:</td>
								<td><div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input class="form-control input date-picker" name="edittgl_lahir" type="text"  size = "40"  data-date-format="yyyy-mm-dd" id="edittgl_lahir" required placeholder="Silahkan masukkan tanggal Lahir" value="<?php echo $baris->tgl_lahir;?>"  />
								</div></div>
								</td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td><label>Pangkat / Jabatan / Gol.Ruang </label></td>
								<td>:</td>
								<td>
									<div class="form-group row">
									<div class="kt-input-icon kt-input-icon--left">
									<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
									<select name="pangkat_jabatan" data-rel='chosen'  class="form-control" required id="pangkat_jabatan" >
									<option value="">Pilih Golongan</option>
									<optgroup label="Golongan I">
									<option value="Juru Muda / I A" <?php if ($baris->pangkat_jabatan=="Juru Muda / I A") { echo "selected=selected";}?>>Juru Muda / I A</option>
									<option value="Juru Muda Tk.I / I B" <?php if ($baris->pangkat_jabatan=="Juru Muda Tk.I / I B") { echo "selected=selected";}?>>Juru Muda Tk.I / I B</option>
									<option value="Juru / I C" <?php if ($baris->pangkat_jabatan=="Juru / I C") { echo "selected=selected";}?>>Juru / I C</option>
									<option value="Juru Tk. I / I D" <?php if ($baris->pangkat_jabatan=="Juru Tk. I / I D") { echo "selected=selected";}?>>Juru Tk. I / I D</option>
									</optgroup>
									<optgroup label="Golongan II">
									<option value="Pengatur Muda / II A" <?php if ($baris->pangkat_jabatan=="Pengatur Muda / II A") { echo "selected=selected";}?>>Pengatur Muda / II A</option>
									<option value="Pengatur Muda Tk. I / II B" <?php if ($baris->pangkat_jabatan=="Pengatur Muda Tk. I / II B") { echo "selected=selected";}?>>Pengatur Muda Tk. I / II B</option>
									<option value="Pengatur / II C" <?php if ($baris->pangkat_jabatan=="Pengatur / II C") { echo "selected=selected";}?>>Pengatur / II C</option>
									<option value="Pengatur Tk. I / II D" <?php if ($baris->pangkat_jabatan=="Pengatur Tk. I / II D") { echo "selected=selected";}?>>Pengatur Tk. I / II D</option>
									</optgroup>
									<optgroup label="Golongan III">
									<option value="Penata Muda / Guru Pertama / III A" <?php if ($baris->pangkat_jabatan=="Penata Muda / Guru Pertama / III A") { echo "selected=selected";}?>>Penata Muda / Guru Pertama / III A</option>
									<option value="Penata Muda Tk.I / Guru Pertama / III B" <?php if ($baris->pangkat_jabatan=="Penata Muda Tk.I / Guru Pertama / III B") { echo "selected=selected";}?>>Penata Muda Tk.I / Guru Pertama / III B</option>
									<option value="Penata / Guru Muda / III C" <?php if ($baris->pangkat_jabatan=="Penata / Guru Muda / III C") { echo "selected=selected";}?>>Penata Muda Tk.I / Guru>Penata / Guru Muda / III C</option>
									<option value="Penata Tk. I / Guru Muda / III D" <?php if ($baris->pangkat_jabatan=="Penata Tk. I / Guru Muda / III D") { echo "selected=selected";}?>>Penata Tk. I / Guru Muda / III D</option>
									</optgroup>
									<optgroup label="Golongan IV">
									<option value="Pembina / Guru Madya / IV A" <?php if ($baris->pangkat_jabatan=="Pembina / Guru Madya / IV A") { echo "selected=selected";}?>>Pembina / Guru Madya / IV A</option>
									<option value="Pembina Tk. I / Guru Madya / IV B" <?php if ($baris->pangkat_jabatan=="Pembina Tk. I / Guru Madya / IV B") { echo "selected=selected";}?>>Pembina Tk. I / Guru Madya / IV B</option>
									<option value="Pembina Utama Muda / Guru Madya / IV C" <?php if ($baris->pangkat_jabatan=="Pembina Utama Muda / Guru Madya / IV C") { echo "selected=selected";}?>>Pembina Utama Muda / Guru Madya / IV C</option>
									<option value="Pembina Utama Madya / Guru Utama / IV D" <?php if ($baris->pangkat_jabatan=="Pembina Utama Madya / Guru Utama / IV D") { echo "selected=selected";}?>>Pembina Utama Madya / Guru Utama / IV D</option>
									<option value="Pembina Utama / Guru Utama / IV E" <?php if ($baris->pangkat_jabatan=="Pembina Utama / Guru Utama / IV E") { echo "selected=selected";}?>>Pembina Utama / Guru Utama / IV E</option>
									</optgroup>
								</select>
								</div></div></td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td><label>Terhitung Mulai Tanggal (TMT)</label><br><small>Format (YYYY-MM-DD)</small></td>
								<td>:</td>
								<td>
								<div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input class="form-control input date-picker2" name="edittmt_guru" type="text"  size = "40"  data-date-format="yyyy-mm-dd" id="edittmt_guru" required placeholder="Silahkan masukkan TMT Guru" value="<?php echo $baris->tmt_guru;?>"/>
								</div></div></td>
							</tr>
							<tr valign="top">
								<td height="60"></td>
								<td><label>Jenis Kelamin</label></td>
								<td>:</td>
								<td>
								<div class="form-group row">
								<div class="kt-radio-list">    
								<label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki" class="jenis_kelamin" required <?php if($baris->jenis_kelamin =="Laki-laki") {echo "checked=''";} ?>>Laki-laki<span></span></label>
								<label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan" class="jenis_kelamin" required <?php if($baris->jenis_kelamin =="Perempuan") {echo "checked=''";} ?>>Perempuan<span></span></label>
								<span for="jenis_kelamin" class="help-block"><b></b>
								</span>
								</div>
								</div>
								</td>
							</tr>
							<tr valign="top">
								<td height="60">&nbsp;</td>
								<td>
								<label>Pendidikan Terakhir</label></td>
								<td>:</td>
								<td>
								<div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="pendidikan_terakhir" type="text" required class="form-control" id="pendidikan_terakhir"  placeholder="Silahkan masukkan pendidikan terakhir" value="<?php echo $baris->pendidikan_terakhir;?>"/></div></div>
								</td>
							</tr>
							<tr valign="top">
							<td height="60"></td>
								<td><label>Program Keahlian</label></td>
								<td>:</td>
								<td>
								<div class="form-group row">
								<div class="kt-input-icon kt-input-icon--left">
								<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
								<input name="program_keahlian" type="text" required class="form-control" id="program_keahlian" placeholder="Silahkan masukkan program keahlian" value="<?php echo $baris->program_keahlian;?>"/></div></div>
								</td>
							</tr>
							<tr valign="top" align="center">
							<td height="60" colspan=5>
							<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="edit_data"><i class="fa fa-pencil-alt"></i> Edit Data</button>
							</td>
							</tr>
							</tbody>
							<?php } ?>
							</table>
							</form>
						</div>
					</div>
					</div>
					<div class="col-sm-12 col-md-12 col-xl-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="flaticon-lock" style="padding-right:5px"></i> Update Password Login Sistem
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
					<form action="" method="post" id="form_ganti_password" class="form_ganti_password" enctype="multipart/form-data" >
					<table width="100%" border="0" height="100%" id="tabel_editdata">
					<tbody>
					<tr valign="top">
						<td width="6" height="60"></td>
						<td width="175"><label>Password Login Sistem</label></td>
						<td width="16">:</td>
						<td width="378">
						<div class="form-group row">
						<div class="kt-input-icon kt-input-icon--left">
						<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
						<input name="editpassword" type="password" autofocus required class="form-control"  id="editpassword"  placeholder="Silahkan mengganti password untuk login sistem" /></div></div>
						</td>
					</tr>
					<tr valign="top" align="center">
					<td height="60" colspan="5">
					<button type="button" class="btn btn-dark btn-elevate2 btn-elevate-air2" id="ganti_password"><i class="fa fa-lock"></i> Ganti Password</button>
					</td>
					</tr>
					</tbody>
					</table>
					</form>
					</div>
					</div>
					</div>
					</div>
					</div>			
			</div>
		</div>
	</div>
</div>
<!-- end:: Content -->
</div>
<?php $this->load->view("footer.php"); ?>
<script>
$(function() {
	$(document).on('click', "button#edit_data", function(){
		$('#form_edit_data').validate({
		errorElement: 'span',
	    errorClass: 'help-block',
	    focusInvalid: false,
		 	    highlight: function (element) {
	            $(element)
	                .closest('.form-group').addClass('has-error');
	            },
	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            }
		}
		);
		if ($('form.form_edit_data').valid()) {
				var databaru = new FormData($('#form_edit_data')[0]); 
		  		$.ajax({
				xhr: function() {
        		var browser = navigator.appName;
				if(browser == "Microsoft Internet Explorer"){
				var xhr = new window.ActiveXObject("Microsoft.XMLHTTP");
				}else{
        		var xhr = new window.XMLHttpRequest();
				}
        		xhr.upload.addEventListener("progress", function(evt) {
           		 if (evt.lengthComputable) {
               		var percentComplete = (evt.loaded / evt.total) * 100; 
					blockPageUI(); 
           		 }
       			}, false);
       			xhr.addEventListener("progress", function(evt) {
           			if (evt.lengthComputable) {
               		var percentComplete = (evt.loaded / evt.total) *100;
					blockPageUI();
           			}
      			 }, false);
			 return xhr;
   			 },
			async:true,
    		type: "POST",
			cache: false,
            contentType: false,
            processData: false,
			url: "<?php echo base_url().FOLDER_SD_USER;?>pribadi/aksieditguru",
			data: databaru,
				beforeSend: function(){
				},
        		success: function(data){
			   if (data != "") {
				toastr.options = {
  				"closeButton": true,
 				 "debug": false,
 				 "positionClass": "toast-top-center",
 				 "onclick": null,
 			 	"showDuration": "1000",
  				"hideDuration": "1000",
			    "timeOut": "3000",
		 	    "extendedTimeOut": "1000",
  				"showEasing": "swing",
 				 "hideEasing": "linear",
 				 "showEasing" : 'swing',
 				 "hideEasing" : 'linear',
 				 "showMethod": "slideDown",
				"hideMethod": "slideUp"
				}
				  if(data == "session_expired"){
                    toastr.error("<br/><b>Sesi sudah berakhir.<br/>Silahkan login kembali</b>", "Kesalahan");
                    setTimeout(function() {window.location.href = "<?php echo base_url();?>login"}, 3000);
                 } else {
                    toastr.error(data, "Kesalahan");
				 }
				 unblockPageUI();
			   }
				 else {
					berhasiledit();
					unblockPageUI();
					$("#div.kt-portlet__body.data_pribadi").load("#div.kt-portlet__body.data_pribadi");
				 }
 		        },
				complete: function(){
					unblockPageUI();
				},
			   error: function(){ 
   				gagaledit();
				}				
      			});
		} else {
			kurangisian();
		}
	});
});
$(function() {
	$(document).on('click', "button#ganti_password", function(){
		$('#form_ganti_password').validate({
		errorElement: 'span',
	    errorClass: 'help-block',
	    focusInvalid: false,
		 	    highlight: function (element) {
	            $(element)
	                .closest('.form-group').addClass('has-error');
	            },
	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            }
		}
		);
		if ($('form.form_ganti_password').valid()) {
				var databaru = new FormData($('#form_ganti_password')[0]); 
		  		$.ajax({
				xhr: function() {
        		var browser = navigator.appName;
				if(browser == "Microsoft Internet Explorer"){
				var xhr = new window.ActiveXObject("Microsoft.XMLHTTP");
				}else{
        		var xhr = new window.XMLHttpRequest();
				}
        		xhr.upload.addEventListener("progress", function(evt) {
           		 if (evt.lengthComputable) {
               		var percentComplete = (evt.loaded / evt.total) * 100; 
					blockPageUI(); 
           		 }
       			}, false);
       			xhr.addEventListener("progress", function(evt) {
           			if (evt.lengthComputable) {
               		var percentComplete = (evt.loaded / evt.total) *100;
					blockPageUI();
           			}
      			 }, false);
			 return xhr;
   			 },
			async:true,
    		type: "POST",
			cache: false,
            contentType: false,
            processData: false,
			url: "<?php echo base_url().FOLDER_SD_USER;?>pribadi/aksigantipasswordguru",
			data: databaru,
				beforeSend: function(){
				},
        		success: function(data){
			   if (data != "") {
				toastr.options = {
  				"closeButton": true,
 				 "debug": false,
 				 "positionClass": "toast-top-center",
 				 "onclick": null,
 			 	"showDuration": "1000",
  				"hideDuration": "1000",
			    "timeOut": "3000",
		 	    "extendedTimeOut": "1000",
  				"showEasing": "swing",
 				 "hideEasing": "linear",
 				 "showEasing" : 'swing',
 				 "hideEasing" : 'linear',
 				 "showMethod": "slideDown",
				"hideMethod": "slideUp"
				}
				  if(data == "session_expired"){
                    toastr.error("<br/><b>Sesi sudah berakhir.<br/>Silahkan login kembali</b>", "Kesalahan");
                    setTimeout(function() {window.location.href = "<?php echo base_url();?>login"}, 3000);
                 } else {
                    toastr.error(data, "Kesalahan");
				 }
				 unblockPageUI();
			   }
				 else {
					berhasilgantipassword();
					unblockPageUI();
					$('#editpassword').val("");
				 }
 		        },
				complete: function(){
					unblockPageUI();
				},
			   error: function(){ 
   				gagaledit();
				}				
      			});
		} else {
			kurangisian();
		}
	});
});
</script>
