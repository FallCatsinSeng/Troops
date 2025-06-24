<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Berhasil Diubah</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/troopsApparel/custom/auth/login/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("<?php echo base_url('assets/themes/troopsApparel/images/bg login.jpg'); ?>");
            background-repeat: no-repeat;
            background-position: 0px 0px;
            min-height: 100vh;
            background-size: cover;
        }
        .w3l-login-form {
            background: rgba(255, 255, 255, 0.9);
            height: auto;
            padding: 40px;
        }
        .success-icon {
            font-size: 80px;
            color: #00BCD4;
            margin-bottom: 20px;
        }
        .success-message {
            color: #00BCD4;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .redirect-message {
            color: #495057;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .countdown {
            font-size: 18px;
            color: #00BCD4;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Troops Apparel</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="w3l-login-form text-center">
                    <i class="fas fa-key success-icon"></i>
                    <h3 class="success-message">Password Berhasil Diubah!</h3>
                    <p class="redirect-message">
                        Password Anda telah berhasil diperbarui.<br>
                        Anda akan dialihkan ke halaman login dalam <span class="countdown" id="countdown">3</span> detik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p class="copyright-agileinfo">© 2024 Troops Apparel. All Rights Reserved</p>
    </footer>

    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        // Countdown timer
        var timeLeft = 3;
        var countdownEl = document.getElementById('countdown');
        
        var countdownTimer = setInterval(function() {
            if(timeLeft <= 0) {
                clearInterval(countdownTimer);
                window.location.href = '<?php echo site_url('auth/login'); ?>';
            }
            countdownEl.textContent = timeLeft;
            timeLeft -= 1;
        }, 1000);
    </script>
</body>
</html> 