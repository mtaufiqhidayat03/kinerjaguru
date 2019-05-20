<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Tambah Data</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_assesor" class="form_assesor" enctype="multipart/form-data" >
<table width="100%" height="100%">

<tr valign="top">
   <td width="11" height="50"></td>
    <td width="211"><label>Assesor</label></td>
    <td width="20">:</td>
    <td width="380">
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="assesor" data-rel='chosen' class="form-control assesor" id="assesor" required >
	<option value=""></option>
    </select>
	</div>
	</div>   
    </td>
    <td width="6"></td>
	</tr>
	<tr valign="top">
   <td width="11" height="50"></td>
    <td width="211"><label>Guru Yang Dinilai</label><br><small>Assesor dan guru yang dinilai harus dalam satu sekolah</small></td>
    <td width="20">:</td>
    <td width="380">
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="guru_dinilai" data-rel='chosen' class="form-control guru_dinilai" id="guru_dinilai" required >
	<option value="">Silahkan pilih assesor terlebih dahulu</option>
    </select>
	</div>
	</div>   
    </td>
    <td></td>
	</tr>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_assesor"><i class="fa fa-pen"></i> Tambah Data</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
 $(function() {
	$(document).on('click', "button#submit_assesor", function(){
		$('#form_assesor').validate({
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
		if ($('form.form_assesor').valid()) {
			var databaru = new FormData($('#form_assesor')[0]); 
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
			url: "<?php echo base_url().FOLDER_SD_USER;?>assesor/aksiaddassesor",
			data: databaru,
				beforeSend: function(){
				},
        		success: function(data){
			   if (data != "") {
				toastr.options = {
  				"closeButton": true,
 				"debug": false,
				"positionClass": "toast-top-center",
				"preventDuplicates": true,
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
					$(".dataTables").dataTable().fnClearTable(false); 
					$(".dataTables").dataTable().fnStandingRedraw(); 
					$('#tambah_data').modal('hide');
					$('#tambah_data').on('hidden.bs.modal', function(){
					$("input:checked").parent().removeClass("checked").find("span").html("");
					$(this).find('form')[0].reset();
					unblockPageUI();
					});
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
<?php } ?>
