<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ModelCRUD');
        $this->load->library('template');
    }

    public function index()
    {
        $data['jf'] = "Cart";
        $this->template->load('layout_home', 'member/cart', $data);
    }

    public function insert_cart($id) {
        $data_insert = $this->ModelCRUD->find($id);

        $data = array(
            'id' => $data_insert->id_produk,
            'nama_produk' => $data_insert->nama_produk,
            'jumlah' => 1,
            'harga' => $data_insert->harga,
            'id_kategori' => $data_insert->id_kategori,
        );

        $this->cart->insert($data);
        redirect('Cart');
    }

    public function remove_item($id) 
    {
        $this->cart->remove($id);

        redirect('Cart');
    }

    public function update_item() 
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('quantity');

        $data = array(
            'rowid' => $id,
            'jumlah' => $qty
        );
        $this->cart->update($data);

        redirect('Cart');
    }
}
