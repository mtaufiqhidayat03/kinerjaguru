<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<style type="text/css">
.pdfobject-container { 
	height: -moz-calc(100vh - 280px);
	height: -webkit-calc(100vh - 280px);
	height: -o-calc(100vh - 280px);
	height: calc(100vh - 280px);
	height: expression(100vh - 280px); 
}
table#sesuaikan tbody tr td {
	white-space: nowrap; 
	padding: 0.2rem .75rem 0.2rem .75rem !important;
}
.form-group label {
	font-weight: 800 !important;
}
</style>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Persetujuan Penilaian Kinerja</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<?php foreach($n2 as $baris) {  ?>
<div class="row">
<div class="col-md-12" id="aku">
<div class="table-responsive fixed-table-body">
<form action="" method="" id="form_persetujuan_kinerja" class="form_persetujuan_kinerja" enctype="multipart/form-data" >
<table width="100%" height="100%" id="sesuaikan" class="table">
	<tr valign=top>
    <td width="1%" height="60"></td>
    <td width="15%"><label>Kelompok Kompetensi</label></td>
    <td width="2%">:</td>
    <td width="60%">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_kelompok" type="text" readonly class="form-control"  id="editnama_kelompok"  placeholder="Silahkan masukkan nama kelompok kuisioner" value="<?php echo $baris->kelompok_kompetensi;?>"/></div></div> 
	</td>
	<td width="1%"></td>
  </tr>
	<tr valign=top>
    <td height="60"></td>
    <td><label>Nama Kompetensi</label></td>
    <td>:</td>
	<td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_kompetensi" type="text" readonly class="form-control"  id="editnama_kompetensi"  placeholder="Silahkan masukkan nama kompetensi" value="<?php echo $baris->nama_kompetensi;?>"/></div></div>
	</td>
	<td></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Nama Indikator</label></td>
    <td>:</td>
	<td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="editnama_indikator" type="text" readonly class="form-control"  id="editnama_indikator"  placeholder="Silahkan masukkan nama indikator" value="<?php echo $baris->nama_indikator;?>"/></div></div>
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
	<input name="editnama_guru" type="text" readonly class="form-control"  id="editnama_guru"  placeholder="Silahkan masukkan nama guru" value="<?php foreach($n1 as $baris2) { echo $baris2->nama_guru; } ?>"/></div></div>   
    </td>
    <td></td>
	</tr>
	<tr>
    <td></td>
	<td></td>
	<td></td>
	<td style="display:none">
	<input name="id_kompetensi" id="id_kompetensi" type="text" required readonly value="<?php echo $baris->id_kompetensi; ?>" />
	<input name="id_kelompok" id="id_kelompok" type="text" required readonly value="<?php echo $baris->id_kelompok;?>" />
	<input name="id_indikator" id="id_indikator" type="text" required readonly value="<?php echo $baris->id_indikator;?>" />
	<input name="nuptk" id="nuptk" type="text" required readonly value="<?php foreach($n1 as $baris2) { echo $baris2->nuptk; } ?>" />
	</td>
	<td></td>
</tr>
<tr valign=top>
    <td height="60"></td>
    <td valign="top"><label>Skor Indikator Kinerja</label></td>
    <td valign="top">:</td>
    <td>
    <div class="form-group row">
	<div class="kt-radio-list">    
    <label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="skor" value="0" class="skor" required <?php if($baris->skor =="0") {echo "checked=''";} ?>>0<span></span></label>
	<label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="skor" value="1" class="skor" required <?php if($baris->skor =="1") {echo "checked=''";} ?>>1<span></span></label>
	<label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="skor" value="2" class="skor" required <?php if($baris->skor =="2") {echo "checked=''";} ?>>2<span></span></label>
    </div>
    </div>
    </td>
  </tr>
</table>
</form>
</div>
</div>
<div class="col-md-12" id="aku">
<table width="100%" border="0">
<tr valign=top>
	<td style="display:none">
	<input name="lokasifile" id="lokasifile" type="text" readonly value="<?php echo $baris->upload_file_penilaian_smp; ?>" />
	</td>
</tr>
<tr valign=top>
    <td>
	<div id="lihatfile"></div>
	</td>
</tr>
</table>
</div>
</div>
<?php } ?>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_persetujuan"><i class="fa fa-thumbs-up"></i> Persetujuan Penilaian Kinerja</button>
<button type="button" class="btn btn-warning btn-elevate2 btn-elevate-air2" id="tampilkan_file"><i class="fa fa-eye"></i> Tampilkan Bukti Kinerja</button>
<button type="button" class="btn btn-dark btn-elevate2 btn-elevate-air2" id="sembunyikan_file"><i class="fa fa-eye-slash"></i> Sembunyikan Bukti Kinerja</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
  $(function() {
	$(document).on('click', "button#submit_persetujuan", function(){
		$('#form_persetujuan_kinerja').validate({
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
		if ($('form.form_persetujuan_kinerja').valid()) {
			var databaru = new FormData($('#form_persetujuan_kinerja')[0]); 
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
			url: "<?php echo base_url().FOLDER_SMP_USER;?>kinerjadinilai/aksipersetujuankinerja",
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
					berhasildisetujui();
					$("#data_evaluasi").dataTable().fnClearTable(false); 
					$("#data_evaluasi").dataTable().fnStandingRedraw(); 
					$('#persetujuan_kinerja').modal('hide');
					$('#persetujuan_kinerja').on('hidden.bs.modal', function(){
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
   				gagaldisetujui();
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
