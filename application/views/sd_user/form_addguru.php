<?php if ($this->session->userdata("username") && $this->session->userdata("id_user")) { ?>
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
    <td width="175"><label>NPSN/NSS</label></td>
    <td width="16">:</td>
    <td width="378">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="npsn_nss" readonly type="text" required class="form-control" id="npsn_nss" placeholder="Silahkan masukkan NPSN/NSS Sekolah" value="<?php foreach($n2 as $baris) { echo $baris->npsn_nss_sd; }?>"></div></div>
	</td>
  </tr>
  <tr valign=top>
    <td width="6" height="60"></td>
    <td width="175"><label>NUPTK</label></td>
    <td width="16">:</td>
    <td width="378">
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="nuptk" autofocus type="text" required class="form-control" id="nuptk" placeholder="Silahkan masukkan NUPTK" onkeypress="return hanyaangka(event)"></div></div>
	</td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Nama</label></td>
    <td>:</td>
	<td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="nama" type="text"  required class="form-control"  id="nama"  placeholder="Silahkan masukkan nama Guru"/></div></div>
	</td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>NIP</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="nip" type="text"  required class="form-control"  id="nip"  placeholder="Silahkan masukkan NIP" onkeypress="return hanyaangka(event)" /></div></div>
    </td>
  </tr>
  <tr valign=top>
    <td height="60"</td>
    <td><label>Karpeg</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="karpeg" type="text" required class="form-control"  id="karpeg"  placeholder="Silahkan masukkan Karpeg"/></div></div>
    </td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Tempat Lahir</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="tempat_lahir" type="text" required class="form-control"  id="tempat_lahir"  placeholder="Silahkan masukkan tempat lahir"/></div></div>
    </td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td>
    <label>Tanggal Lahir</label><br/><small>Format (YYYY-MM-DD)</small></td>
    <td>:</td>
    <td>
    <div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <input class="form-control input date-picker" name="tgl_lahir" type="text"  size = "40"  data-date-format="yyyy-mm-dd" id="tgl_lahir" required placeholder="Silahkan masukkan tanggal Lahir" />
    </div></div>
    </td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Pangkat / Jabatan / Gol.Ruang </label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
        <select name="pangkat_jabatan" data-rel='chosen'  class="form-control" required id="pangkat_jabatan" >
        <option value="">Pilih Golongan</option>
        <optgroup label="Golongan I">
        <option value="Juru Muda / I A">Juru Muda / I A</option>
        <option value="Juru Muda Tk.I / I B">Juru Muda Tk.I / I B</option>
        <option value="Juru / I C">Juru / I C</option>
        <option value="Juru Tk. I / I D">Juru Tk. I / I D</option>
        </optgroup>
        <optgroup label="Golongan II">
        <option value="Pengatur Muda / II A">Pengatur Muda / II A</option>
        <option value="Pengatur Muda Tk. I / II B">Pengatur Muda Tk. I / II B</option>
        <option value="Pengatur / II C">Pengatur / II C</option>
        <option value="Pengatur Tk. I / II D">Pengatur Tk. I / II D</option>
        </optgroup>
        <optgroup label="Golongan III">
        <option value="Penata Muda - Guru Pertama / III A">Penata Muda - Guru Pertama / III A</option>
        <option value="Penata Muda Tk.I - Guru Pertama / III B">Penata Muda Tk.I - Guru Pertama / III B</option>
        <option value="Penata - Guru Muda / III C">Penata - Guru Muda / III C</option>
        <option value="Penata Tk. I - Guru Muda / III D">Penata Tk. I - Guru Muda / III D</option>
        </optgroup>
        <optgroup label="Golongan IV">
        <option value="Pembina - Guru Madya / IV A">Pembina - Guru Madya / IV A</option>
        <option value="Pembina Tk. I - Guru Madya / IV B">Pembina Tk. I - Guru Madya / IV B</option>
        <option value="Pembina Utama Muda - Guru Madya / IV C">Pembina Utama Muda - Guru Madya / IV C</option>
        <option value="Pembina Utama Madya - Guru Utama / IV D">Pembina Utama Madya - Guru Utama / IV D</option>
        <option value="Pembina Utama - Guru Utama / IV E">Pembina Utama - Guru Utama / IV E</option>
        </optgroup>
      </select>
      </div></div></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td><label>Terhitung Mulai Tanggal (TMT)</label><br/><small>Format (YYYY-MM-DD)</small></td>
    <td>:</td>
    <td><div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
    <input class="form-control input date-picker2" name="tmt_guru" type="text"  size = "40"  data-date-format="yyyy-mm-dd" id="tmt_guru" required placeholder="Silahkan masukkan TMT Guru" />
    </div></div></td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td valign="top"><label>Jenis Kelamin</label></td>
    <td valign="top">:</td>
    <td>
    <div class="form-group row">
	<div class="kt-radio-list">    
    <label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="jenis_kelamin" value="Laki-laki" class="jenis_kelamin" required>Laki-laki<span></span></label>
    <label class="kt-radio kt-radio--bold kt-radio--dark"><input type="radio" name="jenis_kelamin" value="Perempuan" class="jenis_kelamin" required>Perempuan<span></span></label>
    </div>
    </div>
    </td>
  </tr>
  <tr valign=top>
    <td height="60"></td>
    <td>
    <label>Pendidikan Terakhir</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="pendidikan_terakhir" type="text" required class="form-control" id="pendidikan_terakhir"  placeholder="Silahkan masukkan pendidikan terakhir"/></div></div>
    </td>
  </tr>
  <tr valign=top>
 <td height="60"></td>
    <td><label>Program Keahlian</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="program_keahlian" type="text" required class="form-control" id="program_keahlian" placeholder="Silahkan masukkan program keahlian"/></div></div>
    </td>
  </tr>
  <tr valign=top>
 <td height="60"></td>
    <td><label>Password Login Sistem</label></td>
    <td>:</td>
    <td>
	<div class="form-group row">
	<div class="kt-input-icon kt-input-icon--left">
	<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-keyboard-o"></i></span></span>
	<input name="password" type="password" required class="form-control" id="password" placeholder="Silahkan masukkan password login sistem"/></div></div>
    </td>
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
	            $(element).closest('.form-group').addClass('has-error');
	            },
	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },
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
			url: "<?php echo base_url().FOLDER_SD_USER;?>guru/aksiaddguru",
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
                    $(this).data('bs.modal', null); 
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
