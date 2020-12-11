<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Barang</h3>

                <div class="card-tools">
                <?php if ($this->session->userdata('level_user')== "2") { ?>
                  <a href="<?= base_url('barang/add')?>" class="btn btn-info btn-xl"  ><i class="fas fa-plus"></i>  Tambah Data 
                  </a>
                  <a href="<?= base_url('barang/excel')?>" class="btn btn-success btn-xl"  ><i class="fas fa-download"></i>  Export Excel
                  </a>
                  <a href="<?= base_url('barang/pdf')?>" class="btn btn-danger btn-xl"  ><i class="fas fa-download"></i>  Export PDF
                  </a>
                <?php } ?>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php

              if($this->session->flashdata('pesan')){
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo $this->session->flashdata('pesan');
                
                echo '</h5></div>';
              }
              

              ?>
              
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok Barang</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    
                    <?php if ($this->session->userdata('level_user')== "2") { ?>
                    <th>Aksi</th>
                    <?php } ?>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php  $no=1;
                       foreach ($barang as $key => $value) { ?>
                          
                       
                      
                  <tr>
                  <td><?= $no++ ?></td>
                    <td><?= $value->nama_barang ?></td>
                    <td><?= $value->nama_kategori?></td>
                    <td><?= $value->stok?></td>
                    <td><?= $value->berat?> gr</td>
                    <td>RP. <?= number_format($value->harga,0) ?></td>
                    <td><img src="<?= base_url('assets/gambar/'.$value->gambar)?>" width="150px"></td>
                   
                    <td>
                    <?php if ($this->session->userdata('level_user')== "2") { ?>
                        <a href="<?= base_url('barang/edit/'.$value->id_barang)?>" class="btn btn-warning btn-sm" > <i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm"data-toggle="modal" data-target="#hapus<?= $value->id_barang?>"> <i class="fas fa-trash"></i></button>
                    <?php } ?>
                    </td>
                  </tr>
                       <?php }  ?>
                  </tbody>
                  
                </table>
              


              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

<!-- /.hapus -->
<?php  foreach ($barang as $key => $value) { ?>
<div class="modal fade" id="hapus<?= $value->id_barang?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data : <?= $value->nama_barang?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h3>Apakah yakin ingin menghapus data?</h3>
              </div>

            <div class="modal-footer justify-content-between">
            <a href="<?= base_url('barang/hapus/'.$value->id_barang)?>" class="btn btn-primary">Ya</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              
            </div>
            
          </div>
          
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                       <?php } ?>