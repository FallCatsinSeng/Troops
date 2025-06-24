<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
body {
    background-image: url('<?php echo base_url("assets/themes/troopsApparel/images/bg login.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    min-height: 100vh;
}

/* General text color */
.content-wrapperr, .content-wrapperr *, .card-body, .card-header, .card-footer,
.table th, .table td, .table thead th, .table tbody td,
label, h1, h2, h3, h4, h5, h6, .breadcrumb, .breadcrumb a, .content-header, .content-header * {
    color: #fff !important;
}

/* Form inputs and selects styling */
select.form-control,
select.form-control option,
input.form-control,
textarea.form-control {
    background-color: rgba(0, 0, 0, 0.5) !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}

select.form-control option {
    color: #000 !important;
}

/* Transparent cards and tables */
.card, .table {
    background: rgba(0,0,0,0.3) !important;
    border: none !important;
}

.card-header, .card-footer {
    background-color: transparent !important;
    border: none !important;
}

/* Links */
.breadcrumb a,
.table a {
    color: #9ef2ff !important;
    text-decoration: underline;
}
</style>
<div class="content-wrapperr mx-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tulis Review</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
                        <li class="breadcrumb-item"><?php echo anchor('customer/reviews', 'Review'); ?></li>
                        <li class="breadcrumb-item active">Tulis Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <?php echo form_open('customer/reviews/write_me'); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="form-control-label">Judul Review</label>
                    <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" id="title" required>
                    <?php echo form_error('title'); ?>
                </div>

                <div class="form-group">
                    <label for="orders" class="form-control-label">Order:</label>
                    <select name="order_id" class="form-control" id="orders">
                        <?php if ( count($orders) > 0) : ?>
                        <?php foreach ($orders as $order) : ?>
                        <option value="<?php echo $order->id; ?>" <?php echo set_select('order_id', $order->id); ?>)>#<?php echo $order->order_number; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="review" class="form-control-label">Review</label>
                    <textarea name="review" class="form-control" id="review" required><?php echo set_value('review'); ?></textarea>
                    <?php echo form_error('review'); ?>
                </div>

            </div>
            <div class="card-footer">
                <input type="submit" value="Tulis Review" class="btn btn-primary">
            </div>
            </form>
        </div>
    </section>

</div>