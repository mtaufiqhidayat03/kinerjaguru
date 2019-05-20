<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
	<style type="text/css">

#preview-container {
    width: 600px;
}

#pdf-file {
    display: none;
}

#pdf-loader {
	display: none;
	vertical-align: middle;
	color: #cccccc;
    font-size: 12px;
}

#pdf-preview {
    display: none;
    vertical-align: middle;
    border: 1px solid rgba(0,0,0,0.2);
    border-radius: 2px;
}

#pdf-name {
    display: none;
    vertical-align: middle;
    color: #000000;
	font-size:1.2rem;
    max-width: 200px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

#pdf-loader {
	display: none;
	text-align: center;
	color: #999999;
	font-size: 13px;
	line-height: 100px;
	height: 100px;
}

#pdf-contents {
	display: none;
}

#pdf-meta {
	overflow: hidden;
	margin: 0 0 20px 0;
}

#pdf-buttons {
	float: left;
}

#page-count-container {
	float: right;
	font-size:1.2rem;
}

#pdf-current-page {
	display: inline;
}

#pdf-total-pages {
	display: inline;
}

#pdf-canvas {
	border: 1px solid rgba(0,0,0,0.2);
	box-sizing: border-box;
}

#page-loader {
	height: 100px;
	line-height: 100px;
	text-align: center;
	display: none;
	color: #999999;
	font-size: 13px;
}
</style>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Upload Berkas</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_upload_file" class="form_upload_file" enctype="multipart/form-data" >
<table width="100%" height="100%">
<?php foreach($n2 as $baris) {  ?>
	<tr valign=top>
    <td width="6" height="60"></td>
    <td width="175"><label>Kelompok Kompetensi</label></td>
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
    <select name="edit_guru" data-rel='chosen' class="form-control" id="edit_guru" required >
	<option value=""></option>
    </select>
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
	<input name="nilai_kuisioner" type="text" class="form-control"  id="nilai_kuisioner"  placeholder="Silahkan masukkan nilai kuisioner" required onkeypress="return hanyaangka(event)"/></div></div>  
    </td>
    <td></td>
	</tr>
	<tr valign="top">
    <td></td>
	<td><label>Berkas File Yang Akan Diupload</label><div>Nama File Akan Otomatis Diganti</div></td>
	<td>:</td>
	<td>
	<div id="preview-container">
    <button id="upload-dialog" class="btn btn-info btn-elevate2 btn-elevate-air2"><i class="fa fa-file-pdf"></i>Pilih Berkas File PDF Yang Akan Di Upload</button>
    <input type="file" id="pdf-file" name="pdf" accept="application/pdf" />
    <div id="pdf-loader">Memuat Tampilan ...</div>
	<div id="pdf-contents">
		<div id="pdf-meta">
			<div id="pdf-buttons">
				<button id="pdf-prev" class="btn btn-info btn-elevate2 btn-elevate-air2"><i class="fa fa-arrow-circle-left"></i> Sebelumnya</button>
				<button id="pdf-next" class="btn btn-info btn-elevate2 btn-elevate-air2">Selanjutnya <i class="fa fa-arrow-circle-right"></i></button>
				<button id="cancel-pdf" class="btn btn-dark btn-elevate2 btn-elevate-air2"><i class="fa fa-trash-alt"></i> Batalkan Berkas</button>
			</div>
			<div id="page-count-container">Halaman <div id="pdf-current-page"></div> dari <div id="pdf-total-pages"></div></div>
		</div>
    <canvas id="pdf-preview" width="300" height="350"></canvas>
    <span id="pdf-name"></span> 
	<div id="page-loader">Memuat Halaman ...</div>
</div>
	</td>
	<td></td>
</tr>
	<tr>
    <td></td>
	<td></td>
	<td></td>
	<td style="display:none">
	<input name="editid_kuisioner" id="editid_kuisioner" type="text" readonly value="<?php echo $baris->id_kuisioner; ?>" />
    <input name="editkelompok_kompetensi2" id="editkelompok_kompetensi2" type="text" readonly value="<?php echo $baris->id_kelompok_kuisioner_sd;?>" />
	</td>
	<td></td>
</tr>
  <?php } ?>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_file"><i class="la la-plus"></i> Tambah Nilai Kuisioner</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
 var __PDF_DOC,
	__CURRENT_PAGE,
	__TOTAL_PAGES,
	__PAGE_RENDERING_IN_PROGRESS = 0,
	__CANVAS = $('#pdf-preview').get(0),
	__CANVAS_CTX = __CANVAS.getContext('2d'),
	_OBJECT_URL;

