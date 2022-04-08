<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
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
        $data['jumlah_produk'] = $this->ModelCRUD->get_all_data('tbl_produk')->num_rows();
        $data['kategori'] = $this->ModelCRUD->get_all_data('tbl_kategori')->result();
        $data['produk'] = $this->ModelCRUD->join('tbl_produk p','tbl_kategori k','k.id_kategori=p.id_kategori')->result();
        $this->load->view('dashboard/produk', $data);
    }


// ================================ Controller CRUD Produk ==========================================
    public function simpan_produk() 
    {
        $nama = $this->input->post('nama_produk');
        $dcek = array('nama_produk' => $nama);
        $kategori = $this->input->post('nama_kategori');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskripsi_produk');
        $gambar_produk = $_FILES['foto_produk'];
        $cek = $this->ModelCRUD->get_by_id('tbl_produk', $dcek);

        if( $cek->row_object() == 1 ){
            $this->session->set_flashdata('alert','ada');
                redirect('produk');
        } else {
            if($_FILES['foto_produk']['name'] == null) {
                $gambar_produk= ' ';
            } else {
                $config['upload_path'] = './assets/img/produk';
                $config['allowed_types'] = 'jpg|png|gif|jpeg';
                $config['max_size'] = '2048';
                $config['remove_spaces'] = 'TRUE';
                $config['detect_mime'] = 'TRUE';
    
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('foto_produk')) {
    
                    $this->session->set_flashdata('alert', 'upload');
                    redirect('produk');
                } else {
                    $gambar_produk = $this->upload->data('file_name');
                }
            }
            $data = array(
                'nama_produk' => $nama,
                'id_kategori' => $kategori,
                'stok' => $stok,
                'harga' => $harga,
                'deskripsi_produk' => $deskripsi,
                'foto_produk' => $gambar_produk
            );
    
            $this->session->set_flashdata('alert', 'ditambahkan');
            $this->ModelCRUD->insert('tbl_produk', $data);
            redirect('produk');
        }     
    }

    public function edit_produk($id)
    {
      
		$dataWhere = array('id_produk' => $id);
        $data['kategori'] = $this->ModelCRUD->get_all_data('tbl_kategori')->result();
		$data['produk'] = $this->ModelCRUD->get_by_id('tbl_produk',$dataWhere)->row_object();
		$this->load->view('dashboard/edit_produk', $data);
    }

    public function update_produk()
    {  
		$id = $this->input->post('id_produk');
		$nama = $this->input->post('nama_produk');
        $kategori = $this->input->post('id_kategori');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskripsi_produk');
		$data = array(
                    'id_kategori' => $kategori,
                    'nama_produk' => $nama,
                    'deskripsi_produk' => $deskripsi,
                    'harga' => $harga,
                    'stok' => $stok
                );
        $this->session->set_flashdata('alert', 'diubah');
        $this->ModelCRUD->update('tbl_produk', $data, 'id_produk', $id);
        redirect('Produk');
    }

    
    public function delete_produk($id){
		$where = array('id_produk' => $id);
		$this->ModelCRUD->deletekat($where,'tbl_produk');
		$error = $this->db->error();
		if ($error['code'] != 0 ) {
            $this->session->set_flashdata('alert','gagalhapus');
        }
        else{
            $this->session->set_flashdata('alert','dihapus');
        }
		redirect('Produk');
	}
// ==================================================================================================

    
}
