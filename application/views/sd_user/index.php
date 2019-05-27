<?php 
$this->load->view("header.php" ); 
$this->load->view(FOLDER_SD_USER.'panel_user.php');
?>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Subheader -->
        <!--  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h4><i class="flaticon-presentation" style="padding-right:5px"></i>  Beranda </h4>
            </div>
        </div> -->
        <!-- end:: Subheader -->
        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--tab">
                        <div class="kt-portlet__body">
                            <h3>Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></h3>
							<h4>Silahkan pilih menu yang tersedia yang terletak di sebelah kanan. Atau gunakan shortcut dibawah ini :</h4><br/>
							<div class="row" style="min-height:150px;">
                			<div class="col-sm">
							<a href="<?php echo base_url();?>sd_user/pribadi" class="btn btn-dark btn-lg btn-elevate btn-elevate-air"><i class="flaticon2-user"></i>Data Pribadi</a>
							</div>
							<div class="col-sm">
							<a href="<?php echo base_url();?>sd_user/sekolah" class="btn btn-warning btn-lg btn-elevate btn-elevate-air"><i class="la la-bank"></i>Data Sekolah</a>
							</div> 
							<div class="col-sm">
							<a href="<?php echo base_url();?>sd_user/guru" class="btn btn-success btn-lg btn-elevate btn-elevate-air"><i class="fa flaticon-users-1"></i>Data Guru</a>
							</div>
							<?php if ($this->session->userdata('level') == 'Kepsek') { ?>							
							<div class="col-sm">
							<a href="<?php echo base_url();?>sd_user/assesor" class="btn btn-info btn-lg btn-elevate btn-elevate-air"><i class="fa fa-users-cog"></i>Pengaturan Assesor</a>
							</div>
							<?php } else { ?>	
							<div class="col-sm">
							</div>
							<?php } ?>							
							</div>
							<div class="row" style="min-height:150px;">
                			<div class="col-sm">
							<a href="<?php echo base_url();?>sd_user/kinerja" class="btn btn-brand btn-lg btn-elevate btn-elevate-air"><i class="flaticon2-checking"></i>Penilaian Kinerja</a>
							</div>
							<div class="col-sm">
							<a href="<?php echo base_url();?>sd_user/kuisioneruser" class="btn btn-danger btn-lg btn-elevate btn-elevate-air"><i class="fa fa-thumbtack"></i>Penilaian Kuisioner</a>
							</div>
							<div class="col-sm">
							</div>
							<div class="col-sm">
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
<!--
<script src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( "beranda", {
        filebrowserBrowseUrl: 'kcfinder/browse.php?type=files',
        filebrowserImageBrowseUrl: 'kcfinder/browse.php?type=images',
        filebrowserFlashBrowseUrl: 'kcfinder/browse.php?type=flash',
        filebrowserUploadUrl: 'kcfinder/upload.php?type=files',
        filebrowserImageUploadUrl: 'kcfinder/upload.php?type=images',
        filebrowserFlashUploadUrl: 'kcfinder/upload.php?type=flash',
        baseFloatZIndex: 30000,
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        toolbarCanCollapse: true,
        height: '200px',
        allowedContent: true,
        pasteFromWordRemoveFontStyles: false,
        pasteFromWordRemoveStyles: false,
        forcePasteAsPlainText: false, // default so content won't be manipulated on load
        basicEntities: false,
        entities: false,
        entities_latin: false,
        entities_greek: false,
        entities_processNumerical: false,
    } );
    CKEDITOR.plugins.registered[ 'save' ] = {
        init: function ( editor ) {
            var command = editor.addCommand( 'save', {
                modes: {
                    wysiwyg: 1,
                    source: 1
                },
                exec: function ( editor ) { // Add here custom function for the save button
                    $.ajax( {
                        xhr: function () {
                            var browser = navigator.appName;
                            if ( browser == "Microsoft Internet Explorer" ) {
                                var xhr = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                            } else {
                                var xhr = new window.XMLHttpRequest();
                            }
                            xhr.upload.addEventListener( "progress", function ( evt ) {
                                if ( evt.lengthComputable ) {
                                    var percentComplete = ( evt.loaded / evt.total ) * 100;
                                }
                            }, false );
                            xhr.addEventListener( "progress", function ( evt ) {
                                if ( evt.lengthComputable ) {
                                    var percentComplete = ( evt.loaded / evt.total ) * 100;
                                }
                            }, false );
                            return xhr;
                        },
                        async: true,
                        type: "POST",
                        data: {
                            data: editor.document.getBody().getHtml(),
                            referrer: "index"
                        },
                        url: "<?php echo base_url();?>Home/inputteks",
                        beforeSend: function () {},
                        success: function ( data ) {
                            if ( data !== "" ) {
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
                                    "showMethod": "slideDown",
                                    "hideMethod": "slideUp"
                                }
                                toastr.error( data, "Kesalahan" );
                            } else {
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
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                toastr.success( "<br/><b>Data telah berhasil disimpan</b>", "Informasi" );
                            }
                        },
                        complete: function () {
                            // window.setTimeout(function(){App.unblockUI();}, 100);  
                        },
                        error: function () {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-bottom-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.error( "<br/><b>Data gagal untuk disimpan</b>", "Kesalahan" );
                        }
                    } );
                }
            } );
            editor.ui.addButton( 'Save', {
                label: 'Save',
                command: 'save'
            } );
        }
    }
</script> -->
<?php 
$this->load->view("footer.php" ); ?>
