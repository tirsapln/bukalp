<!-- Main content -->
<div class="col-12">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> BukaLapas.
                    <small class="float-right"><?php date('d-m-Y')?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong><?= $toko->nama_user ?></strong><br>
                    <?= $toko->alamat ?> <br>
                    Phone: <?= $toko->no_telpon ?><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?= $transaksi->nama_penerima ?></strong><br>
                    <?= $transaksi->alamat ?>,<br>
                    <?= $transaksi->kota ?>,<br>
                    <?= $transaksi->provinsi ?>.<br>
                    Phone: <?= $transaksi->hp_penerima ?><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>#Invoice</b><br>
                  
                  <b>Order ID:</b> <?= $transaksi->no_order ?><br>
                  <b>Payment Due:</b> <?= $transaksi->tgl_order ?><br>
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr class="text-center">
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Harga</th>
                      <th>Berat</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rinciorder as $key => $value) {
                            ?>
                    <tr class="text-center">
                      <td><?= $value->qty ?></td>
                      <td><b><?= $value->nama_barang ?></b><br><img src="<?= base_url('assets/gambar/'.$value->gambar)?>" width="200px" height="200px"></td>
                      <td>Rp.<?=number_format($value->harga,0) ?></td>
                      <td><?= $value->berat * $value->qty  ?> gr</td>
                      <td>Rp.<?= number_format($value->harga * $value->qty,0)  ?></td>
                    </tr>
                        <?php } ?>
                    
                    </tbody>
                  </table>
                  <h5> Catatan dari Pelanggan :  <span class="badge badge-warning"><?php if($transaksi->catatan == "") {echo "-"; } else { echo $transaksi->catatan; }?></span></h5>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Metode Pembayaran</p>
                  <table class="table">
                      <tr>
                      <th>Atas Nama</th>
                      <th>:</th>
                      <td><?= $transaksi->atas_nama_pengguna?></td>
                      </tr>

                      <tr>
                      <th>Nama Bank</th>
                      <th>:</th>
                      <td><?= $transaksi->nama_bank_pengguna?></td>
                      </tr>

                      <tr>
                      <th>No. Rekening</th>
                      <th>:</th>
                      <td><?= $transaksi->no_rek_pengguna?></td>
                      </tr>

                      <tr>
                      <th>Bukti</th>
                      <th>:</th>
                      <td><img src="<?= base_url('assets/bukti_bayar/'.$transaksi->bukti_bayar)?>" width="300px"></td>
                      </tr>
                  </table>
                  
                  
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Pembayaran</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp. <?= number_format($transaksi->grand_total,0) ?></td>
                      </tr>
                      <tr>
                        <th>Berat Total</th>
                        <td><?= $transaksi->berat ?> gr</td>
                      </tr>
                      <tr>
                        <th style="width:50%">Ekspedisi :</th>
                        <td><?= $transaksi->ekspedisi ?></td>
                      </tr>
                      <tr>
                        <th style="width:50%">Paket & Estimasi :</th>
                        <td><?= $transaksi->paket ?> | <?= $transaksi->estimasi ?></td>
                      </tr>
                      <tr>
                        <th>Ongkir</th>
                        <td>Rp. <?= number_format($transaksi->ongkir,0) ?></td>
                      </tr>
                      <tr>
                        <th>Total Bayar:</th>
                        <td> <b>Rp. <?= number_format($transaksi->total_bayar,0) ?></b> </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
</div>

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>