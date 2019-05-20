<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>Penilaian Kinerja Guru v 1.0</title>
    <meta name="description" content="Penilaian Kinerja Guru v 1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Fonts -->
	<!-- <script src="<?php echo base_url();?>min/g=jsfont"></script> -->
    <script src="<?php echo base_url();?>assets/demo/base/webfont.js"></script>
    <script>
        WebFont.load( {
            active: function () {
                sessionStorage.fonts = true;
            }
        } );
	</script>
	
	<!--end::Fonts -->
	<!-- <link href="<?php // echo base_url();?>min/g=css" rel="stylesheet" type="text/css"> -->
	
	<link href="<?php echo base_url();?>assets/demo/base/css.css?family=Poppins:300,400,500,600,700%7CRoboto:300,400,500,600,700" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="<?php echo base_url();?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles -->
    <!--begin::Layout Skins(used by all pages) -->
    <link href="<?php echo base_url();?>assets/demo/default/skins/header/base/light.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/demo/default/skins/header/menu/light.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/demo/default/skins/brand/dark.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/demo/default/skins/aside/light.css" rel="stylesheet" type="text/css"/>
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/media/img/tutwuri.png"/>
    <!-- </head> -->
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-page--loading-enabled kt-header--static kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--static kt-page--loading">
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

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">

        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <!-- begin:: Header -->
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--static ">
        <div class="kt-header__topbar">
            <!--begin: User Bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper">
                    <div class="kt-header__topbar-user " style="background-color: rgba(0, 0, 0, 0); cursor: auto;">
                        <span class="kt-header__topbar-welcome kt-hidden-mobile" style="display: block">
                            Penilaian Kinerja Guru (PKG) <br/><small>versi 1.0</small></span>
                    </div>
                </div>
            </div>
        </div>
                        
        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">
            <!--begin: User Bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="kt-header__topbar-user">
                           <span class="kt-header__topbar-username kt-hidden-mobile">
						   <?php echo "Selamat Datang. ".$this->session->userdata['nama']; ?>
						   </span>
                           <img class="kt-hidden" alt="Pic" src="<?php echo base_url();?>assets/media/users/default.jpg"/>
                           <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><img class="" alt="Pic" src="<?php echo base_url();?>/assets/media/users/default.jpg"/></span>
                    </div>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                    <!--begin: Head -->
                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url();?>/assets/media/misc/bg-1.jpg)">
                        <div class="kt-user-card__avatar">
                            <img class="" alt="Pic" src="<?php echo base_url();?>/assets/media/users/default.jpg"/>

                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                            <!--<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span> -->
                        </div>
                        <div class="kt-user-card__name">
                            <?php echo $this->session->userdata['nama'];?>
                        </div>
                        <div class="kt-user-card__badge">
                            <!-- <span class="btn btn-success btn-sm btn-bold btn-font-md">
							<?php // echo substr($this->session->userdata['nama'], 0, 1);?></span> -->
                        </div>
                    </div>

                    <!--end: Head -->
                    <!--begin: Navigation -->
                    <div class="kt-notification">
                        <!-- <a href="#" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    Profil Saya
                                </div>
                                <div class="kt-notification__item-time">
                                    Konfigurasi akun dan lainnya
                                </div>
                            </div>
                        </a> -->
                        <div class="kt-notification__custom">
                            <a href="<?php echo base_url();?>login/form_logout" id="sample_logout" data-target="#mdl_logout" data-toggle="modal" class="btn btn-label-brand btn-sm btn-bold">Keluar dari sistem</a>
                        </div>
                    </div>

                    <!--end: Navigation -->
                </div>
            </div>
            <!--end: User Bar -->
        </div>

        <!-- end:: Header Topbar -->
    </div>

    <!-- end:: Header -->
