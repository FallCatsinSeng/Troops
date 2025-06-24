<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<link rel="stylesheet" href="<?php echo base_url('assets/themes/troopsApparel/css/style.css'); ?>">

    <section class="ftco-section"
    style="background-image: url('<?php echo base_url("assets/themes/troopsApparel/images/bg login.jpg"); ?>');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
    <span class="subheading" style="color: white;">Semua Produk Kami</span>
    <h2 class="mb-4" style="color: white;">Daftar Produk</h2>
</div>

        </div>
        <div class="row">
          <?php if (isset($products) && count($products) > 0): ?>
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
                                            <img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $image); ?>" 
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
                                        <img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . trim($images[0])); ?>" 
                                             alt="<?php echo $product->name; ?>">
                                    <?php else: ?>
                                        <img class="img-fluid" src="<?php echo base_url('assets/uploads/products/default.jpg'); ?>" 
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
                                    <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="buy-now d-flex justify-content-start align-items-center text-center" style="margin-right: 6pt;">
                                        <span><i class="ion-ios-menu custom-icon-size"></i></span>
                                    </a>
                                    <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>" data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>" data-id="<?php echo $product->id; ?>">
                                        <span><i class="ion-ios-cart custom-icon-size"></i></span>
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

  </div>