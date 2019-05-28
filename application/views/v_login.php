<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
	<meta charset="utf-8" />
	<title>Penilaian Kinerja Guru v.1 - Halaman Login</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<script src="<?php echo base_url();?>assets/demo/base/webfont.js"></script>
	<script>
		WebFont.load({
			active: function () {
				sessionStorage.fonts = true;
			}
		});

	</script>
	<!--end::Fonts -->
	<link
		href="<?php echo base_url();?>assets/demo/base/css.css?family=Poppins:300,400,500,600,700%7CRoboto:300,400,500,600,700"
		rel="stylesheet" type="text/css" />
	<!--begin::Page Custom Styles(used by this page) -->
	<!-- <link href="<?php echo base_url();?>min/g=csslogin" rel="stylesheet" type="text/css" /> -->
	<link href="<?php echo base_url();?>assets/app/custom/login/login-v3.default.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/demo/default/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/demo/default/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/demo/default/skins/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/demo/default/skins/aside/dark.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/media/img/tutwuri.png" />
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body
	class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
	<!-- begin::Page loader -->
	<div class="kt-page-loader kt-page-loader--base">
		<div class="blockui">
			<span>Sedang Memproses...</span>
			<span>
				<div class="kt-spinner kt-spinner--brand"></div>
			</span>
		</div>
	</div>

	<!-- end::Page Loader -->
	<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
				style="background-image: url(<?php echo base_url();?>assets/media/bg/bg-3.jpg);">
				<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
					<div class="kt-login__container">
						<div class="kt-login__logo">
							<a href="#">
								<img src="<?php echo base_url();?>assets/media/img/disdiksolo.jpg" width=200 height=120>
							</a>

						</div>
						<div class="kt-login__signin">
							<div class="kt-login__head">
								<h3 class="kt-login__title">Penilaian Kinerja Guru <small>v.1</small></h3>
							</div>
							<form class="kt-form" action="<?php echo base_url('login/aksi_login'); ?>" method="post">
								<div class="form-group row">
									<label class="col-form-label col-lg-2">
										<h5><b>Username</b></h5>
									</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<div class="kt-input-icon kt-input-icon--left">
											<input type="text" class="form-control" name="username"
												placeholder="Silahkan masukkan NUPTK anda sebagai username" required>
											<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i
														class="la la-keyboard-o"></i></span></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-2">
										<h5><b>Password</b></h5>
									</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<div class="kt-input-icon kt-input-icon--left">
											<input type="password" class="form-control" name="password"
												placeholder="Silahkan masukkan password anda" required>
											<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i
														class="la la-keyboard-o"></i></span></span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-2">
										<h5><b>Tahun</b></h5>
									</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
											<div class="kt-input-icon kt-input-icon--left">
												<select name="tahun" data-rel='chosen' class="form-control" id="tahun" required>
													<option value="">Silahkan pilih tahun yang tersedia</option>
													<?php foreach ($tahun as $row) { ?>
													<option value="<?php echo $row->id_tahun; ?>">
														<?php echo $row->tahun; ?></option>
													<?php } ?>
												</select>
												<span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i
															class="la la-keyboard-o"></i></span></span>
											</div>
										
									</div>
								</div>
								<div class="kt-login__actions">
									<button id="kt_login_signin_submit"
										class="btn btn-brand btn-elevate kt-login__btn-primary"><i class="fa fa-laptop-code"></i> Masuk ke dalam
										Sistem</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Page -->
	<!--begin:: Global Mandatory Vendors -->
	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {
			"colors": {
				"state": {
					"brand": "#5d78ff",
					"dark": "#282a3c",
					"light": "#ffffff",
					"primary": "#5867dd",
					"success": "#34bfa3",
					"info": "#36a3f7",
					"warning": "#ffb822",
					"danger": "#fd3995"
				},
				"base": {
					"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
					"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
				}
			}
		};

	</script>
	<!-- end::Global Config -->
	<!--begin::Global Theme Bundle(used by all pages) -->
	<!-- <script src="<?php //echo base_url();?>min/g=jslogin" type="text/javascript"></script> -->
	<script src="<?php echo base_url();?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/app/custom/login/login-general.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/vendors/custom/localization/messages_id.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/app/bundle/app.bundle.js" type="text/javascript"></script>
	<!-- end::Page Loader -->
	<!--end::Page Scripts -->
	<?php if(isset($_GET['module']) && $_GET['module'] == 'logout' )  { ?>
 	<script type="text/javascript">
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "positionClass": "toast-top-center",
  "onclick": null,
  "preventDuplicates" :true,
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
  toastr.info("Anda telah berhasil keluar dari sistem. ", "Informasi")
  </script><?php } ?>
   	<script type="text/javascript">
  function selectPlaceholder(selectID){
    var selected = $(selectID + ' option:selected');
    var val = selected.val();
    $(selectID + ' option' ).css('color', '#000');
    selected.css('color', '#a7abc3');
        if (val == "") {
          $(selectID).css('color', '#a7abc3');
        };
    $(selectID).change(function(){
          var val = $(selectID + ' option:selected' ).val();
          if (val == "") {
            $(selectID).css('color', '#a7abc3');
          }else{
            $(selectID).css('color', '#000');
          };
    });
};
selectPlaceholder("#tahun");
</script>
</body>

<!-- end::Body -->

</html>
