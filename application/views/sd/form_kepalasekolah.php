<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Pilih Kepala Sekolah</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_kepala_sekolah" class="form_kepala_sekolah" enctype="multipart/form-data" >
<table width="100%" height="100%">
<?php foreach($n1 as $baris) {  ?>
	<tr valign="top">
    <td width="11" height="70"></td>
    <td width="211"><label>NPSN/NSS</label><br/></td>
    <td width="20">:</td>
    <td width="380">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="npsn_nss" class="form-control" id="npsn_nss" type="text" required readonly placeholder="Masukkan NPSN/NSS" value="<?php echo $baris->npsn_nss;?>"/>
		</div></div>
		</td>
    <td width="27"></td>
  </tr>
  <tr valign="top">
    <td height="70"></td>
    <td><label>Nama Sekolah</label></td>
    <td>:</td>
		<td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="nama_sekolah" id="nama_sekolah" type="text" size = "40" required readonly class="form-control" placeholder="Masukkan nama sekolah" value="<?php echo $baris->nama_sekolah;?>"></div></div></td>
    <td></td>
	</tr>
<tr valign="top">
   <td height="50"></td>
    <td valign="top"><label>Kepala Sekolah</label><br/><small>Diambil dari guru yang berada pada sekolah bersangkutan</small></td>
    <td valign="top">:</td>
    <td valign="top">
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="editkepala_sekolah" data-rel='chosen' class="form-control editkepala_sekolah" id="editkepala_sekolah" required >
	<option value=""></option>
    </select>
	</div>
	</div>   
    </td>
    <td></td>
	</tr>
  <?php } ?>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_kepala"><i class="fa fa-pen"></i> Edit Kepala Sekolah</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
 $(function() {
	$(document).on('click', "button#submit_kepala", function(){
		$('#form_kepala_sekolah').validate({
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
		if ($('form.form_kepala_sekolah').valid()) {
			var databaru = new FormData($('#form_kepala_sekolah')[0]); 
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
			url: "<?php echo base_url().FOLDER_SD;?>sekolah/aksieditkepalasekolah",
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
					$('#kepala_sekolah').modal('hide');
					$('#kepala_sekolah').on('hidden.bs.modal', function(){
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
