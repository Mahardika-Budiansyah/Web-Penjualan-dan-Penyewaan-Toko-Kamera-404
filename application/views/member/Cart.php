<div class="data-alert"></div>
<!-- Cart Start -->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark" style="text-align: center;">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle" style="text-align: center;">
                                <?php foreach ($this->cart->contents() as $items) : ?>
                                    <tr>
                                        <td>
                                            <div class="img">
                                                <p><?= $items["nama_produk"] ?></p>
                                            </div>
                                        </td>
                                        <td style="width: 130px;"><?= $items["harga"] ?></td>
                                        <form action="<?= site_url('Cart/update_item') ?>" method="POST">
                                            <input type="hidden" name="id_produk" value="id_produk">
                                            <input type="hidden" value="<?= $items["rowid"] ?>" name="id">
                                            <td style="width: 200px;">
                                                <div class="qty">
                                                    <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="<?= $items["jumlah"] ?>" name="quantity" style="width: calc(100% - 100px);">
                                                    <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td style="width: 130px;"><?= $items["jumlah"] * $items["harga"] ?></td>
                                            <td>
                                                <a href="<?= site_url('Cart/remove_item/' . $items["rowid"]) ?>"><button type="button"><i class="fa fa-trash"></i></button></a>
                                                <button type="submit"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coupon" style="position: relative;
                                                        width: 100%;
                                                        margin-bottom: 15px;
                                                        font-size: 0;">
                                    <form action="<?= site_url('cart/redeem_code') ?>" method="POST">
                                        <input type="hidden" name="" value="">
                                        <input type="text" placeholder="Coupon Code" name="kode_promo" style="width: calc(100% - 135px);
                                                                                                            height: 40px;
                                                                                                            padding: 0 15px;
                                                                                                            font-size: 16px;
                                                                                                            color: #999999;
                                                                                                            background: #ffffff;
                                                                                                            border: 1px solid #dddddd;
                                                                                                            border-radius: 4px;
                                                                                                            margin-right: 15px;
                                                                                                            transition: all .3s;">
                                        <button type="submit" style="width: 120px;
                                                                    height: 40px;
                                                                    padding: 2px 0;
                                                                    font-size: 16px;
                                                                    text-align: center;
                                                                    color: #ffffff;
                                                                    background: #343a40;
                                                                    border: 1px solid ;
                                                                    border-radius: 4px;">
                                            Apply Code</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content" style="padding: 30px; background-color: #f8f9fa;">
                                        <h1 style="font-size: 22px; margin-bottom: 20px;">Cart Summary</h1>
                                        <p>Sub Total<span> Rp.  <?= $this->cart->total() ?></span></p>
                                        <p>Shipping Cost<span> Rp. 1</span></p>
                                            <h2>Grand Total<span> Rp.  <?= $this->cart->total() + 1 ?></span></h2>
                                        
                                       
                                    </div>
                                    <div class="cart-btn" style="margin-top: 15px;
                                                            width: calc(100% + 200px);
                                                            height: 50px;
                                                            padding: 2px 10px;
                                                            text-align: center;">
                                        <button style="width: 120px;
                                                                    height: 40px;
                                                                    padding: 2px 0;
                                                                    font-size: 16px;
                                                                    text-align: center;
                                                                    color: #ffffff;
                                                                    background: #343a40;
                                                                    border: 1px solid ;
                                                                    border-radius: 4px;"><a href="#">Checkout</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Cart End -->