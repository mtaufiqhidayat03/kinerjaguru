<?php if ($this->session->userdata("username") && $this->session->userdata("id_user")) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Ganti Password</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="post" id="form_ganti_password" class="form_ganti_password" enctype="multipart/form-data" >
<table width="100%" border="0" height="100%" id="tabel_editdata">
<tbody>
<?php foreach($n2 as $baris) {  ?>
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
    <td><label>Nama</label></td>
    <td>:</td>
	<td><div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="nama_guru" type="text" readonly class="form-control"  id="nama_guru"  placeholder="Silahkan masukkan nama Guru" value="<?php echo $baris->nama_guru;?>" /></div></div></td>
    <td width="8" valign="top">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td height="60"></td>
    <td><label>Password Login Sistem</label></td>
    <td>:</td>
    <td><div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editpassword" type="password" autofocus required class="form-control"  id="editpassword"  placeholder="Silahkan mengganti password untuk login sistem" /></div></div>
    </td>
  </tr>
</tbody>
<?php } ?>
</table>
</form>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="ganti_password"><i class="fa fa-lock"></i> Ganti Password</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
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
			url: "<?php echo base_url().FOLDER_SD;?>guru/aksigantipasswordguru",
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
					$(".dataTables").dataTable().fnClearTable(false); 
					$(".dataTables").dataTable().fnStandingRedraw();
					$('#ganti_password').modal('hide');
					$('#ganti_password').on('hidden.bs.modal', function(){
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
