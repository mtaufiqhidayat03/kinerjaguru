<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
	<style type="text/css">

#preview-container2 {
    width: 600px;
}

#pdf-file2 {
    display: none;
}

#pdf-loader2 {
	display: none;
	vertical-align: middle;
	color: #cccccc;
    font-size: 12px;
}

#pdf-preview2 {
    display: none;
    vertical-align: middle;
    border: 1px solid rgba(0,0,0,0.2);
    border-radius: 2px;
}

#pdf-name2 {
    display: none;
    vertical-align: middle;
    color: #000000;
	font-size:1.2rem;
    max-width: 200px;
    overflow: hidden;
   /* white-space: nowrap; */
	text-overflow: ellipsis;
	word-wrap: break-word;
	/* word-break: break-all;  /* break by word */
	word-break: break-word; /* break by sentence */
}

#pdf-loader2 {
	display: none;
	text-align: center;
	color: #999999;
	font-size: 13px;
	line-height: 100px;
	height: 100px;
}

#pdf-contents2 {
	display: none;
}

#pdf-meta2 {
	overflow: hidden;
	margin: 0 0 20px 0;
}

#pdf-buttons2 {
	float: left;
}

#page-count-container2 {
	float: right;
	font-size:1.2rem;
}

#pdf-current-page2 {
	display: inline;
}

#pdf-total-pages2 {
	display: inline;
}

#pdf-canvas2 {
	border: 1px solid rgba(0,0,0,0.2);
	box-sizing: border-box;
}

#page-loader2 {
	height: 100px;
	line-height: 100px;
	text-align: center;
	display: none;
	color: #999999;
	font-size: 13px;
}
.pdfobject-container { 
height: -moz-calc(100vh - 300px);
height: -webkit-calc(100vh - 300px);
height: -o-calc(100vh - 300px);
height: calc(100vh - 300px);
height: expression(100vh - 300px); 
}
table#sesuaikan tbody tr td {
	white-space: nowrap; 
	padding: 0.3rem .75rem 0.3rem .75rem !important;
}
</style>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Ganti Berkas Bukti Penilaian Kinerja</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<?php foreach($n2 as $baris) {  ?>
<div class="row">
<div class="col-md-12" id="aku">
<div class="table-responsive fixed-table-body">
<form action="" method="" id="form_upload_file2" class="form_upload_file2" enctype="multipart/form-data" >
<table width="100%" height="100%" id="sesuaikan" class="table">
	<tr valign=top>
    <td width="1%" height="60"></td>
    <td width="25%"><label>Kelompok Kompetensi</label></td>
    <td width="5%">:</td>
    <td width="65%">
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
	<tr valign="top">
    <td></td>
	<td><label>Berkas File Yang Akan Diganti</label></td>
	<td>:</td>
	<td>
	<div id="preview-container">
    <button id="upload-dialog2" class="btn btn-info btn-elevate2 btn-elevate-air2"><i class="fa fa-file-pdf"></i>Pilih Berkas PDF Yang Akan Di Ganti</button>
    <input type="file" id="pdf-file2" name="pdf" accept="application/pdf" />
    <div id="pdf-loader2">Memuat Tampilan ...</div>
	<div id="pdf-contents2">
		<div id="pdf-meta2">
			<div id="pdf-buttons2">
				<button id="pdf-prev2" class="btn btn-info btn-elevate2 btn-elevate-air2"><i class="fa fa-arrow-circle-left"></i> Sebelumnya</button>
				<button id="pdf-next2" class="btn btn-info btn-elevate2 btn-elevate-air2">Selanjutnya <i class="fa fa-arrow-circle-right"></i></button>
				<button id="cancel-pdf2" class="btn btn-dark btn-elevate2 btn-elevate-air2"><i class="fa fa-trash-alt"></i> Batalkan Berkas</button>
			</div>
			<div id="page-count-container2">Halaman <div id="pdf-current-page2"></div> dari <div id="pdf-total-pages2"></div></div>
		</div>
    <canvas id="pdf-preview2" width="300" height="350"></canvas>
    <span id="pdf-name2"></span> 
	<div id="page-loader2">Memuat Halaman ...</div>
</div>
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
	</td>
	<td></td>
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
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_file2"><i class="fa fa-pencil-alt"></i> Ganti Berkas Bukti Kinerja</button>
<button type="button" class="btn btn-warning btn-elevate2 btn-elevate-air2" id="tampilkan_file"><i class="fa fa-eye"></i> Tampilkan Bukti Kinerja Saat Ini</button>
<button type="button" class="btn btn-dark btn-elevate2 btn-elevate-air2" id="sembunyikan_file"><i class="fa fa-eye-slash"></i> Sembunyikan Bukti Kinerja Saat Ini</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
  $(function() {
	$(document).on('click', "button#submit_file2", function(){
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
		if (document.querySelector("#pdf-file2").value === "") {
			pilihsalahsatufilepdf();
		} else {
		if ($('form.form_upload_file2').valid() && document.querySelector("#pdf-file2").value !== "") {
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
			url: "<?php echo base_url().FOLDER_SMP_USER;?>kinerja/aksigantifilekinerja",
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
					$('#upload_file2').modal('hide');
					$('#upload_file2').on('hidden.bs.modal', function(){
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
		}
	});
});
</script>
<script>


</script>
<?php } ?>
