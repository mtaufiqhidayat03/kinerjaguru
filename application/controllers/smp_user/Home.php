<?php
class Home extends CI_Controller {

    function __construct() {
		parent::__construct();
		
        $this->load->model(FOLDER_SMP_USER.'m_homesmp');
        //error_reporting( 0 );
    }
    function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
            $this->load->view(FOLDER_SMP_USER.'index');
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
