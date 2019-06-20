<?php 
$this->load->view("header.php" ); 
$this->load->view(FOLDER_SMP_USER.'date.php');
$this->load->view(FOLDER_SMP_USER.'panel_user.php');
?>
<style type="text/css">
div.dataTables_wrapper div.dataTables_filter input {
	 /* width:150px; */
	 display:-moz-inline-stack;
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
    word-wrap: break-word;
	/* word-break: break-all;  /* break by word */
	word-break: break-word; /* break by sentence */
	/* white-space: nowrap; */
}
table.dataTable.dtr-inline.collapsed > tbody > tr > td.details-control:first-child:before {
  display: none;
}
.kt-badge.kt-badge--danger {
	font-size : 13px !important;
}
.kt-badge.kt-badge--success {
	font-size : 13px !important;
}
[class^="flaticon2-"]:before, [class*=" flaticon2-"]:before {
	padding-right:10px !important;
}
.btnku {
	text-align : left !important;
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
				<div class="col-sm-12">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--tab">
						<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title" style="font-weight:800 !important">
						<i class="fa fa-file-pdf" style="padding-right:5px"></i>Cetak Penilaian Kinerja
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
						<div class="form-group">
							<?php 
							$nuptk = $this->session->userdata("username");
							$queryku = $this->db->get_where(D_GURU_SMP.$this->session->userdata('tahun'), array('nuptk_guru_smp' => $nuptk));
							$rowku = $queryku->row_array();
							$jenis_guru = $rowku['jenis_guru'];
							$detail_guru = $rowku['detail_guru'];
							$sIndexColumn = "b.id_kompetensi";
							$sTable = "`".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".M_INDIKATOR_SMP."` as a ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET('".$detail_guru."',c.hub_detail_guru) where nuptk_guru_smp='".$nuptk."'".$sWhere." group by id_kompetensi";
							//$sTable = "`".M_KOMPETENSI_SMP."` as b left join `".M_KELOMPOK_KOMPETENSI_SMP."` as c ON b.id_kelompok_kompetensi_smp=c.id_kelompok left join `".M_INDIKATOR_SMP."` as a ON a.id_kompetensi_indikator_smp=b.id_kompetensi and a.keaktifan_indikator='Aktif' and b.keaktifan='Aktif' left join `".D_GURU_SMP.$this->session->userdata("tahun")."` as d ON c.hub_jenis_guru=d.jenis_guru and FIND_IN_SET(".$detail_guru.",c.hub_detail_guru) where nuptk_guru_smp='".$nuptk."'".$sWhere." group by id_kompetensi having count(id_indikator)= (select count(skor) from `".D_PENILAIAN_SMP.$this->session->userdata("tahun")."` where nuptk_penilaian_smp='".$nuptk."')";
							$sQuery = "SELECT COUNT(DISTINCT(".$sIndexColumn.")) as 'Count' FROM  $sTable";
							$rResultTotal = $this->db->query($sQuery);
							$aResultTotal = $rResultTotal->row()->Count;
							if ($aResultTotal > 0 ) { 
							?>
							<?php foreach ($n20 as $baris20) { if (strtolower($baris20->jenis_guru) == "guru bimbingan konseling") { ?>
							<b>*) Harap untuk mengisi setiap indikator, kompetensi dan kuisioner serta status sudah selesai dinilai oleh assesor<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pada menu "Penilaian Kinerja" dan "Penilaian Kuisioner" sebelum cetak lampiran 2C dan 2D</b><br/><br/>
							<a class="btn btn-warning btn-elevate btn-icon-sm btn-elevate2 btn-elevate-air2"
								href="<?php echo base_url().FOLDER_SMP_USER."cetakkinerja/lampiransatub";?>"
								data-target="#" id="sample_tambah_data">
								<i class="fa fa-file-pdf"></i>Cetak PDF Lampiran 2B</a>
							<a class="btn btn-dark btn-elevate btn-icon-sm btn-elevate2 btn-elevate-air2"
								href="<?php echo base_url().FOLDER_SMP_USER."cetakkinerja/lampiransatuc";?>"
								data-target="#" id="sample_tambah_data">
								<i class="fa fa-file-pdf"></i>Cetak PDF Lampiran 2C</a>
							<a class="btn btn-info btn-elevate btn-icon-sm btn-elevate2 btn-elevate-air2"
								href="<?php echo base_url().FOLDER_SMP_USER."cetakkinerja/lampiransatud";?>"
								data-target="#" id="sample_tambah_data">
								<i class="fa fa-file-pdf"></i>Cetak PDF Lampiran 2D</a>
							<?php } else { ?>
							<b>*) Harap untuk mengisi setiap indikator, kompetensi dan kuisioner serta status sudah selesai dinilai oleh assesor<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pada menu "Penilaian Kinerja" dan "Penilaian Kuisioner" sebelum cetak lampiran 1C dan 1D</b><br/><br/>
							<a class="btn btn-warning btn-elevate btn-icon-sm btn-elevate2 btn-elevate-air2"
								href="<?php echo base_url().FOLDER_SMP_USER."cetakkinerja/lampiransatub";?>"
								data-target="#" id="sample_tambah_data">
								<i class="fa fa-file-pdf"></i>Cetak PDF Lampiran 1B</a>
							<a class="btn btn-dark btn-elevate btn-icon-sm btn-elevate2 btn-elevate-air2"
								href="<?php echo base_url().FOLDER_SMP_USER."cetakkinerja/lampiransatuc";?>"
								data-target="#" id="sample_tambah_data">
								<i class="fa fa-file-pdf"></i>Cetak PDF Lampiran 1C</a>
							<a class="btn btn-info btn-elevate btn-icon-sm btn-elevate2 btn-elevate-air2"
								href="<?php echo base_url().FOLDER_SMP_USER."cetakkinerja/lampiransatud";?>"
								data-target="#" id="sample_tambah_data">
								<i class="fa fa-file-pdf"></i>Cetak PDF Lampiran 1D</a>
							<?php }} ?>
							<?php  } ?>	
							</div>
							<div class="alert alert-warning data_cetak_kinerja" style="display:none"></div>
							<table class="table table-striped table-bordered table-hover data_cetak_kinerja dataTables" id="data_cetak_kinerja" width=100%>
								<thead>
									<tr>
										<th></th>
										<th>Tindakan</th>	
										<th>Kelompok Kompetensi</th>	
										<th>Nama Kompetensi</th>									
										<th>Status Penilaian Assesor</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<style type="text/css">
						#upload_file .modal-dialog {
							width: 75%;
							height: 100%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							padding-top:10px;
						}
						#upload_file .modal-body {
							max-height: 600px;
							/* Firefox */
							max-height: -moz-calc(100vh - 170px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 170px);
							/* Opera */
							max-height: -o-calc(100vh - 170px);
							/* Standard */
							max-height: calc(100vh - 170px);
							/* IE-OLD */
							max-height: expression(100vh - 170px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#upload_file .portlet-body {
							min-width: 750px;
						}

						#upload_file .modal-footer {
							border-bottom: 1px solid #e5e5e5;
						}
						
						#upload_file2 .modal-dialog {
							width: 80%;
							height: 100%;							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							padding-top:10px;
						}
						#upload_file2 .modal-body {
							max-height: 600px;
							/* Firefox */
							max-height: -moz-calc(100vh - 170px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 170px);
							/* Opera */
							max-height: -o-calc(100vh - 170px);
							/* Standard */
							max-height: calc(100vh - 170px);
							/* IE-OLD */
							max-height: expression(100vh - 170px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#upload_file2 .portlet-body {
							min-width: 750px;
						}

						#upload_file2 .modal-footer {
							border-bottom: 1px solid #e5e5e5;
						}

						#edit_data .modal-dialog {
							width: 60%;
							height: 90%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							padding-top: 10px;
						}

						#edit_data .modal-body {
							max-height: 600px;
							/* Firefox */
							max-height: -moz-calc(100vh - 170px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 170px);
							/* Opera */
							max-height: -o-calc(100vh - 170px);
							/* Standard */
							max-height: calc(100vh - 170px);
							/* IE-OLD */
							max-height: expression(100vh - 170px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#edit_data .portlet-body {
							min-width: 750px;
						}

						#edit_data .modal-footer {
							border-bottom: 1px solid #e5e5e5;
						}

						#hapus_data .modal-dialog {
							width: 80%;
							height: 50%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#hapus_data .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#hapus_datakepala .portlet-body {
							min-width: 400px;
						}

						#hapus_datakepala .modal-dialog {
							width: 70%;
							height: 50%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#hapus_datakepala .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#hapus_datakepala .portlet-body {
							min-width: 400px;
						}

						#tampilkan_foto2 .modal-dialog {
							width: 75%;
							height: 75%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#tampilkan_foto2 .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#tampilkan_foto2 .portlet-body {
							min-width: 850px;
						}

						#aktifkan_data .modal-dialog {
							width: 65%;
							height: 50%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#aktifkan_data .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#aktifkan_data .portlet-body {
							min-width: 850px;
						}

						#nonaktifkan_data .modal-dialog {
							width: 65%;
							height: 50%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#nonaktifkan_data .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#nonaktifkan_data .portlet-body {
							min-width: 850px;
						}

						#eksportdata .modal-dialog {
							width: 65%;
							height: 50%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#eksportdata .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#eksportdata .portlet-body {
							min-width: 850px;
						}

						#cetakpdfdata .modal-dialog {
							width: 100%;
							height: 95%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#cetakpdfdata .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 120px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 120px);
							/* Opera */
							max-height: -o-calc(100vh - 120px);
							/* Standard */
							max-height: calc(100vh - 120px);
							/* IE-OLD */
							max-height: expression(100vh - 120px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#cetakpdfdata .portlet-body {
							min-width: 850px;
						}
						#lihat_pdf .modal-header {
						padding: 0.25rem !important;
						}
						#lihat_pdf .modal-dialog {
							width: 90%;
							height: 100%;							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
						}

						#lihat_pdf .modal-body {
							max-height: 520px;
							/* Firefox */
							max-height: -moz-calc(100vh - 90px);
							/* WebKit */
							max-height: -webkit-calc(100vh - 90px);
							/* Opera */
							max-height: -o-calc(100vh - 90px);
							/* Standard */
							max-height: calc(100vh - 90px);
							/* IE-OLD */
							max-height: expression(100vh - 90px);
							overflow-y: auto;
							overflow-x: auto;
						}

						#lihat_pdf .portlet-body {
							min-width: 850px;
						}
						#lihat_pdf .modal-footer {
							border-bottom: 1px solid #e5e5e5;
							padding: 0rem !important;
						}
					</style>
					<div class="modal fade" id="lihat_pdf" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="upload_file" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- End modal -->
					<div class="modal fade" id="upload_file2" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- End modal -->
					<div class="modal fade" id="edit_data" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="hapus_data" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="hapus_datakepala" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="aktifkan_data" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="nonaktifkan_data" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="tampilkan_foto2" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="kepala_sekolah" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="eksportdata" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<div class="modal fade" id="cetakpdfdata" role="dialog" aria-hidden="true" data-backdrop="static"
						data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								</div>
								<div class="modal-body form">
								</div>
								<div class="modal-footer">
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
