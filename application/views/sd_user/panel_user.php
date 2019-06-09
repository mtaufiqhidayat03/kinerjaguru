
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
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item  <?php if ($this->uri->segment(1)=="home") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url();?>home" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon-presentation"></i></span><span class="kt-menu__link-text">Beranda</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="pribadi") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>pribadi" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon2-user"></i></span><span class="kt-menu__link-text">Data Pribadi</span></a>
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
				<?php if ($this->session->userdata("level")=="Kepsek") { ?>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="assesor") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>assesor" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-users-cog"></i></span><span class="kt-menu__link-text">Pengaturan Assessor</span></a>
                        </li>
				</ul>
				<?php } ?>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kinerja") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kinerja" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="flaticon2-checking"></i></span><span class="kt-menu__link-text">Penilaian Kinerja</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kuisioneruser") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kuisioneruser" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-thumbtack"></i></span><span class="kt-menu__link-text">Penilaian Kuisioner</span></a>
                        </li>
				</ul>
				<?php 
				$nuptk = $this->session->userdata("username");
				$queryku = $this->db->get_where(D_ASSESOR_SD.$this->session->userdata('tahun'), array('nuptk_assesor' => $nuptk));
				if ($queryku->num_rows() > 0) {
				?>
				<ul class="kt-menu__nav ">
				<li class="kt-menu__section ">
					<h4 class="kt-menu__section-text">Halaman Assesor</h4>
				</li>
				</ul>
				
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kinerjadinilai") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kinerjadinilai" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-tachometer-alt"></i></span><span class="kt-menu__link-text">Persetujuan Penilaian Kinerja Guru</span></a>
                        </li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="kuisionerdinilai") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>kuisionerdinilai" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-th-list"></i></span><span class="kt-menu__link-text">Persetujuan Penilaian Kuisioner Guru</span></a>
                        </li>
				</ul>
				<?php } ?>
				<ul class="kt-menu__nav ">
				<li class="kt-menu__section ">
					<h4 class="kt-menu__section-text">Halaman Print</h4>
				</li>
				</ul>
				<ul class="kt-menu__nav ">
                        <li class="kt-menu__item <?php if ($this->uri->segment(2)=="cetakkinerja") { echo 'kt-menu__item--active'; }?>" aria-haspopup="true"><a href="<?php echo base_url().FOLDER_SD_USER;?>cetakkinerja" class="kt-menu__link "><span class="kt-menu__link-icon"><i class="fa fa-file-pdf"></i></span><span class="kt-menu__link-text">Cetak Penilaian Kinerja</span></a>
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
