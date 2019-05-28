<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<script type='text/javascript'>
function rubah()
{
var opt = $('#jenis_guru').find(':selected');
var jenisguru = opt.val();
if (jenisguru === "Guru Kelas") {
	$('#detail_guru').val("");
	$('#detail_guru').prop("readonly",false);
	$("#detail_guru").keypress(function(myfield, e, dec){
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
else if ((("0123456789,").indexOf(keychar) > -1)) {
return true;
}
else if (dec && (keychar == "."))
{
hanyanomor3();
return false;
}
else
hanyanomor3();
return false;
});
} else {
	$('#detail_guru').val("-");
	$('#detail_guru').prop("readonly",true);
}
}
</script>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Hubungkan Dengan Data Guru</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_hub_kelompok" class="form_hub_kelompok" enctype="multipart/form-data" >
<table width="100%" height="100%" id="guru_sekolah">
<?php foreach($n2 as $baris) {  ?>
	<tr valign="top">
    <td width="11" height="70"></td>
    <td width="211"><label>ID kelompok</label><br/></td>
    <td width="20">:</td>
    <td width="380">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="id_kelompok" class="form-control" id="id_kelompok" type="text" required readonly placeholder="Masukkan ID Kelompok" value="<?php echo $baris->id_kelompok;?>"/>
		</div></div>
		</td>
    <td width="6"></td>
  </tr>
  <tr valign="top">
    <td height="70"></td>
    <td><label>Kelompok Kompetensi</label></td>
    <td>:</td>
		<td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="kelompok_kompetensi" id="kelompok_kompetensi" type="text" size = "40" readonly class="form-control" placeholder="Masukkan kelompok kompetensi" value="<?php echo $baris->kelompok_kompetensi;?>"></div></div></td>
    <td></td>
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
  <tr valign="top">
	<td></td>
	<td><label>Kelas</label><br/><small>Masukkan tanda koma setelah angka</small></td>
	<td>:</td
	><td><div class="form-group row"><div class="kt-input-icon kt-input-icon--left"><span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span><input name="detail_guru" id="detail_guru" type="text" size = "40" readonly required value="" class="form-control" placeholder="Masukkan detail kelas"></div></div></td>
	<td></td>
</tr>
  <?php } ?>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_hubungan"><i class="fa fa-pen"></i> Edit Data</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
$(function() {
	$(document).on('click', "button#submit_hubungan", function(){
		$('#form_hub_kelompok').validate({
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
		if ($('form.form_hub_kelompok').valid()) {
			var databaru = new FormData($('#form_hub_kelompok')[0]); 
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
			url: "<?php echo base_url().FOLDER_SMP;?>kelompok/aksiedithubkelompok",
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
					$('#hub_data').modal('hide');
					$('#hub_data').on('hidden.bs.modal', function(){
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
