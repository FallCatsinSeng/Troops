<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Draft Invoice #<?php echo $order_data->order_number; ?></title>

    <style>
        body {
            position: relative;
            width: 21cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            float: left;
            margin-right: 20px;
        }

        #logo img {
            width: 90px;
        }

        #company-details {
            float: left;
            padding-top: 5px; /* Sesuaikan agar sejajar dengan alamat tujuan */
        }

        #company-details div {
            white-space: nowrap;
        }

        #invoice-to {
            float: right;
            text-align: left;
        }

        #invoice-to div {
            white-space: nowrap;
        }

        h1.title {
            color: #001028;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            margin: 0 0 20px 0;
        }

        .source {
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table.items th,
        table.items td {
            text-align: right;
            padding: 8px 10px;
            border-bottom: 1px solid #C1CED9;
        }

        table.items th {
            background: #F5F5F5;
            white-space: nowrap;
            font-weight: bold;
            text-align: center;
        }

        table.items .desc {
            text-align: left;
        }

        table.totals {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 20px;
        }

        table.totals td {
            text-align: right;
            padding: 5px 10px;
        }

        table.totals .label {
            font-weight: bold;
            width: 85%;
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
        }
        
        table.totals .value {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
        }

        table.totals tr.total td {
            font-weight: bold;
            border-top-width: 2px;
        }

        .comment {
            margin-top: 30px;
            font-size: 1.1em;
            line-height: 1.4;
        }
        footer {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 8px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <?php
            $path = FCPATH . 'assets/uploads/sites/logopdf.png';
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                echo '<img src="' . $base64 . '">';
            }
            ?>
        </div>
        <div id="company-details">
            <div><b>Putra Anggrek (Purwokerto)</b></div>
            <div><?php echo get_formatted_date(date('Y-m-d H:i:s')); ?></div>
            <div style="border-bottom: 1px solid #000; padding-top:2px; width: 150%;">&nbsp;</div>
        </div>
        <div id="invoice-to">
            <?php if (isset($delivery_data->customer->name)) : ?>
                <div><b><?php echo $delivery_data->customer->name; ?></b></div>
                <div><?php echo $delivery_data->customer->address; ?></div>
                <div><?php echo $delivery_data->customer->phone_number; ?></div>
            <?php else : ?>
                <div><b>TROOPS</b></div>
                <div>0</div>
                <div>PURWOKERTO 14</div>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <h1 class="title">Draft Invoice</h1>
        <div class="source">
            <b>Source:</b><br>
            <?php echo $order_data->order_number; ?>
        </div>
        <div class="shipping-details" style="margin-bottom: 20px;">
            <?php if (isset($order_data->courier) && !empty($order_data->courier)) : ?>
                <div><b>Kurir:</b> <?php echo strtoupper($order_data->courier); ?></div>
            <?php endif; ?>
            <?php if (isset($order_data->delivered_date) && !empty($order_data->delivered_date)) : ?>
                <div><b>Tanggal Diterima:</b> <?php echo get_formatted_date($order_data->delivered_date); ?></div>
            <?php endif; ?>
        </div>
        <table class="items">
            <thead>
                <tr>
                    <th class="desc">Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Taxes</th>
                    <th>Tax Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal = 0;
                foreach ($items as $item) :
                    $tax_price = $item->order_price * $item->order_qty;
                    $subtotal += $tax_price;
                ?>
                <tr>
                    <td class="desc"><?php echo $item->name; ?></td>
                    <td><?php echo number_format($item->order_qty, 2); ?> kg</td>
                    <td><?php echo number_format($item->order_price, 0, ',', '.'); ?></td>
                    <td></td> <!-- Kolom pajak dikosongkan sesuai gambar -->
                    <td>Rp <?php echo number_format($tax_price, 2, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table class="totals">
            <tr>
                <td class="label">Subtotal</td>
                <td class="value">Rp <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
            </tr>
            <?php if (isset($order_data->shipping_cost) && $order_data->shipping_cost > 0) : ?>
            <tr>
                <td class="label">Biaya Pengiriman</td>
                <td class="value">Rp <?php echo number_format($order_data->shipping_cost, 2, ',', '.'); ?></td>
            </tr>
            <?php endif; ?>
            <tr class="total">
                <td class="label">Total</td>
                <td class="value">Rp <?php echo number_format($order_data->total_price, 2, ',', '.'); ?></td>
            </tr>
        </table>
        <div class="comment">
            <b>Comment:</b> Rek BCA : 0780-241-241.<br>
            BRI : 033-401-000-401-560<br>
            Mandiri : 138-00-1109-1100<br>
            A/n. : Anung Adi Hari
        </div>
    </main>
    <footer>
        Barang yang sudah dibeli, tidak dapat dikembalikan. Terima Kasih!!! : Purwokerto Transfer Pembelian BRI • : Purwokerto Transfer Pembelian Mandiri
    </footer>
</body>
</html>
