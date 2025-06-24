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

.table tr.bg-primary {
    background-color: rgba(0, 0, 0, 0.5) !important;
    border: none !important;
}

/* Links and pagination */
.breadcrumb a,
.table a,
.alert a {
    color: #9ef2ff !important;
    text-decoration: underline;
}

.pagination .page-link {
    background-color: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #fff !important;
}

.pagination .page-item.active .page-link {
    background-color: #28a745;
    border-color: #28a745;
    color: #fff !important;
}
</style>
<div class="content-wrapperr mx-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-5">
                    <h1>Pembayaran Saya</h1>
                </div>
                <div class="col-sm-2">
                    <?php echo anchor('customer/payments/confirm', 'Tambah Pembayaran'); ?>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-body<?php echo ( count($payments) > 0) ? ' p-0' : ''; ?>">
                <?php if ( count($payments) > 0) : ?>
                    <div class="table-responsive">
                    <table class="table table-striped m-0">
                        <tr class="bg-primary">
                            <th scope="col">No.</th>
                            <th scope="col">Order</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">No. Resi</th>
                        </tr>
                        <?php foreach ($payments as $payment) : ?>
                            <tr>
                                <td><?php echo $payment->id; ?></td>
                                <td><?php echo anchor('customer/payments/view/'. $payment->id, '#'. $payment->order_number); ?></td>
                                <td><?php echo get_formatted_date($payment->payment_date); ?></td>
                                <td><?php echo get_payment_status($payment->payment_status); ?></td>
                                <td>
                                    <?php if (!empty($payment->tracking_number) && !empty($payment->courier)) : ?>
                                        <a href="<?php echo site_url('customer/orders/track/'.$payment->tracking_number.'/'.$payment->courier); ?>" 
                                           class="tracking-link" target="_blank">
                                            <?php echo $payment->tracking_number; ?>
                                        </a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    </div>
                <?php else : ?>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            Belum ada data pembayaran
                        </div>

                        <?php echo anchor('customer/payments/confirm', 'Konfirmasi pembayaran baru'); ?>
                    </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($pagination) : ?>
            <div class="card-footer">
                <?php echo $pagination; ?> 
            </div>
            <?php endif; ?>

        </div>
    </section>

</div>