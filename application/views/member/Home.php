        <header class="bg-dark py-5" style="background-image: url('assets/img/theme/header2.jpg'); background-size: cover;
        padding-top: 9rem !important; padding-bottom: 9rem !important; background-position: center;">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Toko Kamera 404</h1>
                    <p class="lead fw-normal text-white-50 mb-0">For Your Memories, We Make a Miracle</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($produk as $key) : ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?= base_url() ?>assets/img/produk/<?= $key->foto_produk ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $key->nama_produk ?></h5>
                                    <!-- Product price-->
                                    <?= "Rp. " . number_format($key->harga, 0, ".", "."); ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="<?= site_url('Home/produk/' . $key->id_produk) ?>">Detail Produk</a>
                                    <a class="btn" href="<?= site_url('Cart/insert_cart/' . $key->id_produk) ?>"><i class="fa fa-shopping-cart"></i> Beli</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
            </div>
        </section>
