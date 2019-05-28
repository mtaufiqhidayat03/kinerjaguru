<?php
class Pribadi extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model(FOLDER_SMP_USER.'m_pribadiuser');   
        
	}

	function index() {
        if ( $this->session->userdata('status') != "login" and empty($this->session->userdata('username')) and empty($this->session->userdata('id_user')))
        {
            redirect(base_url("login"));
        } else {
			$nuptk = $this->session->userdata('username');
			$data['n3'] = $this->m_pribadiuser->getdataguru($nuptk);
			$data['n2'] = $this->m_pribadiuser->getdatasekolah($nuptk);
			$cek = $this->m_pribadiuser->getdatasekolah($nuptk);
			foreach ($cek as $row)
            {
                $npsn_nss = $row->npsn_nss;
            }
			$data['n4'] = $this->m_pribadiuser->getdatakepalasekolah($npsn_nss);
			$data['n5'] = $this->m_pribadiuser->getdataassesor($nuptk);
			$data['n6'] = $this->m_pribadiuser->getdatapelajaran($nuptk);
            $this->load->view(FOLDER_SMP_USER.'datapribadi',$data);
        }
	}

	function aksigantipasswordguru(){
		if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
		{
		$nuptk=$this->session->userdata("username");
		$query = $this->db->get_where(M_USERS, array('username' => $nuptk));
			if ($query->num_rows() == 1) {
			$data_guru2 = array(
				'password'=>md5($this->input->post('editpassword'))
			);
			$data = $this->m_pribadiuser->updatepasswordguru($data_guru2, $nuptk);
				if ($this->db->affected_rows() != 1) {
					echo "Password sama dengan sebelumnya. Tidak ada yang berubah";
				} else {
					echo $data;
				}
			} else {
			 echo "NUPTK tidak ditemukan";   
			}
		}else{
			echo "session_expired";
		}
		} else {
			show_404();
		}
		}

	function aksieditguru(){
        if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
        if ( $this->session->userdata('status') == "login" and !empty($this->session->userdata('username')) and !empty($this->session->userdata('id_user')))
        {
        $nuptk=$this->input->post('nuptk');
        $query = $this->db->get_where(M_GURU_SMP, array('nuptk' => $nuptk));
            if ($query->num_rows() == 1) {
            $data_guru = array(
               // 'nuptk'=>$this->input->post('nuptk'),
                'nama_guru'=>$this->input->post('nama_guru'),
                'nip'=>$this->input->post('nip'),
                'karpeg'=>$this->input->post('karpeg'),
                'tempat_lahir'=>$this->input->post('tempat_lahir'),
                'tgl_lahir'=>$this->input->post('edittgl_lahir'),
                'pangkat_jabatan'=>$this->input->post('pangkat_jabatan'),
                'tmt_guru'=>$this->input->post('edittmt_guru'),
                'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                'pendidikan_terakhir'=>$this->input->post('pendidikan_terakhir'),
                'program_keahlian'=>$this->input->post('program_keahlian'),
            );
            $data = $this->m_pribadiuser->updateguru($data_guru,$nuptk);
            if ($this->db->affected_rows() != 1) {
            echo "Tidak ada data yang berhasil diubah";
            } else {
            echo $data;
            }
            } else {
             echo "NUPTK tidak ditemukan";   
            }
        }else{
            echo "session_expired";
        }
        } else {
            show_404();
        }
    }  
}
?>