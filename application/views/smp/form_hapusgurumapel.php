<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Hapus Sebagai Guru Mata Pelajaran/Kelas</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
 <form action="" method="post" class="form_hapus_datagurumapel" id="form_hapus_datagurumapel">
 <table width="100%" border="0">
<?php foreach ($n1 as $row) { ?>
<tr>
<td width="2%"></td>
    <td width="92%"><h5>Apakah anda ingin menghapus <b> <?php echo $row->nama_guru; ?></b> untuk mengajar mata pelajaran/kelas di <b><?php foreach ($n2 as $row2) { echo $row2->nama_sekolah; }?></b> ?</h5></td>
    <td></td>
    </tr>
    <tr>
    <td colspan="3" style="display:none">
	<input name="nuptk" type="text"  readonly value="<?php echo $row->nuptk; ?>" />
    </td>
</tr>
<?php } ?>
</table>		
</form>
</div></div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" id="hapus_datagurumapel"><i class="fa fa-eraser"></i> Hapus Data </button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i>  Tutup</button>
</div>
<script>
 $(function() {
	$(document).on('click',"button#hapus_datagurumapel",function(){
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
				data: $('form.form_hapus_datagurumapel').serialize(),
				url: "<?php echo base_url().FOLDER_SMP;?>guru/aksihapusgurusekolahmapel",
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
					var tabel = $(".dataTables").dataTable();
					tabel.fnClearTable(false); 
					var filter = tabel.fnPagingInfo().iFilteredTotal-1;
					var jumlah = tabel.fnPagingInfo().iLength*tabel.fnPagingInfo().iPage;
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
					$('#hapusguru_sekolahmapel').modal('hide');
					$('#hapusguru_sekolahmapel').on('hidden.bs.modal', function(){
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
