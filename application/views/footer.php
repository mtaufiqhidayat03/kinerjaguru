<?php
include 'bootstrap.php';
$result = new WhichBrowser\ Parser( getallheaders() );
?>
<?php
function get_client_ip() {
    $ipaddress = '';
    if ( getenv( 'HTTP_CLIENT_IP' ) )
        $ipaddress = getenv( 'HTTP_CLIENT_IP' );
    else if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
        $ipaddress = getenv( 'HTTP_X_FORWARDED_FOR' );
    else if ( getenv( 'HTTP_X_FORWARDED' ) )
        $ipaddress = getenv( 'HTTP_X_FORWARDED' );
    else if ( getenv( 'HTTP_FORWARDED_FOR' ) )
        $ipaddress = getenv( 'HTTP_FORWARDED_FOR' );
    else if ( getenv( 'HTTP_FORWARDED' ) )
        $ipaddress = getenv( 'HTTP_FORWARDED' );
    else if ( getenv( 'REMOTE_ADDR' ) )
        $ipaddress = getenv( 'REMOTE_ADDR' );
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}
?>
<div class="modal fade" id="mdl_logout" role="dialog" aria-hidden="true">
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
<style type="text/css">
	#mdl_logout .modal-dialog {
		width: 50%;
		height: 50%;
		overflow: auto;
		margin: auto;
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}
	#mdl_logout .modal-content {
		max-height: 520px;
		 /* 100% = dialog height, 120px = header + footer */
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

	#mdl_logout .portlet-body {
		min-width: 400px;
	}
.blockUI.blockOverlay, .blockUI.blockMsg.blockPage {
	 z-index:2000 !important;
}
</style>
<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
	<div class="kt-footer__copyright">
		2019&nbsp;&copy;&nbsp;<b>Dinas Pendidikan Kota Surakarta</b>
	</div>
	<div class="kt-footer__menu">
		<?php if ( get_client_ip() == "::1" ) {  
		 echo "Alamat IP : <b>127.0.0.1</b>"; 
		} 
		else {
    		 echo "Alamat IP : <b>".get_client_ip()."</b>";
		} ?>
<?php echo " diakses dengan browser  <b>".$result->browser->name. ' ' . $result->browser->version->value.' '.$result->os->toString()."</b>";?>
	</div>
</div>
<!-- end:: Footer -->
</div>
</div>
</div>
<!-- end:: Page -->
<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
	<i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
	var KTAppOptions = {
		"colors": {
			"state": {
				"brand": "#5d78ff",
				"dark": "#282a3c",
				"light": "#ffffff",
				"primary": "#5867dd",
				"success": "#34bfa3",
				"info": "#36a3f7",
				"warning": "#ffb822",
				"danger": "#fd3995"
			},
			"base": {
				"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
				"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
			}
		}
	};
</script>
<!-- <script src="<?php //echo base_url();?>min/g=js" type="text/javascript"></script> -->
<!-- end::Global Config -->
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url();?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript">
</script>
<script src="<?php echo base_url();?>assets/app/custom/general/crud/forms/widgets/select2.js" type="text/javascript">
</script>
<?php if (($this->session->userdata('level') == "Administrator Kota") or ($this->session->userdata('level') == "Administrator Sekolah")) { ?>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/table-managedadmin.js" type="text/javascript"></script>
<?php } else {?>
<?php	if ($this->session->userdata("level")=="Kepsek") { ?>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/table-managedkepsek.js" type="text/javascript"></script>
<?php } else {?>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/table-managedguru.js" type="text/javascript"></script>
<?php }?>
<?php }?>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.id.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/fnDisplayStart.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/fnGetHiddenNodes.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/vendors/custom/datatables/fnStandingRedraw.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<!--begin::Global App Bundle(used by all pages) -->
<script src="<?php echo base_url();?>assets/app/bundle/app.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/vendors/custom/localization/messages_id.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/vendors/base/kumpulan-toastr.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>pdfupload/pdf.js"></script>
<script src="<?php echo base_url();?>pdfupload/pdf.worker.js"></script>
<script src="<?php echo base_url();?>PDFObject/pdfobject.js"></script>
<!--end::Global App Bundle -->
<!-- </body></html> -->
</body>
</html>
<script type="text/javascript">
	var Modal = function (element, options) {
    this.options = options
    this.$element = $(element)
    .delegate('[data-dismiss="modal"]', 'click.dismiss.modal', $.proxy(this.hide, this))
    this.options.remote && this.$element.find('.modal-content').load(this.options.remote, $.proxy(function () {
    this.$element.trigger('loaded.bs.modal')
	}, this)) };
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(".modal-body, .modal-footer").html("");
	});
	$('#mdl_logout').on('show.bs.modal', function(e) {
		blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>	
	$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {	
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			$('#mdl_logout').modal('hide'); 
			unblockPageUI();
		}
		});
	});
$.fn.modal.Constructor.prototype._enforceFocus = function() {};

