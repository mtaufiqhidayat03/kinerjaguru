<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<script type='text/javascript'>
function rubah()
{
var opt = $('#jenis_guru').find(':selected');
var jenisguru = opt.val();
if (jenisguru === "Guru Kelas") {
	$('#guru_sekolah tr:last').remove();
	$('#guru_sekolah tr:last').after(
	'<tr valign="top"><div id="detail_kelas" style="display:none"><td></td><td><label>Wali Kelas</label></td><td>:</td><td><div class="form-group row"><div class="kt-input-icon kt-input-icon--left"><span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span><select name="detail_guru" data-rel="chosen" class="form-control" required id="detail_guru" ><option value="">Pilih kelas dibawah ini</option><optgroup label="Kelas Sekolah Dasar"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></optgroup></select></div></div></td><td></td></div></tr>');
	/* $("#detail_kelas").css('height','70');
	$("#detail_kelas").css('display','visible');
	$("#kelas_guru").attr("disabled", false);
	$("#detail_mapel").css('height','0');
	$("#guru_sekolah tr #detail_mapel").css('display','none');
	$("#detail_guru").attr("disabled", true); */
} else {
	$('#guru_sekolah tr:last').remove();
	$('#guru_sekolah tr:last').after(
	'<tr valign="top"><div id="detail_mapel" style="display:none"><td></td><td><label>Detail Mata Pelajaran</label></td><td>:</td><td><div class="form-group row"><div class="kt-input-icon kt-input-icon--left"><span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span><input name="detail_guru" id="detail_guru" type="text" size = "40" required class="form-control" placeholder="Masukkan detail mata pelajaran"></div></div></td><td></td></div></tr>');
}
}
</script>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Pilih Jenis Guru</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_guru_sekolah" class="form_guru_sekolah" enctype="multipart/form-data" >
<table width="100%" height="100%" id="guru_sekolah">
<?php foreach($n1 as $baris) {  ?>
	<tr valign="top">
    <td width="11" height="70"></td>
    <td width="211"><label>NUPTK</label><br/></td>
    <td width="20">:</td>
    <td width="380">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="nuptk" class="form-control" id="nuptk" type="text" required readonly placeholder="Masukkan NNUPTK" value="<?php echo $baris->nuptk;?>"/>
		</div></div>
		</td>
    <td width="27"></td>
  </tr>
  <tr valign="top">
    <td height="70"></td>
    <td><label>Nama Guru</label></td>
    <td>:</td>
		<td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="nama_guru" id="nama_guru" type="text" size = "40" required readonly class="form-control" placeholder="Masukkan nama guru" value="<?php echo $baris->nama_guru;?>"></div></div>
		</td>
    <td></td>
  </tr>
<tr valign="top">
   <td height="60">&nbsp;</td>
    <td><label>Nama Sekolah</label></td>
    <td>:</td>
    <td> 
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="edit_gurusekolah2" id="edit_gurusekolah2" type="text" size = "40" required readonly class="form-control" placeholder="Masukkan nama sekolah" value="<?php echo $baris->nama_sekolah; ?>"></div></div> 
    </td>
    <td></td>
	</tr>
	<tr valign=top>
    <td height="0" colspan="4" style="display:none">
	<input name="edit_gurusekolah3" id="edit_gurusekolah3" class="form-control" type="text" required readonly value="<?php echo $baris->npsn_nss; ?>" placeholder="">
	</td>
  </tr>
	<tr valign=top>
    <td height="60"></td>
    <td><label>Jenis Guru</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
        <select name="jenis_guru" data-rel='chosen'  class="form-control" required id="jenis_guru" onChange="javascript:rubah(this)">
        <option value="">Pilih jenis guru dibawah ini</option>
        <optgroup label="Guru Sekolah Dasar">
        <option value="Guru Kelas">Guru Kelas</option>
		<option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
        </optgroup>
      </select>
      </div></div></td>
  </tr>
  <tr valign=top>
    <td height="0" colspan="4">
	</td>
  </tr>
  <?php } ?>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_guru"><i class="fa fa-pen"></i> Pilih Sekolah</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
$(function() {
	$(document).on('click', "button#submit_guru", function(){
		$('#form_guru_sekolah').validate({
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
		if ($('form.form_guru_sekolah').valid()) {
			var databaru = new FormData($('#form_guru_sekolah')[0]); 
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
			url: "<?php echo base_url().FOLDER_SD_USER;?>guru/aksieditgurusekolah",
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
					$('#guru_sekolah').modal('hide');
					$('#guru_sekolah').on('hidden.bs.modal', function(){
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
