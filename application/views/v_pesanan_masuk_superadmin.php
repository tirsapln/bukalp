

    <div class="col-sm-12">
        <?php

              if($this->session->flashdata('pesan')){
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo $this->session->flashdata('pesan');
                
                echo '</h5></div>';
              }
              

              ?>
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Masuk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                  </li>
                  
                  
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                     <table class="table text-center">
                         <tr>
                         <th>No Order</th>
                         <th>Tanggal</th>
                         <th>Ekspedisi</th>
                         <th>Total Bayar</th>
                         <th class="text-center"></th>
                         </tr>
                         <?php foreach ($pesanan as $key => $value) {
                             
                         ?>
                         <tr>
                             <td><?= $value->no_order?></td>
                             <td><?= $value->tgl_order?></td>
                             <td>
                                 <b><?= $value->ekspedisi?></b> <br>
                                 Paket: <?= $value->paket?> <br>
                                 Ongkir: Rp. <?= number_format($value->ongkir,0)?>
                            </td>
                            <td>
                                <b>Rp. <?= number_format($value->total_bayar,0)?></b><br>
                                <?php if($value->status_bayar == "0"){ ?>
                                    <span class="badge badge-warning">Belum Bayar</span>
                                    <?php } elseif($value->status_bayar == "9"){ ?>
                                    <span class="badge badge-danger">Kadaluarsa</span>
                                <?php } else { ?>
                                  
                                    <span class="badge badge-success">Sudah Bayar</span> <br>
                                    <span class="badge badge-primary">Menunggu verifikasi</span>
                                <?php } ?>
                            </td>
                             <td class="text-center">
                             <?php if($value->status_bayar == "1"){ ?>
                                
                                <a href="<?= base_url('admin/rincian_pesanan/'.$value->id_transaksi) ?>" class="btn btn-xm btn-flat btn-warning"> Rincian Pesanan</a> <br>
                                
                                <?php } ?> 
                                 
                             </td>
                         </tr>
                        <?php } ?>
                         
                     </table>
                  </div>
                  
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  <table class="table text-center">
                         <tr>
                         <th>No Order</th>
                         <th>Tanggal</th>
                         <th>Ekspedisi</th>
                         <th>Total Bayar</th>
                         <th>No Resi</th>
                         <th class="text-center"></th>
                         </tr>
                         <?php foreach ($pesanan_selesai as $key => $value) {
                             
                         ?>
                         <tr>
                             <td><?= $value->no_order?></td>
                             <td><?= $value->tgl_order?></td>
                             <td>
                                 <b><?= $value->ekspedisi?></b> <br>
                                 Paket: <?= $value->paket?> <br>
                                 Ongkir: Rp. <?= number_format($value->ongkir,0)?>
                            </td>
                            <td>
                                <b>Rp. <?= number_format($value->total_bayar,0)?></b><br>
                                
                                    <span class="badge badge-success">Selesai Diterima/Sampai</span>
                                
                            </td>
                             <td>
                             <h5><?= $value->no_resi?></h5>
                                 
                             </td>
                             
                         </tr>
                        <?php } ?>
                         
                     </table>
                        
                    </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>