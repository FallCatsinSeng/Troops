<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Order #<?php echo $data->order_number; ?></h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo site_url('admin/orders/pdf/' . $data->id); ?>" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">

  <div class="row">
    <div class="col-md-8">
      <div class="card-wrapper">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Data Order</h3>
            <?php if ($order_flash) : ?>
              <span class="float-right text-success font-weight-bold" style="margin-top: -30px;"><?php echo $order_flash; ?></span>
            <?php endif; ?>
          </div>

          <div class="card-body p-0">
            <table class="table align-items-center table-flush table-striped">
              <tr>
                <td>Nomor</td>
                <td><b>#<?php echo $data->order_number; ?></b></td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td><b><?php echo get_formatted_date($data->order_date); ?></b></td>
              </tr>
              <tr>
                <td>Item</td>
                <td><b><?php echo $data->total_items; ?></b></td>
              </tr>
              <tr>
                <td>Harga</td>
                <td><b>Rp <?php echo format_rupiah($data->total_price); ?></b></td>
              </tr>
              <tr>
                <td>Metode pembayaran</td>
                <td><b><?php echo ($data->payment_method == 1) ? 'Transfer bank' : 'Bayar ditempat'; ?></b></td>
              </tr>
              <tr>
                <td>Kurir</td>
                <td><b><?php echo $data->courier ? ucfirst($data->courier) : '-'; ?></b></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><b class="statusField"><?php echo get_order_status($data->order_status, $data->payment_method); ?></b></td>
              </tr>
            </table>
          </div>
          <div class="card-footer">
            <form action="<?php echo site_url('admin/orders/status'); ?>" method="POST">
              <input type="hidden" name="order" value="<?php echo $data->id; ?>">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <?php if ($data->payment_method == 1) : ?>
                      <select class="form-control" id="status" name="status" style="opacity: 0; position: absolute;">
                        <option value="2" <?php echo ($data->order_status == 2) ? ' selected' : ''; ?>>Dalam proses</option>
                        <option value="3" <?php echo ($data->order_status == 3) ? ' selected' : ''; ?>>Dalam pengiriman</option>
                        <option value="4" <?php echo ($data->order_status == 4) ? ' selected' : ''; ?>>Selesai</option>
                        <option value="5" <?php echo ($data->order_status == 5) ? ' selected' : ''; ?>>Batalkan</option>
                      </select>
                    <?php else : ?>
                      <select class="form-control" id="status" name="status">
                        <option value="1" <?php echo ($data->order_status == 1) ? ' selected' : ''; ?>>Dalam proses</option>
                        <option value="2" <?php echo ($data->order_status == 2) ? ' selected' : ''; ?>>Dalam pengiriman</option>
                        <option value="3" <?php echo ($data->order_status == 3) ? ' selected' : ''; ?>>Selesai</option>
                        <option value="4" <?php echo ($data->order_status == 4) ? ' selected' : ''; ?>>Batalkan</option>
                      </select>
                    <?php endif; ?>
                  </div>
                  
                  <div class="form-group">
                    <select class="form-control" id="courier" name="courier">
                      <option value="">Pilih Kurir</option>
                      <option value="gojek" <?php echo ($data->courier == 'gojek') ? ' selected' : ''; ?>>Gojek</option>
                      <option value="grab" <?php echo ($data->courier == 'grab') ? ' selected' : ''; ?>>Grab</option>
                      <option value="deliveree" <?php echo ($data->courier == 'deliveree') ? ' selected' : ''; ?>>Deliveree</option>
                      <option value="jne" <?php echo ($data->courier == 'jne') ? ' selected' : ''; ?>>JNE</option>
                      <option value="tiki" <?php echo ($data->courier == 'tiki') ? ' selected' : ''; ?>>TIKI</option>
                      <option value="ninja" <?php echo ($data->courier == 'ninja') ? ' selected' : ''; ?>>Ninja</option>
                      <option value="lion" <?php echo ($data->courier == 'lion') ? ' selected' : ''; ?>>Lion Parcel</option>
                      <option value="sicepat" <?php echo ($data->courier == 'sicepat') ? ' selected' : ''; ?>>SiCepat</option>
                      <option value="jnt" <?php echo ($data->courier == 'jnt') ? ' selected' : ''; ?>>J&T</option>
                      <option value="idexpress" <?php echo ($data->courier == 'idexpress') ? ' selected' : ''; ?>>ID Express</option>
                      <option value="rpx" <?php echo ($data->courier == 'rpx') ? ' selected' : ''; ?>>RPX</option>
                      <option value="jdl" <?php echo ($data->courier == 'jdl') ? ' selected' : ''; ?>>JDL Express</option>
                      <option value="wahana" <?php echo ($data->courier == 'wahana') ? ' selected' : ''; ?>>Wahana</option>
                      <option value="pos" <?php echo ($data->courier == 'pos') ? ' selected' : ''; ?>>POS Indonesia</option>
                      <option value="anteraja" <?php echo ($data->courier == 'anteraja') ? ' selected' : ''; ?>>AnterAja</option>
                      <option value="sap" <?php echo ($data->courier == 'sap') ? ' selected' : ''; ?>>SAP Express</option>
                      <option value="paxel" <?php echo ($data->courier == 'paxel') ? ' selected' : ''; ?>>Paxel</option>
                      <option value="borzo" <?php echo ($data->courier == 'borzo') ? ' selected' : ''; ?>>Borzo</option>
                      <option value="lalamove" <?php echo ($data->courier == 'lalamove') ? ' selected' : ''; ?>>Lalamove</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" id="tracking_number" name="tracking_number" 
                           placeholder="Nomor Resi" value="<?php echo $data->tracking_number; ?>">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="text-right">
                    <input type="submit" value="OK" class="btn btn-md btn-primary">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="mb-0">Barang dalam pesanan</h3>
          </div>
          <div class="card-body p-0">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Produk</th>
                  <th scope="col">Jumlah beli</th>
                  <th scope="col">Harga satuan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $item) : ?>
                  <tr>
                    <td>
                      <img class="img img-fluid rounded" style="width: 60px; height: 60px;" alt="<?php echo $item->name; ?>" src="<?php echo base_url('assets/uploads/products/' . $item->picture_name); ?>">
                    </td>
                    <td>
                      <h5 class="mb-0"><?php echo $item->name; ?></h5>
                    </td>
                    <td><?php echo $item->order_qty; ?></td>
                    <td>Rp <?php echo format_rupiah($item->order_price); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="mb-0">Data Penerima</h3>
        </div>
        <div class="card-body p-0">
          <table class="table align-items-center table-flush table-hover">
            <tr>
              <td>Nama</td>
              <td><b><?php echo $delivery_data->customer->name; ?></b></td>
            </tr>
            <tr>
              <td>No. HP</td>
              <td><b><?php echo $delivery_data->customer->phone_number; ?></b></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>
                <div style="white-space: initial;"><b><?php echo $delivery_data->customer->address; ?></b></div>
              </td>
            </tr>
            <tr>
              <td>Catatan</td>
              <td><b><?php echo $delivery_data->note; ?></b></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="card card-primary" id="#payments">
        <div class="card-header">
          <h3 class="mb-0">Pembayaran</h3>
        </div>
        <div class="card-body <?php echo ($data->payment_method == 1) ? 'p-0' : ''; ?>">
          <?php if ($data->payment_method == 1) : ?>
            <?php if ($data->payment_price == NULL) : ?>
              <div class="alert alert-info m-2">Tidak ada data pembayaran.</div>
            <?php else : ?>

              <div>
                <img class="img img-fluid" src="<?php echo base_url('assets/uploads/payments/' . $data->picture_name); ?>">
              </div>

              <?php if ($payment_flash) : ?>
                <br>
                <div class="alert alert-info" id="payment_flash"><?php echo $payment_flash; ?></div>
              <?php endif; ?>

              <table class="table align-items-center table-flush table-hover">
                <tr>
                  <td>Transfer</td>
                  <td><b>Rp <?php echo format_rupiah($data->payment_price); ?></b></td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td><b><?php echo get_formatted_date($data->payment_date); ?></b></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><b>
                      <?php if ($data->payment_status == 1) : ?>
                        <span class="badge badge-info">Menunggu konfirmasi</span>
                      <?php elseif ($data->payment_status == 2) : ?>
                        <span class="badge badge-success">Dikonfirmasi</span>
                      <?php elseif ($data->payment_status == 3) : ?>
                        <span class="badge badge-danger">Gagal</span>
                      <?php endif; ?>
                    </b></td>
                </tr>
                <tr>
                  <td>Transfer ke</td>
                  <td>
                    <div style="white-space: initial;"><b>
                      <?php
                      $bank_data = json_decode($data->payment_data);
                      $bank_data = (array) $bank_data;
                      $transfer_to = $bank_data['transfer_to'];
                      $transfer_to = $banks[$transfer_to];
                      ?>
                      <?php echo $transfer_to->bank; ?> a.n <?php echo $transfer_to->name; ?> (<?php echo $transfer_to->number; ?>)
                    </b></div>
                  </td>
                </tr>
                <tr>
                  <td>Transfer dari</td>
                  <td>
                    <div style="white-space: initial;">
                      <b>
                      <?php
                      if (isset($bank_data['source'])) {
                          $transfer_from = $bank_data['source'];
                          echo $transfer_from->bank . ' a.n ' . $transfer_from->name . ' (' . $transfer_from->number . ')';
                      } else {
                          echo '-';
                      }
                      ?>
                      </b>
                    </div>
                  </td>
                </tr>
              </table>
            <?php endif; ?>
          <?php else : ?>
            <div class="alert alert-info">
              Order ini menggunakan metode pembayaran ditempat. Tidak memerlukan konfirmasi pembayaran.
            </div>
          <?php endif; ?>
        </div>
        <?php if ($data->payment_price != NULL) : ?>
          <div class="card-footer">
            <form action="<?php echo site_url('admin/payments/verify'); ?>" method="POST">
              <div class="row">
                <input type="hidden" name="id" value="<?php echo $data->payment_id; ?>">
                <input type="hidden" name="order" value="<?php echo $data->id; ?>">
                <div class="col-md-9">
                  <select class="form-control" name="action">
                    <?php if ($data->payment_status == 1) : ?>
                      <option value="1">Konfirmasi Pembayaran</option>
                      <option value="2">Pembayaran Tidak Ada</option>
                    <?php else : ?>
                      <option value="4" readonly>Tidak ada pilihan</option>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="col-md-3 text-right">
                  <input type="submit" class="btn btn-primary" value="OK">
                </div>
              </div>
            </form>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>