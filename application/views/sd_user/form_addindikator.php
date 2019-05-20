<?php if ($this->session->userdata("username") && $this->session->userdata("id_user")) { ?>
<script type="text/javascript">
function rubah()
{
	$(function(){
		if($('#id_kompetensi_indikator_sd').hasClass("select2-hidden-accessible")) {
		$('#id_kompetensi_indikator_sd').val(null).trigger('change');
		} 
		var opt = $('#kelompok_kompetensi').find(':selected');
		var idkelompok = opt.val();
        $('#id_kompetensi_indikator_sd, #id_kompetensi_indikator_sd_validate').select2({
           allowClear: true,
		   language: "id",
           placeholder: 'Silahkan pilih salah satu kompetensi',
           ajax: {
              dataType: 'json',
              url: 'indikator/ambildatakompetensi?id_kelompok='+idkelompok,
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
}

</script>
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
    <select name="kelompok_kompetensi" autofocus  data-rel='chosen' class="form-control" id="kelompok_kompetensi" required onChange="javascript:rubah(this)">
	<option value=""></option>
    </select>
	</div>
	</div> 
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
    <select name="id_kompetensi_indikator_sd" data-rel='chosen' class="form-control placeholder" id="id_kompetensi_indikator_sd" required>
	<option value="" selected class="placeholder2">Silahkan pilih kelompok kompetensi terlebih dahulu</option>
    </select>
	</div>
	</div> 
	</td>
	<td></td>
  </tr>
  <tr valign=top>
    <td width="6" height="60"></td>
    <td width="175"><label>Nama Indikator</label></td>
    <td width="16">:</td>
    <td width="378">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="nama_indikator" type="text" required class="form-control" id="nama_indikator" placeholder="Silahkan masukkan nama indikator"></div></div>
	</td>
	<td width="10"></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td>
    <label>No Urut Indikator</label></td>
    <td>:</td>
    <td>
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <input class="form-control input" name="no_urut_indikator" type="text"  size="40" id="no_urut_indikator" required placeholder="Silahkan masukkan no urut indikator kompetensi" onkeypress="return hanyaangka(event)" />
    </div></div>
	</td>
	<td></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Status Keaktifan Indikator</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
        <select name="keaktifan_indikator" data-rel='chosen'  class="form-control placeholder" required id="keaktifan_indikator" >
        <option value="" >Pilih salah satu keaktifan indikator</option>
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
			url: "<?php echo base_url().FOLDER_SD_USER;?>indikator/aksiaddindikator",
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
