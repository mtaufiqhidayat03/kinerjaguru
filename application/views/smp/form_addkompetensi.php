<?php if ($this->session->userdata("username") && $this->session->userdata("id_user")) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Tambah Data</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="post" id="form_adddata" class="form_adddata" enctype="multipart/form-data" >
<table width="100%" border="0" height="100%" id="tabel_adddata">
<tbody>
  <tr valign=top>
    <td width="6" height="60"></td>
    <td width="175"><label>Kelompok Kompetensi</label></td>
    <td width="16">:</td>
    <td width="378">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="kelompok_kompetensi" data-rel='chosen' class="form-control" id="kelompok_kompetensi" required>
	<option value=""></option>
    </select>
	</div>
	</div> 
	</td>
	<td></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td>
    <label>No Urut Kompetensi</label></td>
    <td>:</td>
    <td>
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <input class="form-control input" name="no_urut_kompetensi" type="text"  size="40" id="no_urut_kompetensi" required autofocus placeholder="Silahkan masukkan no urut kompetensi" onkeypress="return hanyaangka(event)" />
    </div></div>
	</td>
	<td></td>
  </tr>
  <tr valign=top>
    <td width="6" height="60"></td>
    <td width="175"><label>Nama Kompetensi</label></td>
    <td width="16">:</td>
    <td width="378">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="nama_kompetensi" type="text" required class="form-control" id="nama_kompetensi" placeholder="Silahkan masukkan nama kompetensi"></div></div>
	</td>
	<td width="10"></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Status Keaktifan Kompetensi</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
        <select name="keaktifan" data-rel='chosen'  class="form-control" required id="keaktifan" >
        <option value="">Pilih salah satu keaktifan kompetensi</option>
        <option value="Aktif">Aktif</option>
        <option value="Tidak Aktif">Tidak Aktif</option>
      </select>
	  </div></div></td>
	  <td></td>
  </tr>
</tbody>
</table>
</form>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-success btn-elevate2 btn-elevate-air2" id="submit_data"><i class="fa fa-plus"></i> Tambah Data</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
$(function() {
	$(document).on('click', "button#submit_data", function(){
		$('#form_adddata').validate({
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
		if ($('form.form_adddata').valid()) {
				var databaru = new FormData($('#form_adddata')[0]); 
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
			url: "<?php echo base_url().FOLDER_SMP;?>kompetensi/aksiaddkompetensi",
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
					berhasiltambah();
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
   					gagaltambah();
				}				
      			});
		} else {
			kurangisian();
		}
	});
});
</script>
<?php } ?>
