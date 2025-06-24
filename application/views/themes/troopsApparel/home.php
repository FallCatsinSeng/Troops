<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!--Bagian Atas Sendiri yang shop now-->
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item"
        style="background-image: url('<?php echo base_url('assets/themes/troopsApparel/images/BROSUR1.jpg'); ?>');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">Kami Menjual Kaos</h1>
                        <h2 class="subheading mb-4">Bahan Yang Terbuat Dari Material Berkualitas Tinggi</h2>
                        <p><a href="#products" class="btn btn-primary">SHOP NOW!</a></p>
                    </div>

                </div>
            </div>
        </div>

        <div class="slider-item"
        style="background-image: url('<?php echo base_url('assets/themes/troopsApparel/images/BROSUR2.jpg'); ?>');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-sm-12 ftco-animate text-center">
                        <h1 class="mb-2">100% Gratis Ongkir Pembelian Pertama</h1>
                        <h2 class="subheading mb-4">Bahan Yang Terbuat Dari Material Berkualitas Tinggi</h2>
                        <p><a href="#products" class="btn btn-primary">SHOP NOW!</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Halaman Satu Background -->
<section class="ftco-section"
style="background-image: url('<?php echo base_url("assets/themes/troopsApparel/images/bg login.jpg"); ?>');
       background-size: cover;
       background-position: center;
       background-repeat: no-repeat;">

    <!-- Produk-Produk -->
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading" style="color: #fff;">Buat Setiap Momen Jadi Juara!</span>
            </div>
        </div>
        <div class="row">
            <?php if (count($products) > 0) : ?>
                <?php foreach (array_slice($products, 0, 4) as $index => $product) : ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="img-prod">
                                <img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" alt="<?php echo $product->name; ?>">
                                <?php if ($product->current_discount > 0) : ?>
                                    <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price, 0); ?>%</span>
                                <?php endif; ?>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>"><?php echo $product->name; ?></a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <?php if ($product->current_discount > 0) : ?>
                                                <span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                                <span class="mr-2 price-dc">Rp <?php echo format_rupiah($product->price); ?></span>
                                            <?php else : ?>
                                                <span class="price-sale">Rp <?php echo format_rupiah($product->price); ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="buy-now d-flex justify-content-start align-items-center text-center" style="margin-right: 6pt;">
                                            <span><i class="ion-ios-menu custom-icon-size"></i></span>
                                        </a>
                                        <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1"
                                           data-sku="<?php echo $product->sku; ?>"
                                           data-name="<?php echo $product->name; ?>"
                                           data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>"
                                           data-id="<?php echo $product->id; ?>">
                                            <span><i class="ion-ios-cart custom-icon-size"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="col-12">
                    <div class="see-more-custom d-flex justify-content-end">
                        <a href="<?php echo site_url('shop/all-products'); ?>">Lihat Selengkapnya &gt;</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Happy Place -->
    <div class="container mt-5">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading" style="color: #fff;">Reach Your Happy Place</span>
            </div>
        </div>
        <div class="row">
            <p class="description text-center" style="color: #fff;">
                Temukan Kebahagiaanmu di Setiap Momen, Selamat datang di Trops Apparel, tempat di mana kenyamanan dan gaya bertemu. 
                Dengan desain eksklusif dan bahan berkualitas tinggi, kaos jersey kami akan membawamu lebih dekat dengan "Happy Place" kamu, 
                baik saat bersantai, berolahraga, atau berkegiatan sehari-hari. Temukan koleksi kami yang dirancang untuk setiap pribadi yang 
                mencari kesempurnaan dalam kenyamanan.
            </p>
        </div>
    </div>

    <!-- Video Instagram -->
    <div class="container mt-5">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-3" style="color: #fff;">Galeri Video Instagram</h2>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($videos)) : ?>
                <?php foreach ($videos as $video) : ?>
                    <div class="col-md-4 mb-4 ftco-animate">
                        <div class="instagram-post">
                            <blockquote class="instagram-media"
                                        data-instgrm-permalink="<?php echo $video->url; ?>"
                                        data-instgrm-version="14"
                                        style="width: 100%; max-width: 100px; margin: auto; height: 450px;">
                            </blockquote>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Belum ada video ditambahkan.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Kenapa Memilih Kami -->
    <div class="container mt-5">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading" style="color: #fff;">Kenapa Memilih Kami?</span>
            </div>
        </div>
        <div class="row text-center justify-content-center">
            <div class="col-md-3 mb-4">
                <img src="<?php echo base_url('assets/icons/quality.png'); ?>" alt="Icon" class="mb-3" style="height: 60px;">
                <div class="media-body">
                    <h3 class="heading" style="color: #fff;">Kualitas Terbaik</h3>
                    <span style="color: #fff;">Setiap kaos jersey dibuat dari bahan premium, sehingga nyaman dipakai dalam waktu lama.</span>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <img src="<?php echo base_url('assets/icons/jersey.png'); ?>" alt="Icon" class="mb-3" style="height: 60px;">
                <div class="media-body">
                    <h3 class="heading" style="color: #fff;">Desain Terbaik</h3>
                    <span style="color: #fff;">Kami menawarkan desain yang unik dan limited edition untuk menjaga eksklusivitas produk kami.</span>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <img src="<?php echo base_url('assets/icons/support.png'); ?>" alt="Icon" class="mb-3" style="height: 60px;">
                <div class="media-body">
                    <h3 class="heading" style="color: #fff;">Pengiriman Terbaik</h3>
                    <span style="color: #fff;">Kami bekerja sama dengan jasa pengiriman terbaik agar pesananmu tiba tepat waktu.</span>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <img src="<?php echo base_url('assets/icons/delivery.png'); ?>" alt="Icon" class="mb-3" style="height: 60px;">
                <div class="media-body">
                    <h3 class="heading" style="color: #fff;">Bantuan</h3>
                    <span style="color: #fff;">Tim kami selalu siap membantu untuk memastikan pengalaman belanja kamu menyenangkan.</span>
                </div>    
            </div>
        </div>
    </div>

</section>
