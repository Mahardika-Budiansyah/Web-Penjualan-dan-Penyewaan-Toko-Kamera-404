<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller
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
        $data['produk'] = $this->ModelCRUD->get_all_data('tbl_produk')->result();
        $data['jumlah_produk'] = $this->ModelCRUD->get_all_data('tbl_produk')->num_rows();
        $data['jumlah_member'] = $this->ModelCRUD->get_all_data('tbl_member')->num_rows();
        $data['jumlah_transaksi'] = $this->ModelCRUD->get_all_data('tbl_transaksi')->num_rows();
        $data['total_penjualan'] = $this->ModelCRUD->get_by_id('tbl_transaksi', array('id_kategori' => '1'))->num_rows();
        $data['total_penyewaan'] = $this->ModelCRUD->get_by_id('tbl_transaksi', array('id_kategori' => '2'))->num_rows();
        $this->load->view('dashboard/dashboard-admin.php', $data);
    }

}
