<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Kelola Order</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <button id="refresh-shipping" class="btn btn-sm btn-neutral">Refresh Status Pengiriman</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">Kelola Order</h3>
          <?php if (count($orders) > 0) : ?>
            <div class="row">
              <div class="col-md-6">
                <form action="<?php echo site_url('admin/orders'); ?>" method="GET">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="search_query" value="<?php echo isset($search_query) ? htmlspecialchars($search_query) : ''; ?>">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <?php if (count($orders) > 0) : ?>
          <div class="card-body p-0">
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah Item</th>
                    <th scope="col">Jumlah Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Status Pembayaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($orders as $order) : ?>
                    <tr>
                      <th scope="col">
                        <?php echo anchor('admin/orders/view/' . $order->id, '#' . $order->order_number); ?>
                      </th>
                      <td><?php echo $order->customer; ?></td>
                      <td>
                        <?php echo get_formatted_date($order->order_date); ?>
                      </td>
                      <td>
                        <?php echo $order->total_items; ?>
                      </td>
                      <td>
                        Rp <?php echo format_rupiah($order->total_price); ?>
                      </td>
                      <td><?php echo get_order_status($order->order_status, $order->payment_method); ?></td>
                      <td><?php echo get_payment_status($order->payment_status); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <?php echo $pagination; ?>
          </div>
        <?php else : ?>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <div class="alert alert-primary">
                  Belum ada data produk yang dibuat. Silahkan menambahkan baru.
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

<script>
$(document).ready(function() {
    $('#refresh-shipping').on('click', function() {
        var btn = $(this);
        btn.prop('disabled', true);
        btn.html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...');

        $.ajax({
            url: '<?php echo site_url('admin/orders/check_shipping_status'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (response.updated > 0) {
                        alert('Berhasil memperbarui ' + response.updated + ' status pengiriman');
                        location.reload();
                    } else {
                        alert('Tidak ada status pengiriman yang perlu diperbarui');
                    }
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat memperbarui status');
            },
            complete: function() {
                btn.prop('disabled', false);
                btn.html('Refresh Status Pengiriman');
            }
        });
    });
});
</script>
</div>