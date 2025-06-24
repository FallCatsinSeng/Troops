<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/troopsApparel/custom/auth/login/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .w3l-login-form {
            background: rgba(255, 255, 255, 0.9);
            height: auto;
        }
        .otp-input {
            background-color: #ffffff;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            font-size: 24px;
            letter-spacing: 15px;
            text-align: center;
            font-weight: bold;
            color: #495057;
            transition: all 0.3s;
            width: 100%;
        }
        .otp-input:focus {
            border-color: #00BCD4;
            box-shadow: 0 0 0 0.2rem rgba(0, 188, 212, 0.25);
        }
        .btn-verify {
            background: #00BCD4;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-verify:hover {
            background-color: #0097a7;
        }
        .btn-resend {
            color: #00BCD4;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-resend:hover {
            color: #0097a7;
            text-decoration: none;
        }
        .timer {
            color: #495057;
            font-size: 14px;
            margin-top: 10px;
        }
        .icon-verified {
            font-size: 50px;
            color: #00BCD4;
            margin-bottom: 20px;
        }
        .alert {
            border-radius: 6px;
            border: none;
            margin-bottom: 20px;
        }
        .alert-danger {
            background-color: #ffe5e5;
            color: #d32f2f;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #388e3c;
        }
    </style>
</head>
<body>
    <h1>Troops Apparel</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="w3l-login-form">
                    <div class="text-center">
                        <i class="fas fa-lock icon-verified"></i>
                        <h2>Verifikasi Login</h2>
                    </div>
                    
                    <?php if ($this->session->flashdata('otp_error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <?php echo $this->session->flashdata('otp_error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('otp_message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php echo $this->session->flashdata('otp_message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <p class="text-center mb-4" style="color: #495057;">
                        Kami telah mengirimkan kode OTP ke email Anda.<br>
                        Silakan masukkan kode untuk verifikasi.
                    </p>

                    <form action="<?php echo site_url('auth/login/verify_otp'); ?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="otp" class="otp-input" 
                                   placeholder="000000" maxlength="6" 
                                   autocomplete="off" required>
                        </div>

                        <button type="submit" class="btn-verify">
                            <i class="fas fa-check-circle mr-2"></i>Verifikasi
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="timer mb-2">
                            <i class="far fa-clock mr-1"></i>
                            Kode akan kadaluarsa dalam <span id="timer">15:00</span>
                        </p>
                        <a href="<?php echo site_url('auth/login/resend_otp'); ?>" class="btn-resend">
                            <i class="fas fa-redo-alt mr-1"></i>
                            Kirim Ulang OTP
                        </a>
                    </div>
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
        // Timer countdown
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    display.textContent = "00:00";
                }
            }, 1000);
        }

        window.onload = function () {
            var fifteenMinutes = 60 * 15,
                display = document.querySelector('#timer');
            startTimer(fifteenMinutes, display);
        };

        // Auto format OTP input
        document.querySelector('.otp-input').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html> 