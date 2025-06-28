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

/* General text color */
.content-wrapperr, .content-wrapperr *, .card-body, .card-header, .card-footer,
.table th, .table td, .table thead th, .table tbody td,
label, h1, h2, h3, h4, h5, h6, .breadcrumb, .breadcrumb a, .content-header, .content-header * {
    color: #fff !important;
}

/* Form inputs and selects styling */
select.form-control,
select.form-control option,
input.form-control {
    background-color: rgba(0, 0, 0, 0.5) !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}

select.form-control option {
    color: #000 !important;
}

.alert.alert-info, .alert.alert-info * {
    color: #0c5460 !important;
}

/* Transparent cards and tables */
.card, .table {
    background: rgba(0,0,0,0.3) !important;
    border: none !important;
}

.card-header, .card-footer {
    background-color: transparent !important;
    border: none !important;
}

/* Links */
.breadcrumb a,
.table a {
    color: #9ef2ff !important;
    text-decoration: underline;
}
</style>
<div class="content-wrapperr mx-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfirmasi Pembayaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor('customer', 'Home'); ?></li>
                        <li class="breadcrumb-item active"><?php echo anchor('customer/payments', 'Pembayaran'); ?></li>
                        <li class="breadcrumb-item active">Konfirmasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-heading">Data Pembayaran</h5>
                    </div>
                    <?php echo form_open_multipart('customer/payments/do_confirm'); ?>
                    <div class="card-body">
                        <?php if ($flash) : ?>
                        <div class="alert alert-info"><?php echo $flash; ?></div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label class="form-control-label" for="orders">Order:</label>
                            <?php if ( count($orders) > 0) : ?>
                            <select name="order_id" class="form-control" id="orders">
                                <?php foreach ($orders as $order) : ?>
                                    <option value="<?php echo $order->id; ?>" data-price="<?php echo $order->total_price; ?>" <?php echo set_select('order_id', $order->id, ($order_id == $order->id) ? TRUE : FALSE); ?>>#<?php echo $order->order_number; ?> (Rp <?php echo format_rupiah($order->total_price); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <?php else : ?>
                                <div class="text-danger font-weight-bold">Belum ada data order.</div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-control-label">Jumlah Transfer:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"  style="background-color: #000; opacity: 75%;">Rp</span>
                                </div>
                                <?php
                                $order_total = '';
                                if (isset($order_id) && !empty($order_id) && !empty($orders)) {
                                    foreach ($orders as $order) {
                                        if ($order->id == $order_id) {
                                            $order_total = $order->total_price;
                                            break;
                                        }
                                    }
                                }
                                ?>
                                <input type="text" name="transfer" value="<?php echo set_value('transfer', $order_total); ?>" class="form-control" id="price" readonly required>
                                <?php echo form_error('transfer'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="to">Transfer ke</label>
                            <?php if ( count($banks) > 0) : ?>
                            <select name="bank" class="form-control" id="orders">
                                <?php foreach ($banks as $bank => $data) : ?>
                                    <option value="<?php echo $bank; ?>"<?php echo set_select('bank', $bank); ?>><?php echo $data->bank; ?> a.n <?php echo $data->name; ?> (<?php echo $data->number; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <?php else : ?>
                                <div class="text-danger font-weight-bold">Belum ada data bank.</div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="pic" class="form-control-label">Bukti pembayaran:</label>
                            <input type="file" name="picture" class="form-control" required>
                            <?php echo form_error('picture'); ?>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" value="Konfirmasi" class="btn btn-primary">
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card card-header">
                        <h5 class="card-heading">Pembayaran saya</h5>
                    </div>
                    <div class="card-body p-0">
                      <?php if ( count($payments) > 0) : ?>
                        <table class="table table-condensed table-striped">
                          <?php foreach ($payments as $payment) : ?>
                            <tr>
                                <td>#</td>
                                <td>
                                    <?php echo anchor('customer/payments/view/'. $payment->id, 'Order #'. $payment->order_number); ?>
                                </td>
                                <td>
                                  <?php if ($payment->payment_status == 1) : ?>
                                    <span class="badge badge-warning text-white">Menunggu konfirmasi</span>
                                  <?php elseif ($payment->payment_status == 2) : ?>
                                    <span class="badge badge-success text-white">Dikonfirmasi</span>
                                  <?php elseif ($payment->payment_status == 3) : ?>
                                    <span class="badge badge-danger text-white">Gagal mengonfirmasi</span>
                                  <?php endif; ?>
                                </td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      <?php else : ?>
                        <div class="m-3 alert alert-info">Belum ada data pembayaran.</div>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
document.getElementById('orders').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var price = selectedOption.getAttribute('data-price');
    document.getElementById('price').value = price;
});
</script>