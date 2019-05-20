<?php
class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ( $this->session->userdata( 'status' ) != "login" && $this->session->userdata( 'username' ) == null && $this->session->userdata( "password" ) == null ) {
            redirect( base_url( "Login" ) );
        }
        $this->load->model('m_homeadmin');
        error_reporting( 0 );
    }
    function index() {
        if ($this->session->userdata('level') !== 'Guru') {
            $this->load->view('v_homeadmin');
        } else {
            if ($this->session->userdata('sekolah')=='SD') {
                $this->load->view(FOLDER_SD_USER.'index');
            } else if ($this->session->userdata('sekolah')=='SMP') {
                $this->load->view(FOLDER_SMP_USER.'index');
            } 
        }
    }
    function inputteks() {
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            $data = $this->input->post('data');
		    $referrer = $this->input->post('referrer');
            $result = $this->m_homeadmin->input_teks($data,$referrer);
            echo ($result);
        }
    }
}
?>
