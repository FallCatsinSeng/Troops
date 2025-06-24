<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
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
        }
        .btn-success {
            border-radius: 10px;
            padding: 12px;
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            border: none;
            transition: transform 0.2s;
        }
        .btn-success:hover {
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mb-0">Lupa Password</h3>
                    </div>
                    <div class="card-body">
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

                        <?php echo form_open('auth/forgotpassword/send_otp'); ?>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Kode OTP
                                </button>
                            </div>
                        <?php echo form_close(); ?>

                        <div class="text-center mt-4">
                            <a href="<?php echo base_url('auth/login'); ?>" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 