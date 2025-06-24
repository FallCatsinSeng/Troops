<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Profil Saya</h4>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo current_url(); ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo set_value('name', isset($user->name) ? $user->name : ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" 
                                   value="<?php echo isset($user->email) ? $user->email : ''; ?>" readonly>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">No. HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                   value="<?php echo set_value('phone_number', isset($customer->phone_number) ? $customer->phone_number : ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo set_value('address', isset($customer->address) ? $customer->address : ''); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="kode_pos">Kode Pos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" 
                                   value="<?php echo set_value('kode_pos', isset($customer->kode_pos) ? $customer->kode_pos : ''); ?>" 
                                   pattern="[0-9]{5}" maxlength="5" required>
                            <small class="text-muted">Masukkan 5 digit kode pos untuk alamat pengiriman Anda</small>
                            <?php if (empty($customer->kode_pos)): ?>
                                <div class="alert alert-warning mt-2">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Kode pos diperlukan untuk menghitung ongkos kirim. Silakan isi kode pos Anda.
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 