<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{   
    function __construct(){
		parent::__construct();
		$this->load->model('ModelCRUD');
		$this->load->model('ModelLogin');
	}

    public function index()
    {
        $this->load->view('login/login');
    }

	/* Controller Login */
    public function aksi_login(){
		$u = $this->input->post('username');
		$p = $this->input->post('password');

		$cek = $this->ModelLogin->cek_login($u, $p);
		$lvl = $cek->row();
		if ($cek->num_rows() == 1){
			$data_session = array(
				'username' => $u,
				'nama' => $lvl->nama_member,
				'level' => $lvl->status,
				'email' => $lvl->email,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);
			$this->session->set_flashdata('alert','logged');
			if($this->session->userdata('level') == 'admin'){
				redirect('DashboardAdmin');
			}else{
				redirect('Home');
			}
		} else {
			$this->session->set_flashdata('alert','gagal login');
			redirect('Login');
        }
	}


	/* Controller Logout */
    public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}

	/* Controller Registrasi */
	public function Registrasi()
    {
        $this->load->view('login/registrasi');
    }

	public function registrasi_member()
	{
		$username = $this->input->post('username');
		$nama = $this->input->post('nama_member');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$password = $this->input->post('password');
		$status = $this->input->post('status');
		$check = $this->input->post('check');
		$dataInsert = array('username' => $username,
							'nama_member' => $nama,
							'alamat' => $alamat,
							'email' => $email,
							'telepon' => $telepon,
							'password' => $password,
							'status' => $status
					);
		$cek = $this->ModelCRUD->get_by_id('tbl_member',array('username' => $username));
		if($cek->num_rows() > 0){
			$this->session->set_flashdata('alert', 'adauser');
			redirect('Login/Registrasi');
		}
		elseif($check != 'true'){
			$this->session->set_flashdata('cek', '<small class="form-text text-muted">
			<p style="color: red; padding: 2px;">* Pilihan ini harus dicentang!</p></small>');
			redirect('Login/Registrasi');
		}
		else{
			$this->session->set_flashdata('alert', 'pendaftaran');
			$this->ModelCRUD->insert('tbl_member', $dataInsert);
			redirect('Login');
		}
	}
}
