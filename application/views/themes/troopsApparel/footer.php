<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<script async src="//www.instagram.com/embed.js"></script>

<footer class="ftco-footer ftco-section" style="background-color: black; color: white;">
    <div class="container py-3">

    </div>
</section>
<!--Foto trops dan tentang-->
<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">
    <img src="<?php echo base_url('assets/themes/troopsApparel/images/logoo.jpeg'); ?>" alt="Logo Troops" class="store-logo">
</h2>
<!--Isi Footer-->
                    <p class="store-description"><?php echo get_settings('store_description'); ?></p>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Menu</h2>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo site_url('pages/about'); ?>" class="py-2 d-block">Tentang Kami</a></li>
                        <li><a href="<?php echo site_url('pages/contact'); ?>" class="py-2 d-block">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget">
                    <h2 class="ftco-heading-2">Alamat Kami</h2>
                    <div class="block-23 mb-3">
                    <li style="list-style: none;">
                        <span class="text"><?php echo get_settings('store_address'); ?></span>
        </a>
        <a href="https://goo.gl/maps/wKX5EJtYqdx2o3A16" target="_blank" style="color: #00f; margin-left: 5px;">Klik Disini</a>
    </li>
                        <div class="d-flex mt-3">
                    <a href="#" class="text-white mr-3"><i class="bi bi-instagram" style="font-size: 20px;"></i></a>
                    <a href="#" class="text-white mr-3"><i class="bi bi-youtube" style="font-size: 20px;"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-whatsapp" style="font-size: 20px;"></i></a>
                </div>
                    </div>
                     
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
            <div class="row justify-content-center py-3" style="background-color: black;">
            <div class="col-12 mb-3">
                <img src="<?php echo base_url('assets/images/couriers/tiki.png'); ?>" alt="TIKI" class="mx-2" height="30">
                <img src="<?php echo base_url('assets/images/couriers/jnt.png'); ?>" alt="J&T" class="mx-2" height="30">
                <img src="<?php echo base_url('assets/images/couriers/jne.png'); ?>" alt="JNE" class="mx-2" height="30">
                <img src="<?php echo base_url('assets/images/couriers/pos.png'); ?>" alt="Pos" class="mx-2" height="30">
                <img src="<?php echo base_url('assets/images/couriers/sicepat.png'); ?>" alt="SiCepat" class="mx-2" height="30">
                <img src="<?php echo base_url('assets/images/banks/bca.png'); ?>" alt="BCA" class="mx-2" height="30">
                <img src="<?php echo base_url('assets/images/banks/mandiri.png'); ?>" alt="Mandiri" class="mx-2" height="30">
            </div>
            <div class="col-12">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                    </script> All rights reserved | Made with <i class="icon-heart text-danger" aria-hidden="true"></i>
                    Arindia Nur Zahra.
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00\\\" />
    </svg></div>

<script src="<?php echo get_theme_uri('js/popper.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.easing.1.3.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.waypoints.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.stellar.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.magnific-popup.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/aos.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.animateNumber.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/scrollax.min.js'); ?>"></script>
<script src="<?php echo get_theme_uri('js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".ftco-footer").style.backgroundColor = "black";
    });
</script>


<script>
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$(document).ready(function() {
    // Cart info update
    function updateCartInfo() {
        $.ajax({
            url: '<?php echo site_url('shop/cart_api?action=cart_info'); ?>',
            type: 'GET',
            success: function(res) {
                if (res.total_items) {
                    $('.cart-items').text(res.total_items);
                }
                if (res.total) {
                    $('.cart-total').text(res.total);
                }
            }
        });
    }

    // Only add click handler if we're not on the product page and not using the single-product-add-cart class
    if (!$('body').hasClass('product-page')) {
        $('a.add-cart:not(.single-product-add-cart)').click(function(e) {
            e.preventDefault();
            
            <?php if (!is_login()) : ?>
                window.location.href = '<?php echo site_url('auth/login'); ?>';
                return;
            <?php endif; ?>

            var btn = $(this);
            
            // Check if button is already processing
            if (btn.data('processing')) {
                return;
            }

            // Set processing state
            btn.data('processing', true);
            
            var data = {
                'id': btn.data('id'),
                'sku': btn.data('sku'),
                'qty': 1,
                'name': btn.data('name'),
                'price': btn.data('price')
            };

            $.ajax({
                url: '<?php echo site_url('shop/cart_api?action=add_item'); ?>',
                type: 'POST',
                data: data,
                success: function(res) {
                    btn.data('processing', false);
                    
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
                        
                        if (response.code == 200) {
                            updateCartInfo();
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                    }
                },
                error: function() {
                    btn.data('processing', false);
                }
            });
        });
    }
});
</script>

</body>

</html>