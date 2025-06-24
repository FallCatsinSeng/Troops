<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Verifikasi OTP</h3>
                        
                        <?php if ($this->session->flashdata('otp_error')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('otp_error'); ?>
                        </div>
                        <?php endif; ?>

                        <p class="text-center">
                            Kami telah mengirimkan kode OTP ke email Anda.<br>
                            Silakan masukkan kode OTP untuk melanjutkan pendaftaran.
                        </p>

                        <form action="<?php echo site_url('auth/register/verify_otp'); ?>" method="POST">
                            <div class="form-group">
                                <input type="text" name="otp" class="form-control text-center" 
                                       placeholder="Masukkan kode OTP" maxlength="6" 
                                       style="font-size: 24px; letter-spacing: 10px;" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Verifikasi</button>
                        </form>

                        <p class="text-center mt-3 mb-0">
                            <small class="text-muted">
                                Kode OTP akan kadaluarsa dalam 15 menit
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html> 