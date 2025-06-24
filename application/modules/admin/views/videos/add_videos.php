<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Tambah Video Baru</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/videos'); ?>">Video</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <?php echo form_open_multipart('admin/videos/add_video'); ?>

  <div class="row">
    <div class="col-md-8">
      <div class="card-wrapper">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Data Video</h3>
          </div>

          <div class="card-body">
            <div class="form-group">
              <label class="form-control-label" for="title">Judul Video:</label>
              <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" id="title">
              <?php echo form_error('title'); ?>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="link">Link YouTube:</label>
              <input type="text" name="link" value="<?php echo set_value('link'); ?>" class="form-control" id="link">
              <?php echo form_error('link'); ?>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="desc">Deskripsi Video:</label>
              <textarea name="description" class="form-control" id="desc"><?php echo set_value('description'); ?></textarea>
              <?php echo form_error('description'); ?>
            </div>
          </div>

        </div>

      </div>

    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Thumbnail</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-control-label" for="thumb">Thumbnail:</label>
            <input type="file" name="thumbnail" class="form-control" id="thumb">
            <small class="text-muted">Pilih gambar PNG/JPG maksimal 2MB</small>
          </div>
        </div>
        <div class="card-footer text-right">
          <input type="submit" value="Tambah Video" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>

  </form>
</div>
