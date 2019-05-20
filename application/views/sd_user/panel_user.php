<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <!-- begin:: Aside -->
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        <div class="kt-aside  kt-aside--static  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
            <!-- begin:: Aside -->
            <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand" style="display: none">
                <div class="kt-aside__brand-logo">
                </div>
            </div>
            <!-- end:: Aside -->
            <!-- begin:: Aside Menu -->
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="0" data-ktmenu-dropdown-timeout="500">
				<?php if ($this->session->userdata('level') !== "") { ?>
				<h4 class="kt-menu__section-text" style="font-weight:800 !important;text-align:center">
				<?php if ($this->session->userdata("sekolah")== "SD" ) { echo "Sekolah Dasar (SD)";}?>
				</h4>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item  <?php if ($this->uri->segment(1)=="home") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url();?>home" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon-presentation"></i></span><span class="kt-menu__link-text">Beranda</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="sekolah") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>sekolah" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon-buildings"></i></span><span class="kt-menu__link-text">Data Sekolah</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="guru") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>guru" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon-users-1"></i></span><span class="kt-menu__link-text">Data Guru</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="assesor") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>assesor" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-users-cog"></i></span><span class="kt-menu__link-text">Pengaturan Assessor</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kelompok") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kelompok" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon-interface-6"></i></span><span class="kt-menu__link-text">Kelompok Kompetensi</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kompetensi") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kompetensi" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon2-layers-1"></i></span><span class="kt-menu__link-text">Kompetensi</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="indikator") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>indikator" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon2-checking"></i></span><span class="kt-menu__link-text">Indikator Kompetensi</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kuisioner") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kuisioner" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-thumbtack"></i></span><span class="kt-menu__link-text">Pengaturan Kuisioner</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="hasilkuisioner") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>hasilkuisioner" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-th-list"></i></span><span class="kt-menu__link-text">Hasil Kuisioner</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="penilaian") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>penilaian" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-tachometer-alt"></i></span><span class="kt-menu__link-text">Hasil Penilaian</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo base_url();?>Login/form_logout" class="kt-menu__link" id="sample_logout" data-target='#mdl_logout' data-toggle="modal"><span class="kt-menu__link-icon"><i class="flaticon-lock"></i></span><span class="kt-menu__link-text">Keluar Sistem</span></a>
                        </li>
		    	</ul>
                <?php } ?>       
                </div>
            </div>

            <!-- end:: Aside Menu -->
        </div>

        <!-- end:: Aside -->
