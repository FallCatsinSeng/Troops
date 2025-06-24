<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("<?php echo base_url('assets/themes/troopsApparel/images/bg login.jpg'); ?>");
            background-repeat: no-repeat;
            background-position: 0px 0px;
            min-height: 100vh;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        }
        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 20px;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            font-size: 24px;
            letter-spacing: 10px;
        }
        .btn-primary {
            border-radius: 10px;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
        }
        .icon-verified {
            font-size: 50px;
            color: #667eea;
            margin-bottom: 20px;
        }
        .timer {
            color: #6c757d;
            font-size: 14px;
            margin-top: 10px;
        }
        .btn-resend {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-resend:hover {
            color: #764ba2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-key icon-verified"></i>
                            <h3 class="mb-4">Verifikasi Reset Password</h3>
                        </div>

                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <p class="text-center text-muted mb-4">
                            Kami telah mengirimkan kode OTP ke email Anda.<br>
                            Silakan masukkan kode untuk melanjutkan reset password.
                        </p>

                        <?php echo form_open('auth/forgotpassword/verify_otp'); ?>
                            <div class="form-group mb-4">
                                <input type="text" name="otp" class="form-control" 
                                       placeholder="000000" maxlength="6" 
                                       autocomplete="off" required>
                                <?php echo form_error('otp', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-circle me-2"></i>Verifikasi
                                </button>
                            </div>
                        <?php echo form_close(); ?>

                        <div class="text-center mt-4">
                            <p class="timer mb-2">
                                <i class="far fa-clock me-1"></i>
                                Kode akan kadaluarsa dalam <span id="timer">15:00</span>
                            </p>
                            <a href="<?php echo site_url('auth/forgotpassword/resend_otp'); ?>" class="btn-resend">
                                <i class="fas fa-redo-alt me-1"></i>
                                Kirim Ulang OTP
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        document.querySelector('input[name="otp"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html> 