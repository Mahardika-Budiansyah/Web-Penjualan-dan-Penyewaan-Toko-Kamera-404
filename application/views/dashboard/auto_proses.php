
<?php
include "koneksi.php";
$query = mysqli_query($koneksi,"SELECT * FROM tbl_produk WHERE id_produk='$_GET[id]'");
$user = mysqli_fetch_array($query);
$data = array('nama_produk' => $tbl_produk['nama_produk'],'id_kategori' => $tbl_produk['id_kategori']);
    echo json_encode($data);
?>