<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<style>
.pdfobject-container { 
height: -moz-calc(100vh - 130px);
height: -webkit-calc(100vh - 130px);
height: -o-calc(100vh - 130px);
height: calc(100vh - 130px);
height: expression(100vh - 130px); 
}
h5.modal-title.punyaku{
font-weight: normal !important;
font-size: 1.2rem !important;
}
</style>
<div class="modal-content">
<div class="modal-header">
<?php foreach ($n2 as $row) { ?>
<h5 class="modal-title punyaku">File Atas Nama : <?php foreach ($n1 as $row2) { echo $row2->nama_guru; }?>. Indikator : <?php echo $row->nama_indikator;?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<table width="100%" border="0">
<tr valign=top>
	<td style="display:none">
	<input name="lokasifile" id="lokasifile" type="text" readonly value="<?php echo $row->upload_file_penilaian_sd; ?>" />
	</td>
</tr>
<tr valign=top>
    <td>
	<div id="lihatfile"></div>
	</td>
</tr>
</table>		
</div></div>
<div class="modal-footer">
<!-- <label class="mr-auto">*) Matikan sofware download manager jika preview file PDF tidak jalan</label> -->
<!--<a data-toggle="modal" href="kinerja/form_gantifilekinerja?id_indikator=<?php echo $row->id_indikator; ?>&id_kelompok=<?php echo $row->id_kelompok; ?>&id_kompetensi=<?php echo $row->id_kompetensi; ?>" data-target="#upload_file2" class="btn btn-success btnku btn-elevate2 btn-elevate-air2 dismiss" id="dismiss" data-id="<?php echo $row->id_indikator; ?>"><i class='fa fa-pencil-alt'></i> Ganti Berkas Bukti Penilaian Kinerja</a> -->
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i>  Tutup</button>
</div>
<?php } ?>
<?php } ?>
