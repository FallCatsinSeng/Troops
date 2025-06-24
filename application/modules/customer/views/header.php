<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="ID-id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>

    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/fontawesome-free/css/all.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/adminlte.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/select2js/dist/css/select2.min.css', 'adminlte'); ?>">

    <link rel="icon" href="<?php echo base_url('assets/uploads/static/icon.png'); ?>" type="image/icon">

    <script src="<?php echo get_theme_uri('plugins/jquery/jquery.min.js', 'adminlte'); ?>"></script>
    <script src="<?php echo get_theme_uri('plugins/bootstrap/js/bootstrap.bundle.min.js', 'adminlte'); ?>"></script>

    <style>
        .navbar {
            background-color: black;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .dashboard-menu {
    display: flex;
    justify-content: space-around;
    gap: 15px;
    margin: 20px 0;
    flex-wrap: wrap;
}

.dashboard-menu .card {
    width: 200px; /* Atur ukuran tetap */
    height: 120px; /* Sesuaikan tinggi */
    text-align: center;
    padding: 10px;
    border-radius: 10px;
    transition: 0.3s;
}

.dashboard-menu .card i {
    font-size: 30px;
    margin-bottom: 5px;
}

.dashboard-menu .card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

    </style>
</head>
<body class="hold-transition layout-fixed">
    <div class="wrapper">

        <!-- Navbar (Tanpa Sidebar) -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo site_url('customer/home'); ?>">TroopsShop</a>
                <div class="d-flex">
                <a href="<?php echo site_url('customer/customer'); ?>" class="nav-link"><i class="fas fa-box"></i> Home </a>

                    <a href="<?php echo site_url('customer/orders'); ?>" class="nav-link"><i class="fas fa-box"></i> Order Saya</a>
                    <a href="<?php echo site_url('customer/payments'); ?>" class="nav-link"><i class="fas fa-wallet"></i> Pembayaran</a>
                    <a href="<?php echo site_url('customer/reviews'); ?>" class="nav-link"><i class="fas fa-star"></i> Review</a>
                    <a href="<?php echo site_url('shop/cart'); ?>" class="nav-link"><i class="fas fa-shopping-cart"></i> Keranjang</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> Akun
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                            <a class="dropdown-item" href="<?php echo site_url('customer/profile'); ?>">
                                <i class="fas fa-user-circle mr-2"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <!-- Dashboard Menu di Atas -->

