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
.content-wrapperr, .content-wrapperr *, .card-body, .card-header,
.table th, .table td, .table thead th, .table tbody td,
label, h1, h2, h3, h4, h5, h6, .breadcrumb, .breadcrumb a, .content-header, .content-header *,
.modal-content, .modal-title, .modal-body, .modal-body *, .deleteText {
    color: #fff !important;
}

.modal-content {
    background-color: #333 !important;
}

/* Transparent cards and tables */
.card, .table {
    background: rgba(0,0,0,0.3) !important;
    border: none !important;
}

.card-header {
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
                    <h1>Review Order #<?php echo $review->order_number; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
                        <li class="breadcrumb-item"><?php echo anchor('customer/reviews', 'Review'); ?></li>
                        <li class="breadcrumb-item active">Order #<?php echo $review->order_number; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
     <div class="row">
      <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-body p-0">
                <table class="table table-hover table-striped">
                    <tr>
                        <td>Judul</td>
                        <td><b><?php echo $review->title; ?></b></td>
                    </tr>
                    <tr>
                        <td>Order</td>
                        <td><b>#<?php echo $review->order_number; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><b><?php echo get_formatted_date($review->review_date); ?></b></td>
                    </tr>
                    <tr>
                        <td>Review</td>
                        <td><b><?php echo $review->review_text; ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center">
            <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                <i class="fa fa-trash"></i> Hapus
            </a>
        </div>
      </div>
     </div>
    </section>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletelModalLabel">Hapus Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="deleteText">Anda yakin ingin menghapus review?</p>
      </div>
      <div class="modal-footer">
      <?php echo anchor('customer/reviews/delete/'. $review->id, 'Hapus', array('class' => 'btn btn-danger')); ?>
      </div>
    </div>
  </div>
</div>