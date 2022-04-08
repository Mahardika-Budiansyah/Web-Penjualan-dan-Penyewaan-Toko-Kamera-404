<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
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

    var $title = 'autocomplete';
    public function index()
    {   
        $data['title'] = $this->title;
        $data['detail_transaksi'] = $this->ModelCRUD->joinenam('tbl_detail_transaksi dt', 'tbl_transaksi t', 'tbl_produk p', 'tbl_member m', 'tbl_kategori k', 
            'tbl_status_order so', 't.id_transaksi=dt.id_transaksi', 'p.id_produk=dt.id_produk', 'm.id_member=t.id_member', 'k.id_kategori=t.id_kategori', 
            'so.id_status_order=t.id_status_order')->result();
        /*$data['transaksi'] = $this->ModelCRUD->jointiga('tbl_transaksi t', 'tbl_member m', 'tbl_kategori k', 'm.id_member=t.id_member', 'k.id_kategori=t.id_kategori')->result();*/
        /*$data['transaksi'] = $this->ModelCRUD->joinempat('tbl_transaksi t', 'tbl_member m', 'tbl_kategori k', 
            'tbl_status_order so', 'm.id_member=t.id_member', 'k.id_kategori=t.id_kategori', 'so.id_status_order=t.id_status_order')->result();*/
        $data['jumlah_transaksi'] = $this->ModelCRUD->get_all_data('tbl_transaksi')->num_rows();
        $data['total_penjualan'] = $this->ModelCRUD->get_by_id('tbl_transaksi', array('id_kategori' => '1'))->num_rows();
        $data['total_penyewaan'] = $this->ModelCRUD->get_by_id('tbl_transaksi', array('id_kategori' => '2'))->num_rows();
        $data['status_order'] = $this->ModelCRUD->get_all_data('tbl_status_order')->result();
        $data['kategori'] = $this->ModelCRUD->get_all_data('tbl_kategori')->result();
        $data['nama_member'] = $this->ModelCRUD->get_all_data('tbl_member')->result();
        $data['produk'] = $this->ModelCRUD->get_all_data('tbl_produk')->result();
        $this->load->view('dashboard/transaksi', $data);
    }

    public function update_status()
    {
        $id = $this->input->post('id_transaksi');
		$status_order = $this->input->post('id_status_order');
		$data = array(
                    'id_status_order' => $status_order
                );
        $this->session->set_flashdata('alert', 'diubah');
        $this->ModelCRUD->update('tbl_transaksi', $data, 'id_transaksi', $id);
        redirect('Transaksi');
    }

    
    public function get_autocomplete()
    {

          
    }



    public function detail_transaksi()
    {
        $data['detail_transaksi'] = $this->ModelCRUD->joinenam('tbl_detail_transaksi dt', 'tbl_transaksi t', 'tbl_produk p', 'tbl_member m', 'tbl_kategori k', 
            'tbl_status_order so', 't.id_transaksi=dt.id_transaksi', 'p.id_produk=dt.id_produk', 'm.id_member=t.id_member', 'k.id_kategori=t.id_kategori', 
            'so.id_status_order=t.id_status_order')->result();
        /*$data['transaksi'] = $this->ModelCRUD->jointiga('tbl_transaksi t', 'tbl_member m', 'tbl_kategori k', 'm.id_member=t.id_member', 'k.id_kategori=t.id_kategori')->result();*/
        /*$data['transaksi'] = $this->ModelCRUD->joinempat('tbl_transaksi t', 'tbl_member m', 'tbl_kategori k', 
            'tbl_status_order so', 'm.id_member=t.id_member', 'k.id_kategori=t.id_kategori', 'so.id_status_order=t.id_status_order')->result();*/
        $data['jumlah_transaksi'] = $this->ModelCRUD->get_all_data('tbl_transaksi')->num_rows();
        $data['total_penjualan'] = $this->ModelCRUD->get_by_id('tbl_transaksi', array('id_kategori' => '1'))->num_rows();
        $data['total_penyewaan'] = $this->ModelCRUD->get_by_id('tbl_transaksi', array('id_kategori' => '2'))->num_rows();
        $data['status_order'] = $this->ModelCRUD->get_all_data('tbl_status_order')->result();
        $data['kategori'] = $this->ModelCRUD->get_all_data('tbl_kategori')->result();
        $data['nama_member'] = $this->ModelCRUD->get_all_data('tbl_member')->result();
        $data['produk'] = $this->ModelCRUD->get_all_data('tbl_produk')->result();
        $this->load->view('dashboard/detail_transaksi', $data);
    }

}
