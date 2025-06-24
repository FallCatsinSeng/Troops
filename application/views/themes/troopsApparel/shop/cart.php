<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
body {
    background-image: url('<?php echo base_url("assets/themes/troopsApparel/images/bg login.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    min-height: 100vh;
}
.hero-wrap.hero-bread {
    background: transparent !important;
}
.ftco-section, .container {
    background: transparent !important;
}
.hero-wrap.hero-bread h1,
.hero-wrap.hero-bread .breadcrumbs,
.table thead th,
.table td,
.cart-total h3,
.cart-total p,
.cart-total label,
.cart-total span,
.cart-total input,
.cart-total .form-group,
.cart-total .n-subtotal,
.cart-total .n-ongkir,
.cart-total .n-total,
.cart-list .product-name h3,
.cart-list .price,
.cart-list .total,
.cart-list .quantity,
.cart-list .image-prod,
.cart-list .product-remove a,
.cart-list .product-remove span {
    color: #fff !important;
}

/* Style untuk select dan option */
select.form-control,
select.form-control option {
    background-color: rgba(0, 0, 0, 0.5) !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}

/* Style untuk textarea */
textarea.form-control {
    background-color: rgba(0, 0, 0, 0.5) !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}

/* Style untuk radio buttons dan labels */
.radio label {
    color: #fff !important;
}

input.form-control, 
input.input-number {
    background: rgba(255,255,255,0.1);
    color: #fff !important;
    border: 1px solid #fff;
}

.btn-outline-light {
    color: #fff !important;
    border-color: #fff !important;
}

/* Style untuk form labels */
.form-control-label {
    color: #fff !important;
    font-weight: 500;
}

/* Style untuk form groups */
.form-group {
    margin-bottom: 1rem;
}

/* Style untuk payment options */
.payment-options label {
    color: #fff !important;
    font-weight: 500;
}

/* Style untuk notes section */
.notes-section label {
    color: #fff !important;
    font-weight: 500;
}
</style>
<div class="hero-wrap hero-bread">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span> <span>Keranjang Belanja</span></p>
          <h1 class="mb-0 bread">Keranjang Belanja Saya</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-Keranjang Belanja">
          <div class="container">
          <?php if ( count($carts) > 0) : ?>
            <form action="<?php echo site_url('shop/create_order'); ?>" method="POST">
              <div class="row">
              <div class="col-md-12 ftco-animate">
                  <div class="cart-list">
                      <table class="table">
                          <thead class="thead-primary">
                            <tr class="text-center">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Produk</th>
                              <th>Harga</th>
                              <th>Kuantitas</th>
                              <th>Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($carts as $item) : ?>
                            <tr class="text-center cart-<?php echo $item['rowid']; ?>" data-product-id="<?php echo $item['id']; ?>">
                              <td class="product-remove"><a href="#" class="remove-item" data-rowid="<?php echo $item['rowid']; ?>" data-product-id="<?php echo $item['id']; ?>"><span class="ion-ios-close"></span></a></td>
                              
                              <td class="image-prod"><div class="img img-fluid rounded" style="background-image:url(<?php echo get_product_image($item['id']); ?>);"></div></td>
                              
                              <td class="product-name">
                                  <h3><?php echo $item['name']; ?></h3>
                                  <small class="text-muted">ID: <?php echo $item['id']; ?></small>
                              </td>
                              
                              <td class="price">Rp <?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                              
                              <td class="quantity">
                                  <div class="input-group mb-3" style="max-width:120px;margin:auto;">
                                      <div class="input-group-prepend">
                                          <button type="button" class="btn btn-outline-light btn-minus" data-product-id="<?php echo $item['id']; ?>" tabindex="-1" style="border:1px solid #fff;">-</button>
                                      </div>
                                      <input type="text" name="quantity[<?php echo $item['rowid']; ?>]" class="quantity form-control input-number text-center" value="<?php echo $item['qty']; ?>" min="1" max="100" data-product-id="<?php echo $item['id']; ?>">
                                      <div class="input-group-append">
                                          <button type="button" class="btn btn-outline-light btn-plus" data-product-id="<?php echo $item['id']; ?>" tabindex="-1" style="border:1px solid #fff;">+</button>
                                      </div>
                                  </div>
                              </td>
                              
                              <td class="total" data-product-id="<?php echo $item['id']; ?>">Rp <?php echo number_format($item['qty']*$item['price'], 2, ',', '.'); ?></td>
                            </tr><!-- END TR-->
                              <?php endforeach; ?>
                          </tbody>
                        </table>
                    </div>
              </div>
          </div>
          <div class="row justify-content-end">
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Kode Kupon</h3>
                      <p>Punya kode kupon? Gunakan kupon kamu untuk mendapatkan potongan harga menarik</p>
                        
                <div class="form-group">
                    <label for="code">Kode:</label>
                  <input id="code" name="coupon_code" type="text" class="form-control text-left px-3" placeholder="">
                </div>
              
                  </div>
                  
              </div>
              
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Rincian Keranjang</h3>
                      <p class="d-flex">
                          <span>Subtotal</span>
                          <span class="n-subtotal font-weight-bold">Rp <?php echo number_format($total_cart, 2, ',', '.'); ?></span>
                      </p>

                      <!-- Shipping section -->
                      <div class="shipping-section mb-3">
                          <?php
                            $user = null;
                            $customer = null;
                            $debug_info = [];
                            
                            try {
                                // Get encryption instance from CI
                                $CI =& get_instance();
                                if (!isset($CI->encryption)) {
                                    $CI->load->library('encryption');
                                }
                                
                                // Get session data safely
                                $encrypted_session = $CI->session->userdata('__ACTIVE_SESSION_DATA');
                                $debug_info['has_session'] = !empty($encrypted_session);
                                
                                if ($encrypted_session) {
                                    $decrypted_data = $CI->encryption->decrypt($encrypted_session);
                                    $debug_info['decrypted'] = !empty($decrypted_data);
                                    
                                    if ($decrypted_data) {
                                        $session_data = json_decode($decrypted_data, true);
                                        $debug_info['session_parsed'] = !empty($session_data);
                                        
                                        if ($session_data && isset($session_data['user_id'])) {
                                            $user_id = $session_data['user_id'];
                                            // Get user data from database
                                            $user = $CI->db->get_where('users', ['id' => $user_id])->row();
                                            $customer = $CI->db->get_where('customers', ['user_id' => $user_id])->row();
                                            $debug_info['user_found'] = !empty($user);
                                            $debug_info['customer_found'] = !empty($customer);
                                            $debug_info['has_postal'] = !empty($customer->kode_pos);
                                        }
                                    }
                                }
                            } catch (Exception $e) {
                                $debug_info['error'] = $e->getMessage();
                                log_message('error', 'Error getting user data: ' . $e->getMessage());
                            }
                          ?>

                          <div class="form-group">
                              <label for="kode_pos">Kode Pos Pengiriman:</label>
                              <input type="text" id="kode_pos" name="kode_pos" class="form-control" 
                                     value="<?php echo isset($customer) && isset($customer->kode_pos) ? $customer->kode_pos : ''; ?>" readonly>
                              <?php if (!isset($customer) || empty($customer->kode_pos)) : ?>
                                  <small class="text-danger">Silakan lengkapi kode pos di profil Anda terlebih dahulu. <?php echo anchor('customer/profile', 'Klik disini untuk mengisi profil'); ?></small>
                              <?php endif; ?>
                          </div>

                          <div class="form-group">
                              <label for="courier" class="form-control-label">Kurir:</label>
                              <select id="courier" name="courier" class="form-control" <?php echo (!isset($customer) || empty($customer->kode_pos)) ? 'disabled="disabled"' : ''; ?>>
                                  <option value="">Pilih Kurir</option>
                                  <option value="tiki">TIKI</option>
                                  <option value="jnt">J&amp;T</option>
                                  <option value="jne">JNE</option>
                                  <option value="pos">POS Indonesia</option>
                                  <option value="tiki">TIKI</option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="service" class="form-control-label">Layanan:</label>
                              <select id="service" name="service" class="form-control" <?php echo (!isset($customer) || empty($customer->kode_pos)) ? 'disabled="disabled"' : ''; ?>>
                                  <option value="">Pilih Layanan (otomatis termurah)</option>
                              </select>
                          </div>
                      </div>

                      <p class="d-flex">
                          <span>Biaya pengiriman</span>
                          <span id="ongkir" class="n-ongkir font-weight-bold">Rp 0</span>
                          <input type="hidden" name="shipping_cost" value="0">
                      </p>
                      <hr>
                      <p class="d-flex total-price">
                          <span>Total</span>
                          <span class="n-total font-weight-bold" id="subtotal" data-value="<?php echo $total_cart; ?>">Rp <?php echo number_format($total_price, 2, ',', '.'); ?></span>
                      </p>
                  </div>
                  <div class="form-group notes-section">
                      <label for="note" class="form-control-label">Catatan:</label>
                      <textarea name="note" class="form-control ac" id="note" rows="3" placeholder="Tambahkan catatan untuk pesanan Anda..."></textarea>
                  </div>

                  <div class="form-group payment-options">
                      <label class="form-control-label">Metode Pembayaran:</label>
                      <div class="radio">
                          <label><input type="radio" name="payment" class="mr-2" value="1"> Transfer bank</label>
                      </div>
                      <div class="radio">
                          <label><input type="radio" name="payment" class="mr-2" value="2" checked> Bayar ditempat</label>
                      </div>
                  </div>

                  <p><button type="submit" class="btn btn-primary py-3 px-4" id="checkout-button">Buat Pesanan</button></p>
              </div>
          </div>
          </form>
          <?php else : ?>
            <div class="row">
              <div class="col-md-12 ftco-animate">
                <div class="alert alert-info">Tidak ada barang dalam keranjang.
                  <br>
                  <?php echo anchor('home', 'Jelajahi produk kami', ['class' => 'ab']); ?> dan mulailah berbelanja!</div>
              </div>
            </div>
          <?php endif; ?>
          </div>
      </section>

<script>
// Cart items data for shipping calculation
const cartItems = <?php 
$items_for_shipping = array();
foreach ($carts as $item) {
    // Get complete product data
    $product = $this->db->get_where('products', ['id' => $item['id']])->row();
    
    // Skip if product not found
    if (!$product) continue;
    
    // Get product description
    $description = $product->description ?? '';
    if ($description) {
        $description = strip_tags($description);
        $description = substr($description, 0, 100); // Limit to 100 chars
    }
    
    $items_for_shipping[] = array(
        'id' => $item['id'],  // Menambahkan ID produk
        'name' => $item['name'],
        'description' => $description,
        'value' => intval($item['price']), // Convert to integer
        'length' => intval($product->length ?? 20),
        'width' => intval($product->width ?? 20),
        'height' => intval($product->height ?? 10),
        'weight' => intval($product->weight ?? 800),
        'quantity' => intval($item['qty']),  // Make sure quantity is integer
        'subtotal' => intval($item['subtotal']) // Menambahkan subtotal
    );
}
echo json_encode($items_for_shipping);
?>;

// Debug cart items
console.log('Cart Items:', cartItems);
</script>
<script src="<?php echo base_url('assets/themes/troopsApparel/js/checkout.js'); ?>"></script>
<script>
$(document).ready(function() {
    // Function to format number to rupiah with fixed 2 decimal places
    function formatRupiah(number) {
        // Format with thousand separators and force 2 decimal places
        const formatted = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(number);
        
        // Replace decimal point with comma for Indonesian format
        return formatted.replace('.', ',');
    }

    // Function to parse rupiah string back to number
    function parseRupiah(rupiahString) {
        // Remove 'Rp ', dots, and replace comma with dot for calculation
        return parseFloat(rupiahString.replace(/[^\d,]/g, '').replace(',', '.'));
    }

    // Function to update cart item quantity
    function updateCartItem(rowid, qty, productId) {
        $.ajax({
            method: 'POST',
            url: '<?php echo site_url('shop/cart_api?action=update_item'); ?>',
            data: { 
                rowid: rowid,
                qty: qty
            },
            success: function (res) {
                if (res.code == 200) {
                    // Update subtotal for this item
                    const priceText = $('.cart-' + rowid + ' .price').text();
                    const price = parseRupiah(priceText);
                    const newSubtotal = price * qty;
                    $('.cart-' + rowid + ' .total').text('Rp ' + formatRupiah(newSubtotal));
                    
                    // Update cart totals
                    $('.n-subtotal').text('Rp ' + formatRupiah(res.total.subtotal_raw));
                    $('#subtotal').data('value', res.total.subtotal_raw);
                    $('.n-total').text('Rp ' + formatRupiah(res.total.total_raw));
                    
                    // Recalculate shipping if courier is selected
                    if ($('#courier').val()) {
                        calculateShipping();
                    }
                }
            }
        });
    }

    // Handle quantity changes
    $('.btn-minus').click(function(e) {
        e.preventDefault();
        const input = $(this).closest('.input-group').find('.quantity');
        const rowid = input.attr('name').match(/quantity\[(.*?)\]/)[1];
        const productId = input.data('product-id');
        let value = parseInt(input.val());
        
        if (value > 1) {
            value--;
            input.val(value);
            updateCartItem(rowid, value, productId);
        }
    });

    $('.btn-plus').click(function(e) {
        e.preventDefault();
        const input = $(this).closest('.input-group').find('.quantity');
        const rowid = input.attr('name').match(/quantity\[(.*?)\]/)[1];
        const productId = input.data('product-id');
        let value = parseInt(input.val());
        
        if (value < 100) {
            value++;
            input.val(value);
            updateCartItem(rowid, value, productId);
        }
    });

    // Handle manual quantity input
    $('.quantity').on('change', function() {
        const input = $(this);
        const rowid = input.attr('name').match(/quantity\[(.*?)\]/)[1];
        const productId = input.data('product-id');
        let value = parseInt(input.val());
        
        // Validate input
        if (isNaN(value) || value < 1) {
            value = 1;
        } else if (value > 100) {
            value = 100;
        }
        
        input.val(value);
        updateCartItem(rowid, value, productId);
    });

    // Enable checkout button only when shipping is calculated
    $('#service').on('change', function() {
        const selectedService = $(this).val();
        $('#checkout-button').prop('disabled', !selectedService);
    });

    // Cart item removal functionality
    $('.remove-item').click(function(e) {
        e.preventDefault();

        var rowid = $(this).data('rowid');
        var tr = $('.cart-'+ rowid);

        $('.product-name', tr).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

        $.ajax({
            method: 'POST',
            url: '<?php echo site_url('shop/cart_api?action=remove_item'); ?>',
            data: { rowid: rowid },
            success: function (res) {
                if (res.code == 204) {
                    tr.addClass('alert alert-danger');

                    setTimeout(function(e) {
                        tr.hide('fade');

                        $('.n-subtotal').text(res.total.subtotal);
                        $('.n-ongkir').text(res.total.ongkir);
                        $('.n-total').text(res.total.total);
                        
                        // Update subtotal data attribute for shipping calculations
                        $('#subtotal').data('value', res.total.subtotal_raw);
                        
                        // Recalculate shipping if courier is selected
                        if ($('#courier').val()) {
                            calculateShipping();
                        }
                    }, 2000);
                }
            }
        });
    });

    // Trigger shipping calculation when courier changes
    $('#courier').change(function() {
        if ($(this).val()) {
            calculateShipping();
        }
    });

    // Auto-calculate shipping if courier is pre-selected
    if ($('#courier').val()) {
        calculateShipping();
    }
});

$(document).ready(function() {
    // Daftar kurir yang diizinkan
    const allowedCouriers = {
        tiki: 'TIKI',
        jnt: 'J&T',
        jne: 'JNE',
        pos: 'POS Indonesia',
        sicepat: 'SiCepat'
    };

    function filterCourierOptions() {
        $('#courier option').each(function() {
            const val = $(this).val();
            if (val && !allowedCouriers[val]) {
                $(this).remove();
            }
        });
        // Set label sesuai allowedCouriers
        $('#courier option').each(function() {
            const val = $(this).val();
            if (allowedCouriers[val]) {
                $(this).text(allowedCouriers[val]);
            }
        });
    }

    // Jalankan saat halaman siap & setiap kali select berubah
    filterCourierOptions();
    $('#courier').on('DOMSubtreeModified', function() {
        filterCourierOptions();
    });
});
</script>

