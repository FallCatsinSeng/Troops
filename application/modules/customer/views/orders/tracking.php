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

.table th, .table td, .table thead th, .table tbody td, .table tfoot th, .table tfoot td,
label, h1, h2, h3, h4, h5, h6, .breadcrumb, .breadcrumb a, .content-header, .content-header * {
    color: #fff !important;
}

.table {
    background: rgba(0,0,0,0.3) !important;
}

.breadcrumb a {
    color: #fff !important;
    text-decoration: underline;
}

.card {
    background-color: transparent !important;
    border: none !important;
}

.table thead.thead-light th {
    background-color: rgba(0, 0, 0, 0.5) !important;
    color: #fff !important;
    border: none !important;
}
</style>
<div class="content-wrapperr mx-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tracking Pengiriman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor('customer', 'Home'); ?></li>
                        <li class="breadcrumb-item"><?php echo anchor('customer/payments', 'Pembayaran'); ?></li>
                        <li class="breadcrumb-item active">Tracking</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Tracking</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informasi Pengiriman</h5>
                        <p>
                            <strong>No. Resi:</strong> <?php echo $waybill; ?><br>
                            <strong>Kurir:</strong> <?php echo $courier; ?><br>
                            <?php if (isset($tracking_data->status)): ?>
                            <strong>Status:</strong> 
                            <span class="badge <?php echo $tracking_data->status === 'delivered' ? 'badge-success' : 'badge-info'; ?>">
                                <?php 
                                $status_map = [
                                    'picking_up' => 'Sedang Dijemput',
                                    'picked' => 'Sudah Dijemput',
                                    'dropping_off' => 'Dalam Pengiriman',
                                    'on_hold' => 'Ditahan',
                                    'delivered' => 'Terkirim'
                                ];
                                echo isset($status_map[$tracking_data->status]) ? $status_map[$tracking_data->status] : ucfirst($tracking_data->status);
                                ?>
                            </span>
                            <?php endif; ?>
                        </p>
                        <?php if (isset($tracking_data->origin) || isset($tracking_data->destination)): ?>
                        <div class="mt-3">
                            <?php if (isset($tracking_data->origin)): ?>
                            <p>
                                <strong>Pengirim:</strong><br>
                                <?php echo $tracking_data->origin->contact_name; ?><br>
                                <?php echo $tracking_data->origin->address; ?>
                            </p>
                            <?php endif; ?>
                            
                            <?php if (isset($tracking_data->destination)): ?>
                            <p>
                                <strong>Penerima:</strong><br>
                                <?php echo $tracking_data->destination->contact_name; ?><br>
                                <?php echo $tracking_data->destination->address; ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!$tracking_data->success) : ?>
                    <div class="alert alert-danger">
                        <?php 
                        if (is_object($tracking_data) && isset($tracking_data->error)) {
                            echo is_string($tracking_data->error) ? $tracking_data->error : $tracking_data->error->message;
                        } else {
                            echo "Gagal mendapatkan data tracking. Silakan coba lagi nanti.";
                        }
                        ?>
                    </div>
                <?php else : ?>
                    <?php if (empty($tracking_data->history)) : ?>
                        <div class="alert alert-info">
                            Tidak ada data tracking yang tersedia saat ini.
                        </div>
                    <?php else : ?>
                        <div class="timeline">
                            <?php 
                            $history = array_reverse($tracking_data->history); // Reverse to show newest first
                            foreach ($history as $track) : 
                                $timestamp = new DateTime($track->updated_at);
                            ?>
                                <div class="time-label">
                                    <span class="bg-primary"><?php echo $timestamp->format('d M Y'); ?></span>
                                </div>
                                <div>
                                    <i class="fas <?php 
                                        switch($track->status) {
                                            case 'delivered':
                                                echo 'fa-check bg-success';
                                                break;
                                            case 'picking_up':
                                                echo 'fa-truck-loading bg-warning';
                                                break;
                                            case 'picked':
                                                echo 'fa-box bg-info';
                                                break;
                                            case 'on_hold':
                                                echo 'fa-pause-circle bg-danger';
                                                break;
                                            default:
                                                echo 'fa-shipping-fast bg-blue';
                                        }
                                    ?>"></i>
                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="fas fa-clock"></i> 
                                            <?php echo $timestamp->format('H:i'); ?>
                                        </span>
                                        <h3 class="timeline-header">
                                            <?php 
                                            echo isset($status_map[$track->status]) ? $status_map[$track->status] : ucfirst($track->status);
                                            ?>
                                        </h3>
                                        <div class="timeline-body">
                                            <?php echo $track->note; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div> 