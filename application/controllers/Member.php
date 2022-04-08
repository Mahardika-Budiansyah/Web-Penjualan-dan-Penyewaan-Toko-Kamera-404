<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelCRUD');
        $this->load->model('ModelLogin');
        if(empty($this->session->userdata('username')) and $this->session->userdata('level') != 'admin' ){
			redirect('Login');
		}
    }

    public function index()
    {   
        $data['member'] = $this->ModelCRUD->get_all_data('tbl_member')->result();
        $data['jumlah_member'] = $this->ModelCRUD->get_all_data('tbl_member')->num_rows();
        $this->load->view('dashboard/member', $data);
    }

    public function delete_member($id){
		$where = array('id_member' => $id);
		$this->ModelCRUD->deletekat($where,'tbl_member');
		$error = $this->db->error();
		if ($error['code'] != 0 ) {
            $this->session->set_flashdata('alert','gagalhapus');
        }
        else{
            $this->session->set_flashdata('alert','dihapus');
        }
		redirect('Member');
	}



}
