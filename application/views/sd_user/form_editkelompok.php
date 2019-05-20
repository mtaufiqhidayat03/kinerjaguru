<?php if ($this->session->userdata("username") && $this->session->userdata("id_user")) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Data</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="post" id="form_edit_data" class="form_edit_data" enctype="multipart/form-data" >
<table width="100%" border="0" height="100%" id="tabel_editdata">
<tbody>
<?php foreach($n2 as $baris) {  ?>
	<tr valign="top">
    <td width="6" height="60"></td>
    <td width="175"><label>ID Kelompok</label></td>
    <td width="16">:</td>
	<td width="378"><div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="id_kelompok" readonly type="text" required class="form-control" id="id_kelompok" placeholder="ID kelompok" value="<?php echo $baris->id_kelompok;?>" />
	</div></div></td>
	<td width="10"></td>
  </tr>
	<tr valign=top>
    <td height="60"></td>
    <td><label>Nama Kelompok Kompetensi</label></td>
    <td>:</td>
	<td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_kelompok" type="text" autofocus required class="form-control"  id="editnama_kelompok"  placeholder="Silahkan masukkan nama detail kelompok kompetensi" value="<?php echo $baris->kelompok_kompetensi;?>"/></div></div>
	</td>
	<td></td>
  </tr>
</tbody>
<?php } ?>
</table>
</form>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="edit_data"><i class="fa fa-pencil-alt"></i> Edit Data</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
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
			url: "<?php echo base_url().FOLDER_SD;?>kelompok/aksieditkelompok",
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
					$('#edit_data').modal('hide');
					$('#edit_data').on('hidden.bs.modal', function(){
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
