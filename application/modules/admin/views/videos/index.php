<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- HEADER -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Kelola Video</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" data-target="#addModal" data-toggle="modal" class="btn btn-sm btn-neutral">Tambah Video</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- PAGE CONTENT -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('error'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <div class="card">
        <div class="card-header border-0">
          <h3 class="mb-0">Daftar Video</h3>
        </div>

        <div class="table-responsive">
          <table class="table align-items-center table-flush" id="videoList" style="width: 100%">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Judul</th>
                <th>URL</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Style for modal form */
#addModal .modal-content {
    background-color: #fff;
}

#addModal .form-group label {
    color: #000;
    font-weight: 600;
    margin-bottom: 8px;
}

#addModal .form-control {
    border: 1px solid #000;
    color: #000;
    background-color: #fff;
}

#addModal .form-control:focus {
    border: 2px solid #000;
    box-shadow: none;
}

#addModal .text-danger {
    font-size: 0.875rem;
    margin-top: 5px;
}

#addModal h3 {
    color: #000;
    font-weight: 600;
    margin-bottom: 25px;
}
</style>

<!-- MODAL TAMBAH VIDEO -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-center">Tambah Video</h3>
        <form action="<?php echo site_url('admin/videos/add_video'); ?>" method="POST">
          <div class="form-group">
            <label>Judul Video</label>
            <input type="text" name="title" class="form-control" required placeholder="Masukkan judul video">
          </div>
          <div class="form-group">
            <label>URL Video</label>
            <input type="text" name="url" class="form-control" required placeholder="Masukkan URL video">
          </div>
          <div class="text-right mt-4">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL HAPUS VIDEO -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Hapus Video</h6>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <form id="deleteVideoForm">
        <input type="hidden" name="id" class="deleteID">
        <div class="modal-body">
          <p>Yakin ingin menghapus video ini?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
          <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="http://localhost/troops/assets/themes/argon/vendor/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
  var table = $('#videoList').DataTable({
    "processing": true,
    "serverSide": false,
    "ajax": {
      "url": "<?php echo site_url('admin/videos/video_api'); ?>?action=video_list",
      "type": "GET",
      "dataSrc": function(json) {
        return json.data;
      }
    },
    "columns": [
      {"data": "id"},
      {"data": "title"},
      {"data": "url"},
      {"data": "created_at"},
      {
        "data": "id",
        "orderable": false,
        "searchable": false,
        "render": function (data, type, row) {
          return '<div class="text-right"><a href="<?php echo site_url('admin/videos/delete_video/'); ?>' + data + '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus video ini?\')"><i class="fa fa-trash"></i></a></div>';
        }
      }
    ],
    "order": [[3, "desc"]],
    "language": {
      "search": "Cari:",
      "lengthMenu": "Tampilkan _MENU_ data per halaman",
      "zeroRecords": "Tidak ada video ditemukan",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ video",
      "infoEmpty": "Menampilkan 0 sampai 0 dari 0 video",
      "infoFiltered": "(difilter dari _MAX_ total video)",
      "paginate": {
        "first": "&laquo;",
        "last": "&raquo;",
        "next": "&rsaquo;",
        "previous": "&lsaquo;"
      }
    }
  });
});
</script>
