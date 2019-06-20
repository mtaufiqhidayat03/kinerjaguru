<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		if ($this->session->userdata("username") && $this->session->userdata("id_user") ) {
            if (($this->session->userdata('level') === "Administrator Kota") or ($this->session->userdata('level') === "Administrator Sekolah")) {
                redirect(base_url("Home"));
            } else {
				if ($this->session->userdata('sekolah') == "SD") {
					redirect(base_url("sd_user/Home"));
				} else if ($this->session->userdata('sekolah') == "SMP") {
					redirect(base_url("smp_user/Home"));
				}
			}
		}
		else {
			$data['tahun']= $this->m_login->cek_tahun();
			$this->load->view('v_login', $data);	
		}
	}

	function checksession() {
		if (empty($this->session->userdata("username")))
		{
			echo "-1";
			$this->session->sess_destroy();
		}
		else
		{
			echo "1";
		}
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$tahun = $this->input->post('tahun');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->m_login->cek_login("master_users",$where)->num_rows();
        $status = $this->m_login->cek_login("master_users",$where)->result();
        foreach ($status as $row)
        {
            $iduser = $row->id_user;
        }
        // cek jika user adalah admin
        $leveladmin = $this->m_login->auth_admin($username)->num_rows();
        $leveladmin2 = $this->m_login->auth_admin($username)->result();
        foreach ($leveladmin2 as $row)
        {
			$levelnya = $row->level;
			$nama_admin = $row->nama_administrator;
        }
        // cek jika user adalah guru sd
		$levelgurusd = $this->m_login->auth_guru($username)->num_rows();		
		$levelgurusd2 = $this->m_login->auth_guru($username)->result();
		foreach ($levelgurusd2 as $row)
        {
			$nama_gurusd = $row->nama_guru;
			$nip_sd = $row->nip;
        }
		// cek jika user adalah kepsek sd
		$levelkepseksd = $this->m_login->check_if_kepseksd($nip_sd,$tahun)->num_rows();
		// cek jika user adalah guru smp
		$levelgurusmp = $this->m_login->auth_gurusmp($username)->num_rows();
		$levelgurusmp2 = $this->m_login->auth_gurusmp($username)->result();
		foreach ($levelgurusmp2 as $row)
        {
			$nama_gurusmp = $row->nama_guru;
			$nip_smp = $row->nip;
		}
		// cek jika user adalah kepsek smp
		$levelkepseksmp = $this->m_login->check_if_kepseksmp($nip_smp,$tahun)->num_rows();
		if($cek == 1){
			$data_session = array(
				'username' => $username,
				'id_user' => $iduser,
				'tahun' => $tahun,
				'status' => "login"
				);
              if($leveladmin == 1){
			   $data_session['level'] = $levelnya;
			   $data_session['nama'] = $nama_admin;
              } else if($levelgurusd == 1){
                if ($levelkepseksd == 1) {
                    $data_session['level'] = "Kepsek";
                } else {
					$data_session['level'] = "Guru";
				}
				$data_session['sekolah'] = "SD";
				$data_session['nama'] = $nama_gurusd;
              } else if($levelgurusmp == 1){
				if ($levelkepseksmp == 1) {
                    $data_session['level'] = "Kepsek";
                } else {
					$data_session['level'] = "Guru";
				}
				$data_session['sekolah'] = "SMP";
				$data_session['nama'] = $nama_gurusmp;
              }
			$this->session->set_userdata($data_session);
			//redirect(base_url("home"));
            echo "";
 
		}
        else {
			echo "Error";
		}
	}
    function form_logout(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		$this->load->view('v_formlogout');
		} else {
			show_404();
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login?module=logout'));
        //redirect(base_url('Home'));
	}
}
?>
