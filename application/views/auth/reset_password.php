<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/themes/troopsApparel/custom/auth/login/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .w3l-login-form {
            background: rgba(255, 255, 255, 0.9);
            height: auto;
            padding: 40px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #e9ecef;
        }
        .form-control:focus {
            border-color: #00BCD4;
            box-shadow: 0 0 0 0.2rem rgba(0, 188, 212, 0.25);
        }
        .btn-reset {
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
        .btn-reset:hover {
            background-color: #0097a7;
            color: white;
        }
        .icon-lock {
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
        .password-toggle {
            cursor: pointer;
            border: 2px solid #e9ecef;
            border-left: none;
            background: white;
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
                        <i class="fas fa-lock icon-lock"></i>
                        <h2>Reset Password</h2>
                    </div>

                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('auth/forgotpassword/update_password'); ?>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <span class="input-group-text password-toggle" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <button type="submit" class="btn-reset">
                            <i class="fas fa-key me-2"></i>Reset Password
                        </button>
                    <?php echo form_close(); ?>
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
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html> 