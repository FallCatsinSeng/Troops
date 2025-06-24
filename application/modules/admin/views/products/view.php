<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0"><?php echo $product->name; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="<?php echo site_url('admin/products'); ?>">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?php echo $product->name; ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-md-12">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Data Produk</h3>
                <?php if ($flash) : ?>
                <span class="float-right text-success font-weight-bold" style="margin-top: -30px">
                  <?php echo $flash; ?>
                </span>
                <?php endif; ?>
              </div>
              <div class="card-body p-0">
                <div>
                    <div id="adminProductCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
                            $images = explode(',', $product->picture_name);
                            foreach($images as $index => $image): 
                                $image = trim($image);
                                if(empty($image)) continue;
                            ?>
                            <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                                <img src="<?php echo base_url('assets/uploads/products/'. $image); ?>" 
                                     class="d-block w-100 img-fluid rounded" 
                                     alt="<?php echo $product->name . ' ' . ($index + 1); ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#adminProductCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#adminProductCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <table class="table table-hover table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><b><?php echo $product->name; ?></b></td>
                    </tr>
                    <tr>
                        <td>SKU</td>
                        <td>:</td>
                        <td><b><?php echo $product->sku; ?></b></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><b>Rp <?php echo format_rupiah($product->price); ?></b></td>
                    </tr>
                    <tr>
                        <td>Diskon</td>
                        <td>:</td>
                        <td><b>Rp <?php echo format_rupiah($product->current_discount); ?> (<?php echo count_percent_discount($product->current_discount, $product->price, 2); ?> %)</b></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><b><?php echo anchor('admin/products?category_id='. $product->category_id, $product->category_name); ?></b></td>
                    </tr>
                    <tr>
                        <td>Stok / Satuan</td>
                        <td>:</td>
                        <td><b>
                            <?php echo ($product->stock > 0) ? $product->stock .' '. $product->product_unit : 'Stok habis'; ?>
                        </b></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><b><?php echo $product->description; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tersedia</td>
                        <td>:</td>
                        <td>
                          <?php echo ($product->is_available == 1) ? '<b class="text-success">Tersedia</b>' : '<b class="text-danger">Tidak</b>'; ?>
                        </td>
                    </tr>
                </table>
              </div>
              <div class="card-footer text-right">
                  <a href="<?php echo site_url('admin/products/edit/'. $product->id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                  <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </div>
              
            </div>
            
          </div>

        </div>
      </div>

      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Hapus Produk</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="#" id="deleteProductForm" method="POST">
        
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">

          <div class="modal-body">
              <p class="deleteText">Yakin ingin menghapus produk ini? Semua data yang terkait seperti data order juga akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
              <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
          </div>
          </form>
      </div>
  </div>
</div>

<!-- Modal Add Image -->
<div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addImageModalLabel">Tambah Gambar Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('admin/products/add_image/' . $product->id); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Gambar (Max 3 gambar):</label>
                        <input type="file" name="product_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Format: JPG, PNG. Ukuran maksimal: 2MB</small>
                    </div>
                    <?php if(count($images) >= 3): ?>
                    <div class="alert alert-warning">
                        Maksimal 3 gambar sudah tercapai. Hapus gambar yang ada untuk menambah gambar baru.
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" <?php echo (count($images) >= 3) ? 'disabled' : ''; ?>>Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#deleteProductForm').submit(function(e) {
        e.preventDefault();

        var btn = $('.btn-delete');
        var data = $(this).serialize();

        btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...').attr('disabled', true);

        $.ajax({
            method: 'POST',
            url: '<?php echo site_url('admin/products/product_api?action=delete_product'); ?>',
            data: data,
            success: function (res) {
                if (res.code == 204) {
                    setTimeout(function() {
                        btn.html('<i class="fa fa-check"></i> Terhapus!');
                        $('.deleteText').fadeOut(function() {
                            $(this).text('Produk berhasil dihapus')
                        }).fadeIn();
                    }, 2000);

                    setTimeout(function() {
                        $('.deleteText').fadeOut(function() {
                            $(this).text('Mengalihkan...')
                        }).fadeIn();
                    }, 4000);

                    setTimeout(function() {
                        window.location = '<?php echo site_url('admin/products'); ?>';
                    }, 6000);
                }
                else {
                    console.log('Terjadi kesalahan sata menghapus produk');
                }
            }
        })
    })

    // Handle image deletion
    $('.delete-image').click(function(e) {
        e.preventDefault();
        
        if(!confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
            return;
        }
        
        var imageId = $(this).data('id');
        var btn = $(this);
        
        $.ajax({
            url: '<?php echo site_url('admin/products/delete_image/'); ?>' + imageId,
            type: 'POST',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus gambar');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus gambar');
            }
        });
    });
</script>