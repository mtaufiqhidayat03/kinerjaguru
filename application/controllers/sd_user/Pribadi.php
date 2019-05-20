<?php
class Pribadi extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model(FOLDER_SD_USER.'m_pribadiuser');   
        
	}

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
			$nuptk = $this->session->userdata('username');
			$data['n2'] = $this->m_pribadiuser->cekdata($nuptk);
            $this->load->view(FOLDER_SD_USER.'datapribadi', $data);
        }
    }
}
?>