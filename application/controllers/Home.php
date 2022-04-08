<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelCRUD');
        $this->load->library('template');
    }

    public function index()
    {   
        
        $data['produk'] = $this->ModelCRUD->get_all_data('tbl_produk')->result();
        $data['kategori'] = $this->ModelCRUD->get_all_data('tbl_kategori')->result();
        $this->template->load('layout_home', 'member/Home', $data);
    }

    public function produk($id)
    {
        $data['produk2'] = $this->ModelCRUD->join('tbl_produk p', 'tbl_kategori k', 'k.id_kategori=p.id_kategori')->result();
        $dataWhere = array('id_produk' => $id);
        $data['kategori'] = $this->ModelCRUD->get_all_data('tbl_kategori')->result();
        $data['produk'] = $this->ModelCRUD->get_by_id('tbl_produk', $dataWhere)->row_object();
        $this->template->load('layout_home', 'member/produk', $data);
    }

    public function cart()
    {
        $data['jf'] = "Cart";
        $this->template->load('layout_home', 'member/Cart', $data);
    }

}