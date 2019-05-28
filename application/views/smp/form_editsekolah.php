<?php if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { ?>
<script type='text/javascript'>
function createRequestObject()
{
var ro;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer")
{
ro = new ActiveXObject("Microsoft.XMLHTTP");
}
else
{
ro = new XMLHttpRequest();
}
return ro;
}

var xmlhttp_ = createRequestObject();
var xmlhttp2_ = createRequestObject();
var xmlhttp3_ = createRequestObject();
var xmlhttp4_ = createRequestObject();
function rubah_()
{
var opt = $('#nama_provinsi').find(':selected');
var prov = opt.val();
if (!prov) return;
xmlhttp_.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatakotakab?nama_provinsi='+prov, true);

xmlhttp_.onreadystatechange = function()
{
if ((xmlhttp_.readyState == 4) && (xmlhttp_.status == 200))
document.getElementById("editnama_kota_kab").innerHTML = xmlhttp_.responseText;
document.getElementById("editnama_kecamatan").innerHTML = '<option value="">Silahkan pilih kota/kabupaten terlebih dahulu</option>';
document.getElementById("editnama_kelurahan").innerHTML = '<option value="">Silahkan pilih kecamatan terlebih dahulu</option>';
return false;
}
xmlhttp_.send(null);

}
function rubah2_()
{
var opt = $('#editnama_provinsi').find(':selected');
var prov = opt.val();
var opt2 = $('#editnama_kota_kab').find(':selected');
var kotakab = opt2.val();
if (!prov && !kotakab) return;
xmlhttp2_.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatakecamatan?nama_kotakab='+kotakab+'&nama_provinsi='+prov, true);

xmlhttp2_.onreadystatechange = function()
{
if ((xmlhttp2_.readyState == 4) && (xmlhttp2_.status == 200))
document.getElementById("editnama_kecamatan").innerHTML = xmlhttp2_.responseText;
document.getElementById("editnama_kelurahan").innerHTML = '<option value="">Silahkan pilih kecamatan terlebih dahulu</option>';
return false;
}
xmlhttp2_.send(null);
}
function rubah3_()
{
var opt = $('#editnama_provinsi').find(':selected');
var prov = opt.val();
var opt2 = $('#editnama_kota_kab').find(':selected');
var kotakab = opt2.val();
var opt3 = $('#editnama_kecamatan').find(':selected');
var kec = opt3.val();
if (!prov && !kec && !kotakab) return;
xmlhttp3_.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatakelurahan?nama_kec='+kec+'&nama_kotakab='+kotakab+'&nama_provinsi='+prov, true);

xmlhttp3_.onreadystatechange = function()
{
if ((xmlhttp3_.readyState == 4) && (xmlhttp3_.status == 200))
document.getElementById("editnama_kelurahan").innerHTML = xmlhttp3_.responseText;
return false;
}
xmlhttp3_.send(null);
}
function rubah4_()
{
var opt = $('#editnama_provinsi').find(':selected');
var prov = opt.val();
var opt2 = $('#editnama_kota_kab').find(':selected');
var kotakab = opt2.val();
var opt3 = $('#editnama_kecamatan').find(':selected');
var kec = opt3.val();
var opt4 = $('#editnama_kelurahan').find(':selected');
var kel = opt4.val();
if (!prov && !kel && !kec && !kotakab) return;
xmlhttp4_.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatanodaerah?nama_desa_kel='+kel+'&nama_kec='+kec+'&nama_kotakab='+kotakab+'&nama_provinsi='+prov, true);

xmlhttp4_.onreadystatechange = function()
{
if ((xmlhttp4_.readyState == 4) && (xmlhttp4_.status == 200))
document.getElementById("no_daerah").value = xmlhttp4_.responseText;
return false;
}
xmlhttp4_.send(null);
}
</script>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Data</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_edit_data" class="form_edit_data" enctype="multipart/form-data" >
<table width="100%" height="100%">
<?php foreach($n2 as $baris) {  ?>
	<tr valign="top">
    <td width="11" height="70"></td>
    <td width="211"><label>NPSN/NSS</label><br/></td>
    <td width="20">:</td>
    <td width="380">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="npsn_nss" class="form-control" id="npsn_nss" type="text" required readonly placeholder="Masukkan NPSN/NSS" value="<?php echo $baris->npsn_nss;?>"/>
	</div></div>
	</td>
    <td width="27"></td>
  	</tr>
  	<tr valign="top">
    <td height="70"></td>
    <td><label>Nama Sekolah</label></td>
    <td>:</td>
		<td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="nama_sekolah" id="nama_sekolah" type="text" size = "40" required autofocus class="form-control" placeholder="Masukkan nama sekolah" value="<?php echo $baris->nama_sekolah;?>"></div></div></td>
    <td></td>
  </tr>
<tr valign="top">
   <td height="60">&nbsp;</td>
    <td valign="top"><label>Provinsi</label></td>
    <td valign="top">:</td>
    <td valign="top">
    <div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="editnama_provinsi" data-rel='chosen'  class="form-control" id="editnama_provinsi" required onChange="javascript:rubah_(this)" >
    <option value="">Silahkan pilih provinsi di bawah ini</option>
    <?php foreach ($n1 as $row) {  ?>
    <option value="<?php echo $row->nama_provinsi; ?>" <?php if ($baris->nama_provinsi == $row->nama_provinsi) {echo "selected=selected";}?>><?php echo $row->nama_provinsi; ?></option>
    <?php }?>
    </select>
		</div>
		</div>   
    </td>
    <td></td>
	</tr>
	<tr valign="top">
   <td height="70">&nbsp;</td>
    <td><label>Kabupaten/Kota</label></td>
    <td>:</td>
    <td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="editnama_kota_kab" data-rel='chosen'  class="form-control" id="editnama_kota_kab" required onChange="javascript:rubah2_(this)">
    <option value="">Silahkan pilih kota/kabupaten di bawah ini</option>
    <?php foreach ($kabkota as $row) {  ?>
    <option value="<?php echo $row->nama_kota_kab; ?>" <?php if ($baris->nama_kota_kab == $row->nama_kota_kab) {echo "selected=selected";}?>><?php echo $row->nama_kota_kab; ?></option>
    <?php } ?>
    </select>
    </div></div>
  </td>
  <td></td>
  </tr>
    <tr valign="top">
   <td height="70">&nbsp;</td>
    <td valign="top"><label>Kecamatan</label></td>
    <td valign="top">:</td>
    <td valign="top">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="editnama_kecamatan" data-rel='chosen'  class="form-control" id="editnama_kecamatan" required onChange="javascript:rubah3_(this)" >
    <option value="">Silahkan pilih kota/kabupaten di bawah ini</option>
    <?php foreach ($kec as $row) {  ?>
    <option value="<?php echo $row->nama_kec; ?>" <?php if ($baris->nama_kec == $row->nama_kec) {echo "selected=selected";}?>><?php echo $row->nama_kec; ?></option>
    <?php } ?>
    </select>
    </div></div>
    </td>
    <td></td>
	</tr>
	<tr valign="top">
   <td height="70">&nbsp;</td>
    <td><label>Kelurahan/Desa</label></td>
    <td>:</td>
    <td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <select name="editnama_kelurahan" data-rel='chosen'  class="form-control" id="editnama_kelurahan" required onChange="javascript:rubah4_(this)">
    <option value="">Silahkan pilih kecamatan di bawah ini</option>
    <?php foreach ($kel as $row) {  ?>
    <option value="<?php echo $row->nama_desa_kel; ?>" <?php if ($baris->nama_desa_kel == $row->nama_desa_kel) {echo "selected=selected";}?>><?php echo $row->nama_desa_kel; ?></option>
    <?php } ?>
    </select>
    </div></div>
  </td>
  <td></td>
  </tr>
  <tr valign="top">
   <td height="60">&nbsp;</td>
    <td valign="top"><label>No. Telepon/Fax</label></td>
    <td valign="top">:</td>
    <td valign="top">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
		<input name="telp_fax" type="text"  required class="form-control"  id="telp_fax"  placeholder="Silahkan masukkan no telepon/fax" value="<?php echo $baris->telp_fax;?>"/>
		</div></div>   
		<div style="display:none"><input name="no_daerah" type="text" id="no_daerah" value="<?php echo $baris->no_daerah;?>"/></div>  
    </td>
    <td></td>
  </tr>
  <?php } ?>
</table>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-info btn-elevate2 btn-elevate-air2" id="submit_edit"><i class="fa fa-pen"></i> Edit Data</button>
<button type="button" class="btn btn-danger btn-elevate2 btn-elevate-air2" data-dismiss="modal"><i class="fa fa-power-off"></i> Tutup</button>
</div>
<script>
$.fn.modal.Constructor.prototype._enforceFocus = function() {};
$('body').on('hidden.bs.modal', '.modal', function () {
    $(this).removeData('bs.modal');
});

$('.modal').on('shown.bs.modal', function() {
	$(this).find('[autofocus]').focus();
	KTSelectedit.init();
});

 $(function() {
	$("select").on("select2:close", function (e) {  
	$(this).valid(); 
	});
 });
 $(function() {
	$(document).on('click', "button#submit_edit", function(){
		$('#form_edit_data').validate({
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
		if ($('form.form_edit_data').valid()) {
			var databaru = new FormData($('#form_edit_data')[0]); 
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
			url: "<?php echo base_url().FOLDER_SMP;?>sekolah/aksieditsekolah",
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
					$('#edit_data').modal('hide');
					$('#edit_data').on('hidden.bs.modal', function(){
					$("input:checked").parent().removeClass("checked").find("span").html("");
					//$('#keaktifan').find('option').remove().end().append('<option value="">Pilih keaktifan sekolah</option>');
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
