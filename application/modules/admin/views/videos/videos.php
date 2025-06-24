<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Kelola Video</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/products'); ?>">Produk</a></li>
              <li class="breadcrumb-item active" aria-current="page">Video</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-neutral">Tambah</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Daftar Video</h3>
        </div>

        <div class="packageContainer">
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table align-items-center table-flush" id="videoList" style="width: 100%">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Judul</th>
                  <th scope="col">URL</th>
                  <th scope="col">Tanggal Dibuat</th>
                  <th scope="col"></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

<!-- Modal untuk Tambah Video -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Tambah Video</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <form role="form" action="#" method="POST" id="addVideoForm">

              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                  </div>
                  <input name="title" class="form-control" placeholder="Judul Video" type="text" maxlength="255" required>
                </div>
                <div class