// DATA SEKOLAH
<?php if ($this->uri->segment(2)=="sekolah") { ?>
	var KTSelectadd = function(){
	return {
	init: function (event) {
		$("#nama_provinsi, #nama_provinsi_validate").select2({
			 language: "id"
		}),
		$("#nama_kota_kab, #nama_kota_kab_validate").select2({
			language: "id"
	   }),
	   $("#nama_kecamatan, #nama_kecamatan_validate").select2({
			language: "id"
   		}),
   		$("#nama_kelurahan, #nama_keluarahan_validate").select2({
			language: "id"
		})
		}
	}
	}();
	var KTSelectedit = function(){
	return {
	init: function (event) {
		$("#editnama_provinsi, #editnama_provinsi_validate").select2({
			 language: "id"
		}),
		$("#editnama_kota_kab, #editnama_kota_kab_validate").select2({
			language: "id"
	   }),
	   $("#editnama_kecamatan, #editnama_kecamatan_validate").select2({
			language: "id"
   		}),
   		$("#editnama_kelurahan, #editnama_keluarahan_validate").select2({
			language: "id"
		})
		}
	}
	}();
$('#tambah_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {			
			unblockPageUI();
			KTSelectadd.init();
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#edit_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {			
			unblockPageUI();
			KTSelectedit.init();
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#hapus_datakepala').on('show.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_datakepala').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#kepala_sekolah').on('shown.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var npsn_nss = $('#npsn_nss').val();
			$(function(){
			$('#editkepala_sekolah').select2({
					allowClear: true,
					language: "id",
					placeholder: 'Masukkan nama / nip yang akan dijadikan kepala sekolah',
					ajax: {
						dataType: 'json',
						url: 'sekolah/ambildatagurusd',
						delay: 500,
						data: function (params) {
						var query = {
							search: params.term || '',
							page: params.page || 1,
							npsn_nss : npsn_nss
							} // Query parameters will be ?search=[term]&page=[page]
						return query;
						},
						cache: true,
						},
			});
			});		
			unblockPageUI();	
		} else {
			koneksierror();
			setTimeout(function(){ $('#kepala_sekolah').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
// DATA GURU
<?php } else if ($this->uri->segment(2)=="guru") { ?>
  var Datepicker = function() {
  var t;
  t = KTUtil.isRTL() ? {
    leftArrow: '<i class="la la-angle-right"></i>',
    rightArrow: '<i class="la la-angle-left"></i>'
  } : {
    leftArrow: '<i class="la la-angle-left"></i>',
    rightArrow: '<i class="la la-angle-right"></i>'
  }; 
  return {
    init: function(event) {
		$("#tgl_lahir").datepicker({
    rtl: KTUtil.isRTL(),
		todayHighlight: !0,
		language:"id",
    orientation: "bottom left",
		autoclose: true,
		showOnFocus:true,		
		format:'yyyy-mm-dd',
		todayBtn : true,
		//startView: 2,
		endDate: new Date(),
		defaultViewDate: new Date(1970,01,01) 
		});
		$("#tmt_guru").datepicker({
    rtl: KTUtil.isRTL(),
		todayHighlight: !0,
		language:"id",
    orientation: "bottom left",
		autoclose: true,
		showOnFocus:true,
		format:'yyyy-mm-dd',
		todayBtn : true,
		endDate: new Date(),
		defaultViewDate: new Date() 
	  });
    }
  }
}(); 
$('#tambah_data').on('show.bs.modal', function(e) {
	if($(".datepicker").datepicker( "widget" ).is(":visible")){
		$("div.datepicker.datepicker-inline").remove(); 
		} else {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>	
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {		
			Datepicker.init();	
			selectPlaceholder('#pangkat_jabatan');	
			unblockPageUI();	
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
		}
});
  var Datepicker2 = function() {
  var t;
  t = KTUtil.isRTL() ? {
    leftArrow: '<i class="la la-angle-right"></i>',
    rightArrow: '<i class="la la-angle-left"></i>'
  } : {
    leftArrow: '<i class="la la-angle-left"></i>',
    rightArrow: '<i class="la la-angle-right"></i>'
  };
  return {
    init: function(event) {
		$("#edittgl_lahir").datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: !0,
		language:"id",
		orientation: "bottom left",
		autoclose: true,
		showOnFocus:true,
		format:'yyyy-mm-dd'
		});
		$("#edittmt_guru").datepicker({
        rtl: KTUtil.isRTL(),
		todayHighlight: !0,
		language:"id",
        orientation: "bottom left",
		autoclose: true,
		showOnFocus:true,
		format:'yyyy-mm-dd'
	  });
    }
  }
}(); 
$('#edit_data').on('show.bs.modal', function(e) {
		if($(".datepicker").datepicker( "widget" ).is(":visible")){
		$("div.datepicker.datepicker-inline").remove(); 
		} else {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>	
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			Datepicker2.init();
			selectPlaceholder('#pangkat_jabatan');
			unblockPageUI();			
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
		}
});
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#hapusguru_sekolah').on('show.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>	
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapusguru_sekolah').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#ganti_password').on('show.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>	
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#ganti_password').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#guru_sekolah').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			$(function(){
       		$('#edit_gurusekolah, #edit_gurusekolah_validate').select2({
         	 	// minimumInputLength: 1,
          	 	allowClear: true,
		   				language: "id",
           		placeholder: 'Pilih sekolah dengan masukkan nama sekolah atau NPSN/NSS',
           		ajax: {
              	dataType: 'json',
             		url: 'Guru/ambildatasekolahsd',
			  		delay: 500,
			  		data: function (params) {
      				var query = {
							search: params.term || '',
        			page: params.page || 1
     				} // Query parameters will be ?search=[term]&page=[page]
				  	return query;
				},
				cache: true,
          		}
      			});
			 });
			 unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#guru_sekolah').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#guru_sekolahmapel').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#guru_sekolahmapel').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#hapusguru_sekolahmapel').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapusguru_sekolahmapel').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
// DATA ASSESOR
<?php } else if ($this->uri->segment(2)=="assesor") { ?>
	$('#tambah_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
			selectPlaceholder("#guru_dinilai");
			$(function(){
			$('#assesor').select2({	
           	allowClear: true,
		   			language: "id",
          	placeholder: 'Pilih salah satu assesor',
           	ajax: {
              dataType: 'json',
              url: 'assesor/ambildataassesor',
			 			delay: 500,
			  		data: function (params) {
      				var query = {
							search: params.term || '',
        			page: params.page || 1
     				} // Query parameters will be ?search=[term]&page=[page]
				  return query;
				},
				cache: true,
          		}
			});	
			});
			$('#assesor').on("select2:select", function(e) { 
			var assesor = $(this).val();
			$(function(){
			$('#guru_dinilai').select2({	
           	allowClear: true,
		   	language: "id",
          	placeholder: 'Pilih salah satu guru yang tersedia',
           	ajax: {
              dataType: 'json',
              url: 'assesor/ambildatagurudinilai',
			  //delay: 500,
			  data: function (params) {
      		var query = {
					search: params.term || '',
					page: params.page || 1,
					assesor: assesor
     			} 
				  return query;
				},
				cache: true,
          		}
			});	
			});
			});
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
// DATA KELOMPOK KOMPETENSI
<?php } else if ($this->uri->segment(2)=="kelompok") { ?>
$('#tambah_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#edit_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>	
		
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#hub_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hub_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
// DATA KOMPETENSI
<?php } else if ($this->uri->segment(2)=="kompetensi") { ?>
$('#tambah_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			selectPlaceholder('#keaktifan');
			$(function(){
			$('#kelompok_kompetensi').select2({	
           	allowClear: true,
		   	language: "id",
          	placeholder: 'Pilih salah satu kelompok kompetensi',
           	ajax: {
              dataType: 'json',
              url: 'kompetensi/ambildatakelompokkompetensi',
			  //delay: 500,
			  data: function (params) {
      				var query = {
					search: params.term || '',
        			page: params.page || 1
     				} // Query parameters will be ?search=[term]&page=[page]
				  return query;
				},
				cache: true,
          		}
			});	
			});
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#edit_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>	
		
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var initial = $('#editkelompok_kompetensi2').val();
			$(function(){
			var $select = $('#editkelompok_kompetensi').select2();
			var $option = $("<option selected='selected'></option>");
			$.ajax({ 
  				type: 'GET',
  				url: 'kompetensi/ambildatakelompokkompetensi2?id_kelompok='+initial ,
  				dataType: 'json',
  			}).then(function (data) {
			$option.text(data[0].text);
  			$option.val(data[0].id); // update the text that is displayed (and maybe even the value)
			$option.removeData(); // remove any caching data that might be associated
			$select.append($option).trigger('change'); // notify JavaScript components of possible changes
			unblockPageUI();
			});
			});	
			$(function(){
        	$('#editkelompok_kompetensi, #editkelompok_kompetensi_validate').select2({
           		allowClear: true,
		   		language: "id",
           		placeholder: 'Pilih salah satu kelompok kompetensi',
           		ajax: {
              		dataType: 'json',
              		url: 'kompetensi/ambildatakelompokkompetensi',
			  		delay: 500,
			  		data: function (params) {
      				var query = {
					search: params.term || '',
        			page: params.page || 1
     				} // Query parameters will be ?search=[term]&page=[page]
				  	return query;
				},
				cache: true,
         	}
      		});
 		}); 		
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>	
		
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
// DATA INDIKATOR
<?php } else if ($this->uri->segment(2)=="indikator") { ?>
$('#tambah_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			selectPlaceholder('#id_kompetensi_indikator_sd');
			selectPlaceholder('#keaktifan_indikator');
			$(function(){
       		$('#kelompok_kompetensi, #kelompok_kompetensi_validate').select2({
          // minimumInputLength: 1,
           allowClear: true,
		   language: "id",
           placeholder: 'Pilih salah satu kelompok kompetensi',
           ajax: {
              dataType: 'json',
              url: 'kompetensi/ambildatakelompokkompetensi',
			  delay: 500,
			  data: function (params) {
      				var query = {
					search: params.term || '',
        			page: params.page || 1
     				} // Query parameters will be ?search=[term]&page=[page]
				  return query;
				},
				cache: true,
          }
      		});
		 });	
		 unblockPageUI();	
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#edit_data').on('shown.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var $select = $('#editkelompok_kompetensi, #editkelompok_kompetensi_validate').select2();
			var initial = $('#editkelompok_kompetensi2').val();
			var $option = $("<option selected='selected'></option>");
			$.ajax({ 
			type: 'GET',
			url: 'kompetensi/ambildatakelompokkompetensi2?id_kelompok=' +initial ,
			dataType: 'json',
			}).then(function (data) {
				$option.text(data[0].text);
				$option.val(data[0].id);
				$select.append($option).trigger('change');
				var initial2 = $('#editid_kompetensi_indikator_sd2').val();
				var $select2 = $('#editid_kompetensi_indikator_sd, #editid_kompetensi_indikator_sd_validate').select2();
				var $option2 = $("<option selected='selected'></option>");	
				$.ajax({ 
				type: 'GET',
				url: 'indikator/ambildatakompetensi2?id_kompetensi='+initial2 ,
				dataType: 'json',
				}).then(function (data) {
				$option2.text(data[0].text);
				$option2.val(data[0].id);
				$select2.append($option2).trigger('change');	
				unblockPageUI();
				});
			});
			$(function(){
				$('#editkelompok_kompetensi, #editkelompok_kompetensi_validate').select2({
				allowClear: true,
				language: "id",
				placeholder: 'Pilih salah satu kelompok kompetensi',
				ajax: {
					dataType: 'json',
					url: 'kompetensi/ambildatakelompokkompetensi',
					delay: 500,
					data: function (params) {
							var query = {
							search: params.term || '',
							page: params.page || 1
							} // Query parameters will be ?search=[term]&page=[page]
						return query;
						},
						cache: true,
				}
				});
			});

			var idkelompok2 = $('#editid_kompetensi_indikator_sd2').val();
			$('#editid_kompetensi_indikator_sd, #editid_kompetensi_indikator_sd_validate').select2({
			allowClear: true,
			language: "id",
			placeholder: 'Pilih salah satu kompetensi',
			ajax: {
				dataType: 'json',
				url: 'indikator/ambildatakompetensi?id_kelompok='+idkelompok2,
				delay: 500,
				data: function (params) {
						var query = {
						search: params.term || '',
						page: params.page || 1
						} // Query parameters will be ?search=[term]&page=[page]
					return query;
					},
					cache: true,
			}
			});
			selectPlaceholder('#editid_kompetensi_indikator_sd');
			selectPlaceholder('#editkeaktifan_indikator');		
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
// DATA KUISIONER
<?php } else if ($this->uri->segment(2)=="kuisioner") { ?>
$('#tambah_data').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			$(function(){
			$('#kelompok_kompetensi, #kelompok_kompetensi_validate').select2({
				// minimumInputLength: 1,
				allowClear: true,
				language: "id",
				placeholder: 'Pilih salah satu kelompok kompetensi',
				ajax: {
					dataType: 'json',
					url: 'kompetensi/ambildatakelompokkompetensi',
					delay: 500,
					data: function (params) {
							var query = {
							search: params.term || '',
							page: params.page || 1
							} // Query parameters will be ?search=[term]&page=[page]
						return query;
						},
						cache: true,
				}
			});
			});	
		 	unblockPageUI();	
		} else {
			koneksierror();
			setTimeout(function(){ $('#tambah_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
$('#edit_data').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var $select = $('#editkelompok_kompetensi, #editkelompok_kompetensi_validate').select2();
			var initial = $('#editkelompok_kompetensi2').val();
			$.ajax({ 
			type: 'GET',
			url: 'kompetensi/ambildatakelompokkompetensi2?id_kelompok=' +initial ,
			dataType: 'json',
			}).then(function (data) {
				var $option = $("<option selected='selected'></option>");
				$option.text(data[0].text);
				$option.val(data[0].id);
				$option.removeData();
				$select.append($option).trigger('change');
				unblockPageUI();	
			});
			$(function(){
					$('#editkelompok_kompetensi, #editkelompok_kompetensi_validate').select2({
					// minimumInputLength: 1,
					allowClear: true,
					language: "id",
					placeholder: 'Pilih salah satu kelompok kompetensi',
					ajax: {
						dataType: 'json',
						url: 'kompetensi/ambildatakelompokkompetensi',
						delay: 500,
						data: function (params) {
								var query = {
								search: params.term || '',
								page: params.page || 1
								} // Query parameters will be ?search=[term]&page=[page]
							return query;
							},
							cache: true,
					}
				});
			}); 
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#upload_file').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			$(function(){
			$('#edit_guru, #edit_guru_validate').select2({
				allowClear: true,
				language: "id",
				placeholder: 'Silahkan masukkan nama / nuptk guru',
				ajax: {
					dataType: 'json',
					url: 'sekolah/ambildatagurusdmengajar',
					delay: 500,
					data: function (params) {
						var kelompok2 =$('#editkelompok_kompetensi2').val();
							var query = {
							search: params.term || '',
							page: params.page || 1,
							kelompok : kelompok2,
							} // Query parameters will be ?search=[term]&page=[page]
						return query;
						},
						cache: true,
				}
			});
			});
			unblockPageUI();
			$(function() {
			$('#edit_guru').on("select2:select", function(e) { 
			$('#upload_file tr:last').remove();
			$('#upload_file tr:last').after('<tr valign="top"><td></td><td><label>Berkas File Yang Akan Diupload</label></td><td>:</td><td><div id="preview-container"><button id="upload-dialog" class="btn btn-info btn-elevate2 btn-elevate-air2"><i class="fa fa-file-pdf"></i>Pilih Berkas File PDF Yang Akan Di Upload</button><input type="file" id="pdf-file" name="pdf" accept="application/pdf" /><div id="pdf-loader">Memuat Tampilan ...</div><div id="pdf-contents"><div id="pdf-meta"><div id="pdf-buttons"><button id="pdf-prev" class="btn btn-info btn-elevate2 btn-elevate-air2"><i class="fa fa-arrow-circle-left"></i> Sebelumnya</button><button id="pdf-next" class="btn btn-info btn-elevate2 btn-elevate-air2">Selanjutnya <i class="fa fa-arrow-circle-right"></i></button><button id="cancel-pdf" class="btn btn-dark btn-elevate2 btn-elevate-air2"><i class="fa fa-trash-alt"></i> Batalkan Berkas</button></div><div id="page-count-container">Halaman <div id="pdf-current-page"></div> dari <div id="pdf-total-pages"></div></div></div><canvas id="pdf-preview" width="300" height="350"></canvas><span id="pdf-name"></span> <div id="page-loader">Memuat Halaman ...</div></div></td><td></td></tr>');
				var __PDF_DOC,
					__CURRENT_PAGE,
					__TOTAL_PAGES,
					__PAGE_RENDERING_IN_PROGRESS = 0,
					__CANVAS = $('#pdf-preview').get(0),
					__CANVAS_CTX = __CANVAS.getContext('2d'),
					_OBJECT_URL;
				function showPDF(pdf_url) {
					$("#pdf-loader").show();

					PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
						__PDF_DOC = pdf_doc;
						__TOTAL_PAGES = __PDF_DOC.numPages;
						
						// Hide the pdf loader and show pdf container in HTML
						$("#pdf-loader").hide();
						$("#pdf-contents").show();
						$("#pdf-total-pages").text(__TOTAL_PAGES);

						// Show the first page
						showPage(1);
					}).catch(function(error) {
						// If error re-show the upload button
						$("#pdf-loader").hide();
						$("#upload-button").show();
						
						alert(error.message);
					});;
				}

				function showPage(page_no) {
					__PAGE_RENDERING_IN_PROGRESS = 1;
					__CURRENT_PAGE = page_no;

					// Disable Prev & Next buttons while page is being loaded
					$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

					// While page is being rendered hide the canvas and show a loading message
					$("#pdf-preview").hide();
					$("#page-loader").show();

					// Update current page in HTML
					$("#pdf-current-page").text(page_no);
					
					// Fetch the page
					__PDF_DOC.getPage(page_no).then(function(page) {
						// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
						var scale_required = __CANVAS.width / page.getViewport(1).width;

						// Get viewport of the page at required scale
						var viewport = page.getViewport(scale_required);

						// Set canvas height
						__CANVAS.height = viewport.height;

						var renderContext = {
							canvasContext: __CANVAS_CTX,
							viewport: viewport
						};
						
						// Render the page contents in the canvas
						page.render(renderContext).then(function() {
							__PAGE_RENDERING_IN_PROGRESS = 0;

							// Re-enable Prev & Next buttons
							$("#pdf-next, #pdf-prev").removeAttr('disabled');

							// Show the canvas and hide the page loader
							$("#pdf-preview").show();
							$("#page-loader").hide();
						});
					});
				}

				// Previous page of the PDF
				$("#pdf-prev").off('click').on('click', function(event, data) {
					$('html, body, .modal-body').stop();
					event.preventDefault();
					if(__CURRENT_PAGE != 1)
						showPage(--__CURRENT_PAGE);
					return false;
				});

				// Next page of the PDF
				$("#pdf-next").off('click').on('click', function(event, data) {
					$('html, body, .modal-body').stop();
					event.preventDefault();
					if(__CURRENT_PAGE != __TOTAL_PAGES)
						showPage(++__CURRENT_PAGE);
						return false;
				});

				/* Show Select File dialog */
				$("#upload-dialog").off('click').on('click', function(event) {					
					$("#pdf-file").click();
					event.preventDefault();	
				});
				/* Selected File has changed */
				$("#pdf-file").off('change').on('change', function(event) {
					event.preventDefault();
					// user selected file
					var file = this.files[0];
					// allowed MIME types
					var mime_types = [ 'application/pdf' ]; 
					// Validate whether PDF
					if(mime_types.indexOf(file.type) == -1) {
						maksimumbesarfilepdf();
						event.target.value = null;
						return;
					}
					// validate file size
					if(file.size > 1*1024*1024) {
						maksimumbesarfilepdf();
						event.target.value = null;
						return;
					}
					// validation is successful
					// hide upload dialog button
					document.querySelector("#upload-dialog").style.display = 'none';
					// set name of the file
					document.querySelector("#pdf-name").innerText = "Nama File : "+file.name;
					document.querySelector("#pdf-name").style.display = 'inline';
					// show cancel and upload buttons now
					document.querySelector("#cancel-pdf").style.display = 'inline';
					//document.querySelector("#upload-button").style.display = 'inline-block';
					// Show the PDF preview loader
					document.querySelector("#pdf-loader").style.display = 'inline-block';
					// object url of PDF 
					_OBJECT_URL = URL.createObjectURL(file)

					// send the object url of the pdf to the PDF preview function
					showPDF(_OBJECT_URL);
					//console.log(document.querySelector("#pdf-file").value);
				});

				/* Reset file input */
				$("#cancel-pdf").off('click').on('click', function(event) {
					event.preventDefault();
					// show upload dialog button
					document.querySelector("#upload-dialog").style.display = 'inline-block';
					// reset to no selection
					document.querySelector("#pdf-file").value = '';
					// hide elements that are not required
					document.querySelector("#pdf-name").style.display = 'none';
					document.querySelector("#pdf-preview").style.display = 'none';
					document.querySelector("#pdf-loader").style.display = 'none';
					document.querySelector("#pdf-contents").style.display = 'none';
					document.querySelector("#cancel-pdf").style.display = 'none';
					//event.target.value = null;
					//console.log(document.querySelector("#pdf-file").value);
				});
				});
				});
				} else {
					koneksierror();
					setTimeout(function(){ $('#upload_file').modal('hide');}, 1000);
					unblockPageUI();
				}
				});
		});	
		// DATA HASIL KUISIONER
		<?php } else if ($this->uri->segment(2)=="hasilkuisioner") { ?>
		$('#edit_data').on('show.bs.modal', function(e) {
				blockPageUI();
				<?php  if ($this->session->userdata("username") !== "") {  ?>
				$.post("<?php echo base_url();?>Login/checksession", function (data) {
					if (data == "-1") {
						sessionexpired();
						setTimeout(function () {
							window.location.href = "<?php echo base_url();?>Login"
						}, 3000);
					}
				});
				<?php  } ?>			
				$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
				if (xhr.status == 200) {
					unblockPageUI();	
				} else {
					koneksierror();
					setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
					unblockPageUI();
				}
				});
		});	
		$('#edit_data').on('shown.bs.modal', function(e) {
		var __PDF_DOC,
			__CURRENT_PAGE,
			__TOTAL_PAGES,
			__PAGE_RENDERING_IN_PROGRESS = 0,
			__CANVAS = $('#pdf-preview').get(0),
			__CANVAS_CTX = __CANVAS.getContext('2d'),
			_OBJECT_URL;

		function showPDF(pdf_url) {
			$("#pdf-loader").show();

			PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
				__PDF_DOC = pdf_doc;
				__TOTAL_PAGES = __PDF_DOC.numPages;
				
				// Hide the pdf loader and show pdf container in HTML
				$("#pdf-loader").hide();
				$("#pdf-contents").show();
				$("#pdf-total-pages").text(__TOTAL_PAGES);

				// Show the first page
				showPage(1);
			}).catch(function(error) {
				// If error re-show the upload button
				$("#pdf-loader").hide();
				$("#upload-button").show();
				
				alert(error.message);
			});;
		}

		function showPage(page_no) {
			__PAGE_RENDERING_IN_PROGRESS = 1;
			__CURRENT_PAGE = page_no;

			// Disable Prev & Next buttons while page is being loaded
			$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

			// While page is being rendered hide the canvas and show a loading message
			$("#pdf-preview").hide();
			$("#page-loader").show();

			// Update current page in HTML
			$("#pdf-current-page").text(page_no);
			
			// Fetch the page
			__PDF_DOC.getPage(page_no).then(function(page) {
				// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
				var scale_required = __CANVAS.width / page.getViewport(1).width;

				// Get viewport of the page at required scale
				var viewport = page.getViewport(scale_required);

				// Set canvas height
				__CANVAS.height = viewport.height;

				var renderContext = {
					canvasContext: __CANVAS_CTX,
					viewport: viewport
				};
				
				// Render the page contents in the canvas
				page.render(renderContext).then(function() {
					__PAGE_RENDERING_IN_PROGRESS = 0;

					// Re-enable Prev & Next buttons
					$("#pdf-next, #pdf-prev").removeAttr('disabled');

					// Show the canvas and hide the page loader
					$("#pdf-preview").show();
					$("#page-loader").hide();
				});
			});
		}

		// Previous page of the PDF
		$("#pdf-prev").on('click', function(event, data) {
			$('html, body, .modal-body').stop();
			event.preventDefault();
			if(__CURRENT_PAGE != 1)
				showPage(--__CURRENT_PAGE);
			return false;
		});

		// Next page of the PDF
		$("#pdf-next").on('click', function(event, data) {
			$('html, body, .modal-body').stop();
			event.preventDefault();
			if(__CURRENT_PAGE != __TOTAL_PAGES)
				showPage(++__CURRENT_PAGE);
				return false;
		});

		/* Show Select File dialog */
		document.querySelector("#upload-dialog").addEventListener('click', function(event) {
			event.preventDefault();
			document.querySelector("#pdf-file").click();
		});
		/* Selected File has changed */
		document.querySelector("#pdf-file").addEventListener('change', function(event) {
			event.preventDefault();
			// user selected file
			var file = this.files[0];
			// allowed MIME types
			var mime_types = [ 'application/pdf' ]; 
			// Validate whether PDF
			if(mime_types.indexOf(file.type) == -1) {
				maksimumbesarfilepdf();
				event.target.value = null;
				return;
			}
			// validate file size
			if(file.size > 1*1024*1024) {
				maksimumbesarfilepdf();
				event.target.value = null;
				return;
			}
			// validation is successful
			// hide upload dialog button
			document.querySelector("#upload-dialog").style.display = 'none';
			// set name of the file
			document.querySelector("#pdf-name").innerText = "Nama File : "+file.name;
			document.querySelector("#pdf-name").style.display = 'inline';
			// show cancel and upload buttons now
			document.querySelector("#cancel-pdf").style.display = 'inline';
			//document.querySelector("#upload-button").style.display = 'inline-block';
			// Show the PDF preview loader
			document.querySelector("#pdf-loader").style.display = 'inline-block';
			// object url of PDF 
			_OBJECT_URL = URL.createObjectURL(file)

			// send the object url of the pdf to the PDF preview function
			showPDF(_OBJECT_URL);
			//console.log(document.querySelector("#pdf-file").value);
		});

		/* Reset file input */
		document.querySelector("#cancel-pdf").addEventListener('click', function(event) {
			event.preventDefault();
			// show upload dialog button
			document.querySelector("#upload-dialog").style.display = 'inline-block';
			// reset to no selection
			document.querySelector("#pdf-file").value = '';
			// hide elements that are not required
			document.querySelector("#pdf-name").style.display = 'none';
			document.querySelector("#pdf-preview").style.display = 'none';
			document.querySelector("#pdf-loader").style.display = 'none';
			document.querySelector("#pdf-contents").style.display = 'none';
			document.querySelector("#cancel-pdf").style.display = 'none';
			//event.target.value = null;
			//console.log(document.querySelector("#pdf-file").value);
		});
		});
