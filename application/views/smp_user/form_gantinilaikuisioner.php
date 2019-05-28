<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Nilai Kuisioner</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_upload_file2" class="form_upload_file2" enctype="multipart/form-data" >
<table width="100%" height="100%">
<?php foreach($n2 as $baris) {  ?>
	<tr valign=top>
    <td width="6" height="60"></td>
    <td width="250"><label>Kelompok Kompetensi</label></td>
    <td width="16">:</td>
    <td width="378">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_kelompok" type="text" readonly class="form-control"  id="editnama_kelompok"  placeholder="Silahkan masukkan nama kelompok kuisioner" value="<?php echo $baris->kelompok_kompetensi;?>"/></div></div> 
	</td>
	<td width="6"></td>
  </tr>
	<tr valign=top>
    <td height="60"></td>
    <td><label>Nama Kuisioner</label></td>
    <td>:</td>
	<td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_kuisioner" type="text" readonly class="form-control"  id="editnama_kuisioner"  placeholder="Silahkan masukkan nama kuisioner" value="<?php echo $baris->nama_kuisioner;?>"/></div></div>
	</td>
	<td></td>
  </tr>
<tr valign="top">
   <td height="50"></td>
    <td valign="top"><label>Nama Guru</label></td>
    <td valign="top">:</td>
    <td valign="top">
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_guru" type="text" readonly class="form-control"  id="editnama_guru"  placeholder="Silahkan masukkan nama guru" value="<?php echo $baris->nama_guru;?>"/>
	</div>
	</div>   
    </td>
    <td></td>
	</tr>
	<tr valign="top">
   <td height="50"></td>
    <td valign="top"><label>Nilai Kuisioner</label></td>
    <td valign="top">:</td>
    <td valign="top">
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnilai_kuisioner" autofocus type="text" class="form-control"  id="editnilai_kuisioner"  placeholder="Silahkan masukkan nilai kuisioner" required onkeypress="return hanyaangka(event)" value="<?php echo $baris->nilai_kuisioner;?>"/></div></div>  
    </td>
    <td></td>
	</tr>
	<tr>
    <td></td>
	<td></td>
	<td></td>
	<td style="display:none">
	<input name="editid_kuisioner" id="editid_kuisioner" type="text" readonly value="<?php echo $baris->id_kuisioner; ?>" />
	<input name="edit_guru" id="edit_guru" type="text" readonly value="<?php echo $baris->nuptk_kuisioner_smp;?>" />
	<input name="no_kuisioner" id="no_kuisioner" type="text" readonly value="<?php echo $baris->no_kuisioner;?>" />
	</td>
	<td></td>
</tr>
  <?php } ?>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-success btn-elevate2 btn-elevate-air2" id="ganti_nilai"><i class="fa fa-pencil-alt"></i> Ganti Nilai Kuisioner</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
 $(function() {
	$(document).on('click', "button#ganti_nilai", function(){
		$('#form_upload_file2').validate({
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
		if ($('form.form_upload_file2').valid()) {
			var databaru = new FormData($('#form_upload_file2')[0]); 
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
			url: "<?php echo base_url().FOLDER_SMP_USER;?>kuisioneruser/aksigantinilaikuisioner",
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
					$('#edit_datanilai').modal('hide');
					$('#edit_datanilai').on('hidden.bs.modal', function(){
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
<script>


</script>
<?php } ?>
