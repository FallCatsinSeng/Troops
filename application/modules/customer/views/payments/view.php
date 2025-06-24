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
.content-wrapperr, .content-wrapperr *, .card-body, .card-header,
.table th, .table td, .table thead th, .table tbody td,
label, h1, h2, h3, h4, h5, h6, .breadcrumb, .breadcrumb a, .content-header, .content-header * {
    color: #fff !important;
}

/* Transparent cards and tables */
.card, .table {
    background: rgba(0,0,0,0.3) !important;
    border: none !important;
}

.card-header {
    background-color: transparent !important;
    border: none !important;
}

/* Links */
.breadcrumb a,
.table a,
a.tracking-link {
    color: #9ef2ff !important;
    text-decoration: underline;
}
</style>
<div class="content-wrapperr mx-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pembayaran Order #<?php echo $data->order_number; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor('customer', 'Home'); ?></li>
                        <li class="breadcrumb-item active"><?php echo anchor('customer/payments', 'Pembayaran'); ?></li>
                        <li class="breadcrumb-item active">Order #<?php echo $data->order_number; ?></li>
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
                        <h5 class="card-heading">Data Order</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped table-hover">
                            <tr>
                                <td>Order</td>
                                <td>#<b><?php echo $data->order_number; ?></b></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><b><?php echo get_formatted_date($data->payment_date); ?></b></td>
                            </tr>
                            <tr>
                                <td>Jumlah transfer</td>
                                <td><b>Rp <?php echo format_rupiah($data->payment_price); ?></b></td>
                            </tr>
                            <tr>
                                <td>Transfer dari</td>
                                <td><b>
                                    <?php
                                    if (isset($payment->source)) {
                                        echo $payment->source->bank . ' a.n ' . $payment->source->name . ' (' . $payment->source->number . ')';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </b></td>
                            </tr>
                            <tr>
                                <td>Transfer ke</td>
                                <td><b>
                                    <?php
                                        $transfer_to = $payment->transfer_to;
                                        $transfer_to = $banks[$transfer_to];
                                        
                                    ?>
                                    <?php echo $transfer_to->bank; ?> a.n <?php echo $transfer_to->name; ?> (<?php echo $transfer_to->number; ?>)
                                </b></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><b><?php echo get_payment_status($data->payment_status); ?></b></td>
                            </tr>
                            <?php if (!empty($data->tracking_number)) : ?>
                            <tr>
                                <td>No. Resi</td>
                                <td>
                                    <b>
                                        <a href="<?php echo site_url('customer/orders/track/'.$data->tracking_number.'/'.$data->courier); ?>" 
                                           class="tracking-link" target="_blank">
                                            <?php echo $data->tracking_number; ?>
                                        </a>
                                    </b>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="card-heading">Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img alt="Pembayaran order #<?php echo $data->order_number; ?>" class="img img-fluid" src="<?php echo base_url('assets/uploads/payments/'. $data->picture_name); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>