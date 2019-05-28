<?php 
if ($this->session->userdata("username") && $this->session->userdata("id_user") ) { 
?>
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

var xmlhttp = createRequestObject();
var xmlhttp2 = createRequestObject();
var xmlhttp3 = createRequestObject();
var xmlhttp4 = createRequestObject();
function rubah()
{
var opt = $('#nama_provinsi').find(':selected');
var prov = opt.val();
if (!prov) return;
xmlhttp.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatakotakab?nama_provinsi='+prov, true);

xmlhttp.onreadystatechange = function()
{
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
document.getElementById("nama_kota_kab").innerHTML = xmlhttp.responseText;
return false;
}
xmlhttp.send(null);
}
function rubah2()
{
var opt = $('#nama_provinsi').find(':selected');
var prov = opt.val();
var opt2 = $('#nama_kota_kab').find(':selected');
var kotakab = opt2.val();
if (!prov && !kotakab) return;
xmlhttp2.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatakecamatan?nama_kotakab='+kotakab+'&nama_provinsi='+prov, true);

xmlhttp2.onreadystatechange = function()
{
if ((xmlhttp2.readyState == 4) && (xmlhttp2.status == 200))
document.getElementById("nama_kecamatan").innerHTML = xmlhttp2.responseText;
return false;
}
xmlhttp2.send(null);
}
function rubah3()
{
var opt = $('#nama_provinsi').find(':selected');
var prov = opt.val();
var opt2 = $('#nama_kota_kab').find(':selected');
var kotakab = opt2.val();
var opt3 = $('#nama_kecamatan').find(':selected');
var kec = opt3.val();
if (!prov && !kec && !kotakab) return;
xmlhttp3.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatakelurahan?nama_kec='+kec+'&nama_kotakab='+kotakab+'&nama_provinsi='+prov, true);

xmlhttp3.onreadystatechange = function()
{
if ((xmlhttp3.readyState == 4) && (xmlhttp3.status == 200))
document.getElementById("nama_kelurahan").innerHTML = xmlhttp3.responseText;
return false;
}
xmlhttp3.send(null);
}
function rubah4()
{
var opt = $('#nama_provinsi').find(':selected');
var prov = opt.val();
var opt2 = $('#nama_kota_kab').find(':selected');
var kotakab = opt2.val();
var opt3 = $('#nama_kecamatan').find(':selected');
var kec = opt3.val();
var opt4 = $('#nama_kelurahan').find(':selected');
var kel = opt4.val();
if (!prov && !kel && !kec && !kotakab) return;
xmlhttp4.open('get', '<?php echo base_url().FOLDER_SMP; ?>sekolah/ambildatanodaerah?nama_desa_kel='+kel+'&nama_kec='+kec+'&nama_kotakab='+kotakab+'&nama_provinsi='+prov, true);

xmlhttp4.onreadystatechange = function()
{
if ((xmlhttp4.readyState == 4) && (xmlhttp4.status == 200))
document.getElementById("no_daerah").value = xmlhttp4.responseText;
return false;
}
xmlhttp4.send(null);
}
</script>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Tambah Data</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="portlet-body">
<form action="" method="" id="form_tambah_data" class="form_tambah_data" enctype="multipart/form-data" novalidate="novalidate" >
<table width="100%" height="100%">
  <tr valign="top">
    <td width="11" height="70"></td>
    <td width="150"><label>NPSN/NSS</label></td>
    <td width="20">:</td>
		<td width="380">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<input name="npsn_nss" class="form-control" type="text" required autofocus placeholder="Masukkan NPSN/NSS" onkeypress="return hanyaangka(event)" />
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
   </div>
	</td>
	</tr>
	<tr valign="top">
    <td height="70"></td>
    <td><label>Nama Sekolah</label></td>
    <td>:</td>
		<td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
		<input name="nama_sekolah" id="nama_sekolah" type="text"  size = "40" required class="form-control" placeholder="Masukkan nama sekolah">
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
   </div>
	</td>
    <td width="11"></td>
  </tr>
<tr valign="top">
   <td height="60">&nbsp;</td>
    <td valign="top"><label>Provinsi</label></td>
    <td valign="top">:</td>
    <td valign="top">
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
    <select name="nama_provinsi" data-rel='chosen'  class="form-control m-select2" id="nama_provinsi" required onChange="javascript:rubah(this)" >
    <option value="">Silahkan pilih provinsi yang tersedia</option>
    <?php foreach ($n1 as $row) {  ?>
    <option value="<?php echo $row->nama_provinsi; ?>"><?php echo $row->nama_provinsi; ?></option>
    <?php }?>
    </select>
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
   </div> 
		</td>
		<td></td>
	</tr>
	<tr valign="top">
   <td height="60">&nbsp;</td>
    <td><label>Kabupaten/Kota</label></td>
    <td>:</td>
    <td>
		<div class="form-group row">
		<div class="kt-input-icon kt-input-icon--left">
    <select name="nama_kota_kab" data-rel='chosen'  class="form-control" id="nama_kota_kab" required onChange="javascript:rubah2(this)">
    <option value="">Silahkan pilih provinsi terlebih dahulu</option>
    </select>
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
   </div>
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
    <select name="nama_kecamatan" data-rel='chosen'  class="form-control" id="nama_kecamatan" required onChange="javascript:rubah3(this)" >
    <option value="">Silahkan pilih kota/kabupaten terlebih dahulu</option>
    </select>
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
   </div>  
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
    <select name="nama_kelurahan" data-rel='chosen'  class="form-control" id="nama_kelurahan" required onChange="javascript:rubah4(this)">
    <option value="">Silahkan pilih kecamatan terlebih dahulu</option>
    </select>
		<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
   </div>
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
		 <input name="telp_fax" type="text"  required class="form-control"  id="telp_fax"  placeholder="Silahkan masukkan no telepon/fax"/>
		 <span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	 </div>
	 </div>
	 <div style="visibility:hidden"><input name="no_daerah" type="text" id="no_daerah"/></div>  
    </td>
  </tr>
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
		if ($('form.form_tambah_data').valid()) {
			var databaru = new FormData($('#form_tambah_data')[0]); 
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
			url: "<?php echo base_url().FOLDER_SMP;?>sekolah/aksiaddsekolah",
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
			   error: function(data){ 
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
