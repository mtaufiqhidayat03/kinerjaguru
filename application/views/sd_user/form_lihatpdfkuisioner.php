<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<style>
.pdfobject-container { 
height: 40rem; 
/* border: 1rem solid rgba(0,0,0,.1); */
}
.modal .modal-content .modal-header .modal-title {
font-weight: normal !important;
font-size: 1.2rem !important;
}
</style>
<div class="modal-content">
<div class="modal-header">
<?php foreach ($n2 as $row) { ?>
<h5 class="modal-title">Lihat Berkas : <?php echo $row->nama_guru;?> Kuisioner : <?php echo $row->nama_kuisioner;?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
 <form action="" method="post" class="form_hapus_data" id="form_hapus_data">
 <table width="100%" border="0">
<tr valign=top>
	<td style="display:none">
	<input name="lokasifile" id="lokasifile" type="text" readonly value="<?php echo $row->upload_file_kuisioner_sd; ?>" />
	</td>
</tr>
<tr valign=top>
    <td>
	<div id="lihatfile"></div>
	</td>
</tr>
<?php } ?>
</table>		
</form>
</div></div>
<div class="modal-footer">
<label class="mr-auto">*) Matikan sofware download manager jika preview file PDF tidak jalan</label>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i>  Tutup</button>
</div>
<script>
 $(function() {
	$(document).on('click',"button#hapus_data",function(){
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
			data: $('form.form_hapus_data').serialize(),
			url: "<?php echo base_url().FOLDER_SD;?>hasilkuisioner/aksihapushasilkuisioner",
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
					var tabel = $(".dataTables").dataTable();
					tabel.fnClearTable(false); 
					var filter = tabel.fnPagingInfo().iFilteredTotal-1;
					var  jumlah = tabel.fnPagingInfo().iLength*tabel.fnPagingInfo().iPage;
					if ( filter <= jumlah) {
					if(tabel.fnPagingInfo().iPage == 0) {
					tabel.fnDraw();
					}
					else {
					var last = (tabel.fnPagingInfo().iPage-1);
					tabel.fnPageChange(last);
					}
					} else {
					tabel.fnStandingRedraw();	
					}
					berhasilhapus();
					$('#hapus_data').modal('hide');
					$('#hapus_data').on('hidden.bs.modal', function(){
   					 $(this).find('form')[0].reset();
					});
				 }	
 		        },
				complete: function(){
					unblockPageUI();
				},
			   error: function(){ 
   				gagalhapus();
				}				
      			});
	});
});
</script>
<?php } ?>
