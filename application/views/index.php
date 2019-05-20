<div class="kt-grid kt-grid--hor kt-grid--root">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h4><i class="flaticon-presentation" style="padding-right:5px"></i>  Beranda </h4>
            </div>
        </div>
        <!-- end:: Subheader -->
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__body">
                            <h5>Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></h5>
							<h5>Silahkan pilih tombol yang tersedia dibawah ini :</h5><br/>
							<div class="row" style="min-height:400px;">
                			<div class="col-md-6">
							<a href="<?php echo base_url();?>sd/home" class="btn btn-warning btn-lg btn-elevate btn-elevate-air" style="padding:3rem 3rem !important;font-size: 1.5rem !important;"><i class="la la-bank"></i>SEKOLAH DASAR (SD)</a>
							</div> 
							<div class="col-md-6">
							<a href="<?php echo base_url();?>smp/home" class="btn btn-info btn-lg btn-elevate btn-elevate-air" style="padding:3rem 3rem !important;font-size: 1.5rem !important;"><i class="la la-bank"></i>SEKOLAH MENENGAH PERTAMA (SMP)</a>
							</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
</div>
</div>
