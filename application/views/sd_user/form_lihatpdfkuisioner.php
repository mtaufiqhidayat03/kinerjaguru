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
<?php } ?>
