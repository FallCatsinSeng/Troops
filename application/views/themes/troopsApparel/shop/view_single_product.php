<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="product-page">
<section class="ftco-section">
    <div class="container">
<!--Baju-->
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <div id="productCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                        $images = explode(',', $product->picture_name);
                        foreach($images as $index => $image): 
                            $image = trim($image);
                            if(empty($image)) continue;
                        ?>
                        <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('assets/uploads/products/'. $image); ?>" class="image-popup">
                                <img src="<?php echo base_url('assets/uploads/products/'. $image); ?>" 
                                     class="d-block w-100 img-fluid" 
                                     alt="<?php echo $product->name . ' ' . ($index + 1); ?>">
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <div style="color: #fff; margin-top: 15px;">
                     <?php echo $product->description; ?>
                    
                    </div>
                </div>
            </div>
<!--Tulisan-->
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3 style="color: #fff;"><?php echo $product->name; ?></h3>
                <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #fff;"><?php echo $product->stock; ?>
                            <?php echo $product->product_unit; ?></p>
                    </div>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #fff;">5.0</a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #fff;">100 <span style="color: #fff;">Rating</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #fff;">500 <span style="color: #fff;">Sold</span></a>
                    </p>
                </div>
                <p class="price" style="color: #fff;">
                    <?php if ($product->current_discount > 0) : ?>
                    <span class="mr-2 price-dc"><strike><small style="color: #fff;">Rp
                                <?php echo format_rupiah($product->price); ?></small></strike></span>
                    <span class="price-sale text-success">Rp
                        <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                    <?php else : ?>
                    <span style="color: #fff;">Rp <?php echo format_rupiah($product->price); ?></span>
                    <?php endif; ?>
                </p>
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class=".input-group-product col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1"
                            min="1" max="100">
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <p><a href="#" class="btn btn-black btn-sm py-3 px-5 single-product-add-cart"
                        data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>"
                        data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>"
                        data-id="<?php echo $product->id; ?>">Add to Cart</a></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading" style="color: #fff;">Produk Lain</span>
                <h2 class="mb-4" style="color: #fff;">Produk lain yang terkait</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if ( count($related_products) > 0) : ?>
            <?php foreach ($related_products as $product) : ?>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod"><img class="img-fluid"
                            src="<?php echo base_url('assets/uploads/products/'. $product->picture_name); ?>"
                            alt="<?php echo $product->name; ?>">
                        <?php if ($product->current_discount > 0) : ?>
                        <span
                            class="status"><?php echo count_percent_discount($product->current_discount, $product->price); ?>%</span>
                        <?php endif; ?>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3 style="color: #fff;"><?php echo anchor('shop/product/'. $product->id .'/'. $product->sku .'/', $product->name, 'style="color: #fff;"'); ?>
                        </h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price" style="color: #fff;">
                                    <?php if ($product->current_discount > 0) : ?>
                                    <span class="mr-2 price-dc" style="color: #fff;">Rp <?php echo format_rupiah($product->price); ?></span>
                                    <span class="price-sale" style="color: #fff;">Rp
                                        <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                </p>
                                <?php else : ?>
                                <span class="price-sale" style="color: #fff;">Rp <?php echo format_rupiah($product->price); ?>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="<?php echo site_url('shop/product/'. $product->id .'/'. $product->sku .'/'); ?>"
                                    class="buy-now d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="#"
                                    class="single-product-add-cart d-flex justify-content-center align-items-center mx-1"
                                    data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>"
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
            <?php endif; ?>

        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Debug flag
    const DEBUG = true;
    
    function debugLog(message, data) {
        if (DEBUG) {
            console.log(`[Debug] ${message}:`, data);
        }
    }

    // Initialize quantity input
    var quantity = 1;
    $('#quantity').val(quantity);

    // Plus button handler
    $('.quantity-right-plus').click(function(e) {
        e.preventDefault();
        quantity = parseInt($('#quantity').val());
        if (quantity < 100) {
            quantity += 1;
            $('#quantity').val(quantity);
            updateAddToCartButtons(quantity);
            debugLog('Quantity increased to', quantity);
        }
    });

    // Minus button handler
    $('.quantity-left-minus').click(function(e) {
        e.preventDefault();
        quantity = parseInt($('#quantity').val());
        if (quantity > 1) {
            quantity -= 1;
            $('#quantity').val(quantity);
            updateAddToCartButtons(quantity);
            debugLog('Quantity decreased to', quantity);
        }
    });

    // Manual input handler
    $('#quantity').on('input', function() {
        quantity = parseInt($(this).val()) || 1;
        if (quantity < 1) quantity = 1;
        if (quantity > 100) quantity = 100;
        $(this).val(quantity);
        updateAddToCartButtons(quantity);
        debugLog('Quantity manually set to', quantity);
    });

    // Function to update all add to cart buttons
    function updateAddToCartButtons(qty) {
        $('.single-product-add-cart').attr('data-qty', qty);
        debugLog('Updated add-cart buttons with qty', qty);
    }

    // Remove any existing click handlers
    $('.single-product-add-cart').off('click');

    // Handle add to cart button click
    $('.single-product-add-cart').click(function(e) {
        e.preventDefault();
        debugLog('Add to cart clicked', this);
        
        // Check if user is logged in
        <?php if (!is_login()) : ?>
            var currentPage = window.location.href;
            window.location.href = '<?php echo site_url('auth/login?redirect='); ?>' + encodeURIComponent(currentPage);
            return;
        <?php endif; ?>

        var clickedBtn = $(this);

        // Check if button is already processing
        if (clickedBtn.data('processing')) {
            debugLog('Button is already processing', clickedBtn);
            return;
        }

        // Set processing state
        clickedBtn.data('processing', true);
        
        // Visual feedback
        var originalText = clickedBtn.html();
        clickedBtn.html('<i class="fa fa-spinner fa-spin"></i> Adding...');

        // Check if user has filled their address
        $.ajax({
            url: '<?php echo site_url('customer/profile/check_address'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                debugLog('Address check response', res);
                if (res.has_address) {
                    addToCart(clickedBtn, originalText);
                } else {
                    // Reset button state
                    clickedBtn.data('processing', false);
                    clickedBtn.html(originalText);
                    
                    Swal.fire({
                        title: 'Alamat Belum Lengkap',
                        text: 'Silahkan lengkapi data alamat (Provinsi, Kabupaten, Kecamatan, Desa, Alamat Lengkap, dan Kode Pos) terlebih dahulu',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?php echo site_url('customer/profile'); ?>';
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                // Reset button state
                clickedBtn.data('processing', false);
                clickedBtn.html(originalText);
                
                console.error('Error checking address:', error);
                debugLog('Address check error', {xhr, status, error});
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat memeriksa alamat',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    function addToCart(btn, originalText) {
        // Get quantity from input if it exists, otherwise use data-qty attribute
        var qty;
        var quantityInput = $('#quantity');
        if (quantityInput.length) {
            qty = parseInt(quantityInput.val()) || 1;
        } else {
            qty = parseInt(btn.attr('data-qty')) || 1;
        }

        // Validate quantity
        if (qty < 1) qty = 1;
        if (qty > 100) qty = 100;

        var data = {
            'id': btn.data('id'),
            'sku': btn.data('sku'),
            'qty': qty,
            'name': btn.data('name'),
            'price': btn.data('price')
        };

        debugLog('Sending add to cart request', data);

        $.ajax({
            url: '<?php echo site_url('shop/cart_api'); ?>',
            type: 'POST',
            data: data,
            success: function(res) {
                debugLog('Add to cart response', res);
                
                // Reset button state
                btn.data('processing', false);
                btn.html(originalText);
                
                try {
                    var response = (typeof res === 'string') ? JSON.parse(res) : res;
                    
                    if (response.code === 429) {
                        Swal.fire({
                            title: 'Please Wait',
                            text: response.message,
                            icon: 'warning',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        return;
                    }

                    if (response.total_items) {
                        $('.cart-items').text(response.total_items);
                    }
                    if (response.total) {
                        $('.cart-total').text(response.total);
                    }

                    // Show success notification
                    Swal.fire({
                        title: 'Berhasil!',
                        text: qty + ' ' + data.name + ' ditambahkan ke keranjang',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } catch (e) {
                    console.error('Response parsing error:', e);
                    debugLog('Raw response', res);
                    
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memproses response',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Reset button state
                btn.data('processing', false);
                btn.html(originalText);
                
                console.error('Error adding to cart:', error);
                debugLog('Add to cart error', {xhr, status, error});
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menambahkan ke keranjang',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
});
</script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>