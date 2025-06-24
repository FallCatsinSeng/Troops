<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ID-id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>

    <!-- Original theme CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/aos.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/style.css'); ?>">

    <!-- AdminLTE and New Header CSS -->
    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/fontawesome-free/css/all.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/adminlte.min.css', 'adminlte'); ?>">
    <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/select2js/dist/css/select2.min.css', 'adminlte'); ?>">

    <link rel="icon" href="<?php echo base_url('assets/uploads/sites/Logo.jpg'); ?>" type="image/icon">

    <script src="<?php echo get_theme_uri('js/jquery.min.js'); ?>"></script>
    <script src="<?php echo get_theme_uri('js/jquery-migrate-3.0.1.min.js'); ?>"></script>
    <script src="<?php echo get_theme_uri('plugins/bootstrap/js/bootstrap.bundle.min.js', 'adminlte'); ?>"></script>
    <script>
        var siteUrl = '<?php echo site_url(); ?>';
    </script>
    <script src="<?php echo get_theme_uri('js/cart.js'); ?>"></script>

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
            width: 200px;
            height: 120px;
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

<body class="goto-here">
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text"><?php echo get_settings('store_phone_number'); ?></span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text"><?php echo get_settings('store_email'); ?></span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text"><?php echo get_settings('store_tagline'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">TroopsShop</a>
            <div class="d-flex">
                <?php if ($this->session->userdata('__ACTIVE_SESSION_DATA')) : ?>
                    <!-- Menu untuk user yang sudah login -->
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
                <?php else : ?>
                    <!-- Menu untuk user yang belum login -->
                    <a href="<?php echo site_url('auth/login'); ?>" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="<?php echo site_url('auth/register'); ?>" class="nav-link"><i class="fas fa-user-plus"></i> Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</body>
</html>