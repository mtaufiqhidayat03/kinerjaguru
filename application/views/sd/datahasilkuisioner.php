<?php 
$this->load->view("header.php" ); 
$this->load->view(FOLDER_SD.'date.php');
$this->load->view(FOLDER_SD.'panel_user.php');
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
						<i class="fa fa-th-list" style="padding-right:5px"></i> Penilaian Hasil Kuisioner
						</h3>
						</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="alert alert-warning data_kuisioner" style="display:none"></div>
							<table class="table table-striped table-bordered table-hover data_hasilkuisioner dataTables" id="data_hasilkuisioner" width=100%>
								<thead>
									<tr>
										<th></th>
										<th>Tindakan</th>
										<th>NUPTK</th>
										<th>Nama Guru</th>
										<th>Nama Kuisioner</th>
										<th>Nilai Kuisioner</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<style type="text/css">
						#edit_data .modal-dialog {
							width: 80%;
							height: 100%;					
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

						#edit_datanilai .modal-dialog {
							width: 80%;
							height: 80%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							padding-top: 10px;
						}

						#edit_datanilai .modal-body {
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

						#edit_datanilai .portlet-body {
							min-width: 750px;
						}

						#edit_datanilai .modal-footer {
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
						#kepala_sekolah .modal-dialog {
							width: 60%;
							height: 100%;
							
							margin: auto;
							position: absolute;
							top: 0;
							left: 0;
							bottom: 0;
							right: 0;
							padding-top:10px;
						}
						#kepala_sekolah .modal-body {
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

						#kepala_sekolah .portlet-body {
							min-width: 750px;
						}

						#kepala_sekolah .modal-footer {
							border-bottom: 1px solid #e5e5e5;
						}

					</style>
					<div class="modal fade" id="tambah_data2" tabindex="-1" role="dialog" style="display: none;"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
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
					<div class="modal fade" id="tambah_data" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
					<div class="modal fade" id="edit_datanilai" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
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
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end:: Content -->
</div>
<?php $this->load->view("footer.php"); ?>