$('#edit_datanilai').on('show.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();	
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_datanilai').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
$('#lihat_pdf').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var initial = $('#lokasifile').val();
			var options = {pdfOpenParams: {zoom: '50',  page: '1' }};
			PDFObject.embed("<?php echo base_url(); ?>"+initial, "#lihatfile", options);
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#ihat_pdf').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
// DATA PRIBADI GURU
<?php } else if ($this->uri->segment(2)=="pribadi") { ?>
blockPageUI();
$('document').ready(function() {
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>	
var Datepicker2 = function() {
  var t;
  t = KTUtil.isRTL() ? {
    leftArrow: '<i class="la la-angle-right"></i>',
    rightArrow: '<i class="la la-angle-left"></i>'
  } : {
    leftArrow: '<i class="la la-angle-left"></i>',
    rightArrow: '<i class="la la-angle-right"></i>'
  };
  return {
    init: function(event) {
		$("#edittgl_lahir").datepicker({
		rtl: KTUtil.isRTL(),
		todayHighlight: !0,
		language:"id",
		orientation: "bottom left",
		autoclose: true,
		showOnFocus:true,
		format:'yyyy-mm-dd'
		});
		$("#edittmt_guru").datepicker({
        rtl: KTUtil.isRTL(),
		todayHighlight: !0,
		language:"id",
        orientation: "bottom left",
		autoclose: true,
		showOnFocus:true,
		format:'yyyy-mm-dd'
	  });
    }
  }
}(); 
		if($(".datepicker").datepicker( "widget" ).is(":visible")){
			$("div.datepicker.datepicker-inline").remove(); 
		} else {
            blockPageUI();
            Datepicker2.init();
            selectPlaceholder('#pangkat_jabatan');
            unblockPageUI();
        }		
});
// DATA KUISIONER USER
<?php } else if ($this->uri->segment(2)=="kuisioneruser") { ?>
	$('#edit_datanilai').on('show.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();	
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_datanilai').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});
	$('#lihat_pdf').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var initial = $('#lokasifile').val();
			var options = {pdfOpenParams: {zoom: '50',  page: '1' }};
			PDFObject.embed("<?php echo base_url(); ?>"+initial, "#lihatfile", options);
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#ihat_pdf').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
$('#edit_data').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			$("#sembunyikan_file").css("display","none").attr('disabled','disabled');
			unblockPageUI();
			$('#tampilkan_file').on('click', function(e) {
				$("#sembunyikan_file").css("display","block").removeAttr('disabled');
				var initial = $('#lokasifile').val();
				var options = {pdfOpenParams: {zoom: '45',  page: '1' }};
				PDFObject.embed("<?php echo base_url(); ?>"+initial, "#lihatfile", options); 
				$('#aku.col-md-12').addClass('col-md-6').removeClass('col-md-12');
				$("#tampilkan_file").css("display","none").attr('disabled', 'disabled');
				$('#aku.col-md-6').last().css("display","block");
			});
			$('#sembunyikan_file').on('click', function(e) {
				$("#tampilkan_file").css("display","block").removeAttr('disabled');
				$('#aku.col-md-6').addClass('col-md-12').removeClass('col-md-6');
				$('#aku.col-md-12').last().css("display","none");
				$("#sembunyikan_file").css("display","none").attr('disabled', 'disabled');
			});	
			var __PDF_DOC,
					__CURRENT_PAGE,
					__TOTAL_PAGES,
					__PAGE_RENDERING_IN_PROGRESS = 0,
					__CANVAS = $('#pdf-preview').get(0),
					__CANVAS_CTX = __CANVAS.getContext('2d'),
					_OBJECT_URL;
				function showPDF(pdf_url) {
					$("#pdf-loader").show();

					PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
						__PDF_DOC = pdf_doc;
						__TOTAL_PAGES = __PDF_DOC.numPages;
						
						// Hide the pdf loader and show pdf container in HTML
						$("#pdf-loader").hide();
						$("#pdf-contents").show();
						$("#pdf-total-pages").text(__TOTAL_PAGES);

						// Show the first page
						showPage(1);
					}).catch(function(error) {
						// If error re-show the upload button
						$("#pdf-loader").hide();
						$("#upload-button").show();
						
						alert(error.message);
					});;
				}

				function showPage(page_no) {
					__PAGE_RENDERING_IN_PROGRESS = 1;
					__CURRENT_PAGE = page_no;

					// Disable Prev & Next buttons while page is being loaded
					$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

					// While page is being rendered hide the canvas and show a loading message
					$("#pdf-preview").hide();
					$("#page-loader").show();

					// Update current page in HTML
					$("#pdf-current-page").text(page_no);
					
					// Fetch the page
					__PDF_DOC.getPage(page_no).then(function(page) {
						// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
						var scale_required = __CANVAS.width / page.getViewport(1).width;

						// Get viewport of the page at required scale
						var viewport = page.getViewport(scale_required);

						// Set canvas height
						__CANVAS.height = viewport.height;

						var renderContext = {
							canvasContext: __CANVAS_CTX,
							viewport: viewport
						};
						
						// Render the page contents in the canvas
						page.render(renderContext).then(function() {
							__PAGE_RENDERING_IN_PROGRESS = 0;

							// Re-enable Prev & Next buttons
							$("#pdf-next, #pdf-prev").removeAttr('disabled');

							// Show the canvas and hide the page loader
							$("#pdf-preview").show();
							$("#page-loader").hide();
						});
					});
				}

				// Previous page of the PDF
				$("#pdf-prev").off('click').on('click', function(event, data) {
					$('html, body, .modal-body').stop();
					event.preventDefault();
					if(__CURRENT_PAGE != 1)
						showPage(--__CURRENT_PAGE);
					return false;
				});

				// Next page of the PDF
				$("#pdf-next").off('click').on('click', function(event, data) {
					$('html, body, .modal-body').stop();
					event.preventDefault();
					if(__CURRENT_PAGE != __TOTAL_PAGES)
						showPage(++__CURRENT_PAGE);
						return false;
				});

				/* Show Select File dialog */
				$("#upload-dialog").off('click').on('click', function(event) {					
					$("#pdf-file").click();
					event.preventDefault();	
				});
				/* Selected File has changed */
				$("#pdf-file").off('change').on('change', function(event) {
					event.preventDefault();
					// user selected file
					var file = this.files[0];
					// allowed MIME types
					var mime_types = [ 'application/pdf' ]; 
					// Validate whether PDF
					if(mime_types.indexOf(file.type) == -1) {
						maksimumbesarfilepdf();
						event.target.value = null;
						return;
					}
					// validate file size
					if(file.size > 1*1024*1024) {
						maksimumbesarfilepdf();
						event.target.value = null;
						return;
					}
					// validation is successful
					// hide upload dialog button
					document.querySelector("#upload-dialog").style.display = 'none';
					// set name of the file
					document.querySelector("#pdf-name").innerText = "Nama File : "+file.name;
					document.querySelector("#pdf-name").style.display = 'inline';
					// show cancel and upload buttons now
					document.querySelector("#cancel-pdf").style.display = 'inline';
					//document.querySelector("#upload-button").style.display = 'inline-block';
					// Show the PDF preview loader
					document.querySelector("#pdf-loader").style.display = 'inline-block';
					// object url of PDF 
					_OBJECT_URL = URL.createObjectURL(file)

					// send the object url of the pdf to the PDF preview function
					showPDF(_OBJECT_URL);
					//console.log(document.querySelector("#pdf-file").value);
				});

				/* Reset file input */
				$("#cancel-pdf").off('click').on('click', function(event) {
					event.preventDefault();
					// show upload dialog button
					document.querySelector("#upload-dialog").style.display = 'inline-block';
					// reset to no selection
					document.querySelector("#pdf-file").value = '';
					// hide elements that are not required
					document.querySelector("#pdf-name").style.display = 'none';
					document.querySelector("#pdf-preview").style.display = 'none';
					document.querySelector("#pdf-loader").style.display = 'none';
					document.querySelector("#pdf-contents").style.display = 'none';
					document.querySelector("#cancel-pdf").style.display = 'none';
					//event.target.value = null;
					//console.log(document.querySelector("#pdf-file").value);
				});
		} else {
			koneksierror();
			setTimeout(function(){ $('#edit_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});

$('#upload_file').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
				var __PDF_DOC,
					__CURRENT_PAGE,
					__TOTAL_PAGES,
					__PAGE_RENDERING_IN_PROGRESS = 0,
					__CANVAS = $('#pdf-preview').get(0),
					__CANVAS_CTX = __CANVAS.getContext('2d'),
					_OBJECT_URL;
				function showPDF(pdf_url) {
					$("#pdf-loader").show();

					PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
						__PDF_DOC = pdf_doc;
						__TOTAL_PAGES = __PDF_DOC.numPages;
						
						// Hide the pdf loader and show pdf container in HTML
						$("#pdf-loader").hide();
						$("#pdf-contents").show();
						$("#pdf-total-pages").text(__TOTAL_PAGES);

						// Show the first page
						showPage(1);
					}).catch(function(error) {
						// If error re-show the upload button
						$("#pdf-loader").hide();
						$("#upload-button").show();
						
						alert(error.message);
					});;
				}

				function showPage(page_no) {
					__PAGE_RENDERING_IN_PROGRESS = 1;
					__CURRENT_PAGE = page_no;

					// Disable Prev & Next buttons while page is being loaded
					$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

					// While page is being rendered hide the canvas and show a loading message
					$("#pdf-preview").hide();
					$("#page-loader").show();

					// Update current page in HTML
					$("#pdf-current-page").text(page_no);
					
					// Fetch the page
					__PDF_DOC.getPage(page_no).then(function(page) {
						// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
						var scale_required = __CANVAS.width / page.getViewport(1).width;

						// Get viewport of the page at required scale
						var viewport = page.getViewport(scale_required);

						// Set canvas height
						__CANVAS.height = viewport.height;

						var renderContext = {
							canvasContext: __CANVAS_CTX,
							viewport: viewport
						};
						
						// Render the page contents in the canvas
						page.render(renderContext).then(function() {
							__PAGE_RENDERING_IN_PROGRESS = 0;

							// Re-enable Prev & Next buttons
							$("#pdf-next, #pdf-prev").removeAttr('disabled');

							// Show the canvas and hide the page loader
							$("#pdf-preview").show();
							$("#page-loader").hide();
						});
					});
				}

				// Previous page of the PDF
				$("#pdf-prev").off('click').on('click', function(event, data) {
					$('html, body, .modal-body').stop();
					event.preventDefault();
					if(__CURRENT_PAGE != 1)
						showPage(--__CURRENT_PAGE);
					return false;
				});

				// Next page of the PDF
				$("#pdf-next").off('click').on('click', function(event, data) {
					$('html, body, .modal-body').stop();
					event.preventDefault();
					if(__CURRENT_PAGE != __TOTAL_PAGES)
						showPage(++__CURRENT_PAGE);
						return false;
				});

				/* Show Select File dialog */
				$("#upload-dialog").off('click').on('click', function(event) {					
					$("#pdf-file").click();
					event.preventDefault();	
				});
				/* Selected File has changed */
				$("#pdf-file").off('change').on('change', function(event) {
					event.preventDefault();
					// user selected file
					var file = this.files[0];
					// allowed MIME types
					var mime_types = [ 'application/pdf' ]; 
					// Validate whether PDF
					if(mime_types.indexOf(file.type) == -1) {
						maksimumbesarfilepdf();
						event.target.value = null;
						return;
					}
					// validate file size
					if(file.size > 1*1024*1024) {
						maksimumbesarfilepdf();
						event.target.value = null;
						return;
					}
					// validation is successful
					// hide upload dialog button
					document.querySelector("#upload-dialog").style.display = 'none';
					// set name of the file
					document.querySelector("#pdf-name").innerText = "Nama File : "+file.name;
					document.querySelector("#pdf-name").style.display = 'inline';
					// show cancel and upload buttons now
					document.querySelector("#cancel-pdf").style.display = 'inline';
					//document.querySelector("#upload-button").style.display = 'inline-block';
					// Show the PDF preview loader
					document.querySelector("#pdf-loader").style.display = 'inline-block';
					// object url of PDF 
					_OBJECT_URL = URL.createObjectURL(file)

					// send the object url of the pdf to the PDF preview function
					showPDF(_OBJECT_URL);
					//console.log(document.querySelector("#pdf-file").value);
				});

				/* Reset file input */
				$("#cancel-pdf").off('click').on('click', function(event) {
					event.preventDefault();
					// show upload dialog button
					document.querySelector("#upload-dialog").style.display = 'inline-block';
					// reset to no selection
					document.querySelector("#pdf-file").value = '';
					// hide elements that are not required
					document.querySelector("#pdf-name").style.display = 'none';
					document.querySelector("#pdf-preview").style.display = 'none';
					document.querySelector("#pdf-loader").style.display = 'none';
					document.querySelector("#pdf-contents").style.display = 'none';
					document.querySelector("#cancel-pdf").style.display = 'none';
					//event.target.value = null;
					//console.log(document.querySelector("#pdf-file").value);
				});
				} else {
					koneksierror();
					setTimeout(function(){ $('#upload_file').modal('hide');}, 1000);
					unblockPageUI();
				}
				});
});	
// DATA KINERJA YANG DINILAI
<?php } else if ($this->uri->segment(2)=="kinerjadinilai") { ?>

// DATA KINERJA
<?php } else if ($this->uri->segment(2)=="kinerja") { ?>
$('#upload_file').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();
			var __PDF_DOC,
				__CURRENT_PAGE,
				__TOTAL_PAGES,
				__PAGE_RENDERING_IN_PROGRESS = 0,
				__CANVAS = $('#pdf-preview').get(0),
				__CANVAS_CTX = __CANVAS.getContext('2d'),
				_OBJECT_URL;

				function showPage(page_no) {
				__PAGE_RENDERING_IN_PROGRESS = 1;
				__CURRENT_PAGE = page_no;

				// Disable Prev & Next buttons while page is being loaded
				$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

				// While page is being rendered hide the canvas and show a loading message
				$("#pdf-preview").hide();
				$("#page-loader").show();

				// Update current page in HTML
				$("#pdf-current-page").text(page_no);
				
				// Fetch the page
				__PDF_DOC.getPage(page_no).then(function(page) {
					// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
					var scale_required = __CANVAS.width / page.getViewport(1).width;

					// Get viewport of the page at required scale
					var viewport = page.getViewport(scale_required);

					// Set canvas height
					__CANVAS.height = viewport.height;

					var renderContext = {
						canvasContext: __CANVAS_CTX,
						viewport: viewport
					};
					
					// Render the page contents in the canvas
					page.render(renderContext).then(function() {
						__PAGE_RENDERING_IN_PROGRESS = 0;

						// Re-enable Prev & Next buttons
						$("#pdf-next, #pdf-prev").removeAttr('disabled');

						// Show the canvas and hide the page loader
						$("#pdf-preview").show();
						$("#page-loader").hide();
					});
				});
			}
					
			function showPDF(pdf_url) {
				$("#pdf-loader").show();

				PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
					__PDF_DOC = pdf_doc;
					__TOTAL_PAGES = __PDF_DOC.numPages;
					
					// Hide the pdf loader and show pdf container in HTML
					$("#pdf-loader").hide();
					$("#pdf-contents").show();
					$("#pdf-total-pages").text(__TOTAL_PAGES);

					// Show the first page
					showPage(1);
				}).catch(function(error) {
					// If error re-show the upload button
					$("#pdf-loader").hide();
					$("#upload-button").show();
					
					alert(error.message);
				});;
			}
			// Previous page of the PDF
			$("#pdf-prev").off('click').on('click', function(event, data) {
				$('html, body, .modal-body').stop();
				event.preventDefault();
				if(__CURRENT_PAGE != 1)
					showPage(--__CURRENT_PAGE);
				return false;
			});

			// Next page of the PDF
			$("#pdf-next").off('click').on('click', function(event, data) {
				$('html, body, .modal-body').stop();
				event.preventDefault();
				if(__CURRENT_PAGE != __TOTAL_PAGES)
					showPage(++__CURRENT_PAGE);
					return false;
			});

			/* Show Select File dialog */
			$("#upload-dialog").off("click").on("click",function(event) {
				//alert("A");
				$("#pdf-file").click();
				event.preventDefault();
			}); 

			/* Selected File has changed */
			$("#pdf-file").off("change").on("change",function(event) {
				event.preventDefault();
				// user selected file
				var file = this.files[0];
				// allowed MIME types
				var mime_types = [ 'application/pdf' ]; 
				// Validate whether PDF
				if(mime_types.indexOf(file.type) == -1) {
					maksimumbesarfilepdf();
					event.target.value = null;
					return;
				}
				// validate file size
				if(file.size > 1*1024*1024) {
					maksimumbesarfilepdf();
					event.target.value = null;
					return;
				}
				// validation is successful
				// hide upload dialog button
				document.querySelector("#upload-dialog").style.display = 'none';
				// set name of the file
				document.querySelector("#pdf-name").innerText = "Nama File : "+file.name;
				document.querySelector("#pdf-name").style.display = 'inline';
				// show cancel and upload buttons now
				document.querySelector("#cancel-pdf").style.display = 'inline';
				//document.querySelector("#upload-button").style.display = 'inline-block';
				// Show the PDF preview loader
				document.querySelector("#pdf-loader").style.display = 'inline-block';
				// object url of PDF 
				_OBJECT_URL = URL.createObjectURL(file)

				// send the object url of the pdf to the PDF preview function
				showPDF(_OBJECT_URL);
				//console.log(document.querySelector("#pdf-file").value);
			});

			/* Reset file input */
			$("#cancel-pdf").off("click").on("click", function(event) {
				event.preventDefault();
				document.querySelector("#upload-dialog").style.display = 'inline-block';
				document.querySelector("#pdf-file").value = '';
				document.querySelector("#pdf-name").style.display = 'none';
				document.querySelector("#pdf-preview").style.display = 'none';
				document.querySelector("#pdf-loader").style.display = 'none';
				document.querySelector("#pdf-contents").style.display = 'none';
				document.querySelector("#cancel-pdf").style.display = 'none';
			});	
		} else {
			koneksierror();
			setTimeout(function(){ $('#upload_file').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	

$('#upload_file2').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			$("#sembunyikan_file").css("display","none").attr('disabled','disabled');
			unblockPageUI();
			$('#tampilkan_file').on('click', function(e) {
			$("#sembunyikan_file").css("display","block").removeAttr('disabled');
				var initial = $('#lokasifile').val();
				var options = {pdfOpenParams: {zoom: '45',  page: '1' }};
				PDFObject.embed("<?php echo base_url(); ?>"+initial, "#lihatfile", options); 
				$('#aku.col-md-12').addClass('col-md-6').removeClass('col-md-12');
				$("#tampilkan_file").css("display","none").attr('disabled', 'disabled');
				$('#aku.col-md-6').last().css("display","block");
			});
			$('#sembunyikan_file').on('click', function(e) {
				$("#tampilkan_file").css("display","block").removeAttr('disabled');
				$('#aku.col-md-6').addClass('col-md-12').removeClass('col-md-6');
				$('#aku.col-md-12').last().css("display","none");
				$("#sembunyikan_file").css("display","none").attr('disabled', 'disabled');
			});	
			var __PDF_DOC,
				__CURRENT_PAGE,
				__TOTAL_PAGES,
				__PAGE_RENDERING_IN_PROGRESS = 0,
				__CANVAS = $('#pdf-preview2').get(0),
				__CANVAS_CTX = __CANVAS.getContext('2d'),
				_OBJECT_URL;

			function showPDF(pdf_url) {
				$("#pdf-loader2").show();

				PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
					__PDF_DOC = pdf_doc;
					__TOTAL_PAGES = __PDF_DOC.numPages;

					$("#pdf-loader2").hide();
					$("#pdf-contents2").show();
					$("#pdf-total-pages2").text(__TOTAL_PAGES);
					showPage(1);
				}).catch(function(error) {
					$("#pdf-loader2").hide();
					$("#upload-button2").show();
					
					alert(error.message);
				});;
			}

			function showPage(page_no) {
				__PAGE_RENDERING_IN_PROGRESS = 1;
				__CURRENT_PAGE = page_no;
				$("#pdf-next2, #pdf-prev2").attr('disabled', 'disabled');
				$("#pdf-preview2").hide();
				$("#page-loader2").show();
				$("#pdf-current-page2").text(page_no);
				
				// Fetch the page
				__PDF_DOC.getPage(page_no).then(function(page) {
					// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
					var scale_required = __CANVAS.width / page.getViewport(1).width;

					// Get viewport of the page at required scale
					var viewport = page.getViewport(scale_required);

					// Set canvas height
					__CANVAS.height = viewport.height;

					var renderContext = {
						canvasContext: __CANVAS_CTX,
						viewport: viewport
					};
					
					// Render the page contents in the canvas
					page.render(renderContext).then(function() {
						__PAGE_RENDERING_IN_PROGRESS = 0;

						// Re-enable Prev & Next buttons
						$("#pdf-next2, #pdf-prev2").removeAttr('disabled');

						// Show the canvas and hide the page loader
						$("#pdf-preview2").show();
						$("#page-loader2").hide();
					});
				});
			}

			$("#pdf-prev2").off("click").on('click', function(event, data) {
				$('html, body, .modal-body').stop();
				event.preventDefault();
				if(__CURRENT_PAGE != 1)
					showPage(--__CURRENT_PAGE);
				return false;
			});

			$("#pdf-next2").off("click").on('click', function(event, data) {
				$('html, body, .modal-body').stop();
				event.preventDefault();
				if(__CURRENT_PAGE != __TOTAL_PAGES)
					showPage(++__CURRENT_PAGE);
					return false;
			});

			$("#upload-dialog2").off("click").on('click', function(event) {
				$("#pdf-file2").click();
				event.preventDefault();
			});
			/* Selected File has changed */
			$("#pdf-file2").off("change").on('change', function(event) {
				event.preventDefault();
				// user selected file
				var file = this.files[0];
				// allowed MIME types
				var mime_types = [ 'application/pdf' ]; 
				// Validate whether PDF
				if(mime_types.indexOf(file.type) == -1) {
					maksimumbesarfilepdf();
					event.target.value = null;
					return;
				}
				// validate file size
				if(file.size > 1*1024*1024) {
					maksimumbesarfilepdf();
					event.target.value = null;
					return;
				}
				document.querySelector("#upload-dialog2").style.display = 'none';
				document.querySelector("#pdf-name2").innerText = "Nama File : "+file.name;
				document.querySelector("#pdf-name2").style.display = 'inline';
				document.querySelector("#cancel-pdf2").style.display = 'inline';
				document.querySelector("#pdf-loader2").style.display = 'inline-block';
				_OBJECT_URL = URL.createObjectURL(file)
				showPDF(_OBJECT_URL);
			});

			/* Reset file input */
			$("#cancel-pdf2").off("click").on('click', function(event) {
				event.preventDefault();
				document.querySelector("#upload-dialog2").style.display = 'inline-block';
				document.querySelector("#pdf-file2").value = '';
				document.querySelector("#pdf-name2").style.display = 'none';
				document.querySelector("#pdf-preview2").style.display = 'none';
				document.querySelector("#pdf-loader2").style.display = 'none';
				document.querySelector("#pdf-contents2").style.display = 'none';
				document.querySelector("#cancel-pdf2").style.display = 'none';
			});			
		} else {
			koneksierror();
			setTimeout(function(){ $('#upload_file2').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	

$('#lihat_pdf').on('shown.bs.modal', function(e) {
		blockPageUI();
		<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
		<?php  } ?>			
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			var initial = $('#lokasifile').val();
			var options = {pdfOpenParams: {zoom: '50',  page: '1' }};
			PDFObject.embed("<?php echo base_url(); ?>"+initial, "#lihatfile", options);
			unblockPageUI();
		} else {
			koneksierror();
			setTimeout(function(){ $('#ihat_pdf').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});	
$('#hapus_data').on('show.bs.modal', function(e) {
	blockPageUI();
	<?php  if ($this->session->userdata("username") !== "") {  ?>
		$.post("<?php echo base_url();?>Login/checksession", function (data) {
			if (data == "-1") {
				sessionexpired();
				setTimeout(function () {
					window.location.href = "<?php echo base_url();?>Login"
				}, 3000);
			}
		});
	<?php  } ?>
		$(this).find('.modal-content').load(e.relatedTarget.href, function(response, status, xhr) {
		if (xhr.status == 200) {
			unblockPageUI();		
		} else {
			koneksierror();
			setTimeout(function(){ $('#hapus_data').modal('hide');}, 1000);
			unblockPageUI();
		}
		});
});		
<?php } ?>
	$('.modal').on('shown.bs.modal', function () {
		$(this).find('[autofocus]').focus();
	});
	
	$("select.select2-me").each(function (index, el) {
		if ($(this).is("[data-rule-required]") &&
			$(this).attr("data-rule-required") == "true") {
			$(this).on('select2-close', function (e) {
				$(this).valid()
			});
		}
	});
$(function() {
	 $("select").on("select2:close", function (e) {  
			$(this).valid(); 
	});
});
function selectPlaceholder(selectID){
    var selected = $(selectID + ' option:selected');
    var val = selected.val();
    $(selectID + ' option' ).css('color', '#000');
    selected.css('color', '#a7abc3');
        if (val == "") {
          $(selectID).css('color', '#a7abc3');
        };
    $(selectID).change(function(){
          var val = $(selectID + ' option:selected' ).val();
          if (val == "") {
            $(selectID).css('color', '#a7abc3');
          }else{
            $(selectID).css('color', '#000');
          };
    });
};

function hanyaangka(myfield, e, dec) {
var key;
var keychar;
if (window.event)
key = window.event.keyCode;
else if (e)
key = e.which;
else
return true;
keychar = String.fromCharCode(key);
if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) {
return true;
}
else if ((("0123456789").indexOf(keychar) > -1)) {
return true;
}
else if (dec && (keychar == "."))
{
hanyanomor2();
return false;
}
else
hanyanomor2();
return false;
};
</script>