function showPDF(pdf_url) {
	$("#pdf-loader").show();

	PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
		__PDF_DOC = pdf_doc;
		__TOTAL_PAGES = __PDF_DOC.numPages;
		
		// Hide the pdf loader and show pdf container in HTML
		$("#pdf-loader").hide();
		$("#pdf-contents").show();
		$("#pdf-total-pages").text(__TOTAL_PAGES);

		// Show the first page
		showPage(1);
	}).catch(function(error) {
		// If error re-show the upload button
		$("#pdf-loader").hide();
		$("#upload-button").show();
		
		alert(error.message);
	});;
}

function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	// Disable Prev & Next buttons while page is being loaded
	$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

	// While page is being rendered hide the canvas and show a loading message
	$("#pdf-preview").hide();
	$("#page-loader").show();

	// Update current page in HTML
	$("#pdf-current-page").text(page_no);
	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;

		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);

		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;

			// Re-enable Prev & Next buttons
			$("#pdf-next, #pdf-prev").removeAttr('disabled');

			// Show the canvas and hide the page loader
			$("#pdf-preview").show();
			$("#page-loader").hide();
		});
	});
}

// Previous page of the PDF
$("#pdf-prev").on('click', function(event, data) {
	$('html, body, .modal-body').stop();
	event.preventDefault();
	if(__CURRENT_PAGE != 1)
		showPage(--__CURRENT_PAGE);
	return false;
});

// Next page of the PDF
$("#pdf-next").on('click', function(event, data) {
	$('html, body, .modal-body').stop();
	event.preventDefault();
	if(__CURRENT_PAGE != __TOTAL_PAGES)
		showPage(++__CURRENT_PAGE);
		return false;
});

/* Show Select File dialog */
document.querySelector("#upload-dialog").addEventListener('click', function(event) {
    document.querySelector("#pdf-file").click();
	event.preventDefault();
});
/* Selected File has changed */
document.querySelector("#pdf-file").addEventListener('change', function(event) {
	event.preventDefault();
    // user selected file
    var file = this.files[0];
    // allowed MIME types
    var mime_types = [ 'application/pdf' ]; 
    // Validate whether PDF
    if(mime_types.indexOf(file.type) == -1) {
        maksimumbesarfilepdf();
		event.target.value = null;
        return;
    }
    // validate file size
    if(file.size > 1.5*1024*1024) {
		maksimumbesarfilepdf();
		event.target.value = null;
        return;
    }
    // validation is successful
    // hide upload dialog button
    document.querySelector("#upload-dialog").style.display = 'none';
    // set name of the file
    document.querySelector("#pdf-name").innerText = "Nama File : "+file.name;
    document.querySelector("#pdf-name").style.display = 'inline';
    // show cancel and upload buttons now
    document.querySelector("#cancel-pdf").style.display = 'inline';
    //document.querySelector("#upload-button").style.display = 'inline-block';
    // Show the PDF preview loader
    document.querySelector("#pdf-loader").style.display = 'inline-block';
    // object url of PDF 
    _OBJECT_URL = URL.createObjectURL(file)

    // send the object url of the pdf to the PDF preview function
	showPDF(_OBJECT_URL);
	//console.log(document.querySelector("#pdf-file").value);
});

/* Reset file input */
document.querySelector("#cancel-pdf").addEventListener('click', function(event) {
	event.preventDefault();
    // show upload dialog button
    document.querySelector("#upload-dialog").style.display = 'inline-block';
    // reset to no selection
    document.querySelector("#pdf-file").value = '';
    // hide elements that are not required
    document.querySelector("#pdf-name").style.display = 'none';
    document.querySelector("#pdf-preview").style.display = 'none';
    document.querySelector("#pdf-loader").style.display = 'none';
	document.querySelector("#pdf-contents").style.display = 'none';
    document.querySelector("#cancel-pdf").style.display = 'none';
	//event.target.value = null;
	//console.log(document.querySelector("#pdf-file").value);
});

 $(function() {
	$(document).on('click', "button#submit_file", function(){
		$('#form_upload_file').validate({
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
		if (document.querySelector("#pdf-file").value === "") {
			pilihsalahsatufilepdf();
		} else {
		if ($('form.form_upload_file').valid() && document.querySelector("#pdf-file").value !== "") {
			var databaru = new FormData($('#form_upload_file')[0]); 
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
			url: "<?php echo base_url().FOLDER_SD;?>kuisioner/aksiuploadfilekuisioner",
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
					$('#upload_file').modal('hide');
					$('#upload_file').on('hidden.bs.modal', function(){
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
