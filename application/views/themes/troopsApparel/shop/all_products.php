<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
.product {
    margin-bottom: 30px;
}

.product .img-prod {
    position: relative;
    overflow: hidden;
}

.product .img-prod img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transition: all 0.3s ease;
}

.product:hover .img-prod img {
    transform: scale(1.1);
}

.carousel-control-prev,
.carousel-control-next {
    width: 40px;
    height: 40px;
    background: rgba(0,0,0,0.6);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.3s ease;
}

.product:hover .carousel-control-prev,
.product:hover .carousel-control-next {
    opacity: 1;
}

.carousel-control-prev {
    left: 10px;
}

.carousel-control-next {
    right: 10px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 20px;
    height: 20px;
}

.status {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 10px;
    background: #82ae46;
    color: #fff;
    border-radius: 4px;
    z-index: 2;
}
</style>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url("assets/themes/troopsApparel/images/bg login.jpg"); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span>
                    <span>Produk</span>
                </p>
                <h1 class="mb-0 bread">Daftar Produk</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Semua Produk Kami</span>
                <h2 class="mb-4">Daftar Produk</h2>
            </div>
        </div>
        <div class="row">
            <?php if (count($products) > 0) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <?php 
                            $images = explode(',', $product->picture_name);
                            $has_valid_images = false;
                            foreach($images as $img) {
                                if(!empty(trim($img))) {
                                    $has_valid_images = true;
                                    break;
                                }
                            }
                            
                            if($has_valid_images && count($images) > 1): 
                            ?>
                            <div id="carousel<?php echo $product->id; ?>" class="carousel slide img-prod" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php 
                                    $active_set = false;
                                    foreach($images as $index => $image): 
                                        $image = trim($image);
                                        if(empty($image)) continue;
                                    ?>
                                    <div class="carousel-item <?php echo (!$active_set) ? 'active' : ''; ?>">
                                        <?php $active_set = true; ?>
                                        <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku); ?>">
                                            <img src="<?php echo base_url('assets/uploads/products/' . $image); ?>" 
                                                 alt="<?php echo $product->name; ?>">
                                            <?php if ($product->current_discount > 0) : ?>
                                                <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price, 0); ?>%</span>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="carousel-control-prev" href="#carousel<?php echo $product->id; ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel<?php echo $product->id; ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <?php else: ?>
                            <div class="img-prod">
                                <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku); ?>">
                                    <?php if($has_valid_images): ?>
                                        <img src="<?php echo base_url('assets/uploads/products/' . trim($images[0])); ?>" 
                                             alt="<?php echo $product->name; ?>">
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/uploads/products/default.jpg'); ?>" 
                                             alt="<?php echo $product->name; ?>">
                                    <?php endif; ?>
                                    <?php if ($product->current_discount > 0) : ?>
                                        <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price, 0); ?>%</span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku); ?>"><?php echo $product->name; ?></a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <?php if ($product->current_discount > 0) : ?>
                                                <span class="mr-2 price-dc">Rp <?php echo format_rupiah($product->price); ?></span>
                                                <span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                            <?php else : ?>
                                                <span class="mr-2"><span class="price-sale">Rp <?php echo format_rupiah($product->price); ?></span></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" 
                                           data-sku="<?php echo $product->sku; ?>" 
                                           data-name="<?php echo $product->name; ?>" 
                                           data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>" 
                                           data-id="<?php echo $product->id; ?>">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center">
                    <p>Produk tidak ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Prevent carousel from auto sliding
    $('.carousel').carousel({
        interval: false,
        touch: true
    });

    // Stop carousel controls from bubbling up to parent links
    $('.carousel-control-prev, .carousel-control-next').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Handle swipe gestures for mobile
    $('.carousel').on('touchstart', function(event) {
        const xClick = event.originalEvent.touches[0].pageX;
        $(this).one('touchmove', function(event) {
            const xMove = event.originalEvent.touches[0].pageX;
            const sensitivityInPx = 5;

            if(Math.floor(xClick - xMove) > sensitivityInPx) {
                $(this).carousel('next');
            }
            else if(Math.floor(xClick - xMove) < -sensitivityInPx) {
                $(this).carousel('prev');
            }
        });
        $(this).on('touchend', function() {
            $(this).off('touchmove');
        });
    });
});
</script>
