<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Berhasil</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/troopsApparel/custom/auth/login/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
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
                    <i class="fas fa-check-circle success-icon"></i>
                    <h3 class="success-message">Verifikasi Berhasil!</h3>
                    <p class="redirect-message">
                        <?php echo $message; ?><br>
                        Anda akan dialihkan dalam <span class="countdown" id="countdown">5</span> detik.
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
        var timeLeft = 5;
        var countdownEl = document.getElementById('countdown');
        
        var countdownTimer = setInterval(function() {
            if(timeLeft <= 0) {
                clearInterval(countdownTimer);
                window.location.href = '<?php echo $redirect_url; ?>';
            }
            countdownEl.textContent = timeLeft;
            timeLeft -= 1;
        }, 1000);
    </script>
</body>
</html> 