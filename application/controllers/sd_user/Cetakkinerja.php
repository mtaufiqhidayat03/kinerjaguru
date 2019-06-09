<?php
class Cetakkinerja extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model(FOLDER_SD_USER.'m_cetakkinerja');
    }

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
			$id_kompetensi = $this->input->get('id_kompetensi');
            if (isset($id_kompetensi) and $id_kompetensi !== "") { 
			  $this->load->view(FOLDER_SD_USER.'datacetakkinerja'); 
            } else {
              $data['n20'] = ""; 
			  $this->load->view(FOLDER_SD_USER.'datacetakkinerja');
            }
            
        }
	}

	function ajax_data_cetak_kinerja() {
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            if ($this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user'))) {
				$nuptk = $this->session->userdata("username");
				$data = $this->m_cetakkinerja->cetakkinerja_list($nuptk);
                echo json_encode($data);
            }
			else {
				show_404();
			}
        } else {
          show_404();
       }
	}

	function cetakpenilaian(){
		$success = require_once "dompdf/autoload.inc.php";
		if (!$success) {
			echo "Error. Cannot include and initialize dompdf";
		} else {		

		$dompdf =  new Dompdf\Dompdf();		
		$dompdf->loadHtml('hello world');
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		// Output the generated PDF to Browser
		 $dompdf->stream();
		}
	}


}
?>
