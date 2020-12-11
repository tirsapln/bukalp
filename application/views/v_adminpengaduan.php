<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Pengaduan?</h3>

                <div class="card-tools">
                  
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
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>Deskripsi Pengaduan</th>
                    <th>Ket</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php  $no=1;
                       foreach ($pengaduan as $key => $value) { ?>
                          
                       
                      
                  <tr>
                  <td><?= $no++ ?></td>
                    <td><?= $value->nama ?></td>
                    <td><?= $value->email ?></td>
                    <td> <?= $value->desk_pengaduan ?> </td>
                    <?php if($value->foto == ""){ ?>
                        <td><?= $value->foto ?></td>
                        
                    <?php } else { ?>
                        <td><img src="<?= base_url('assets/gambarpengaduan/'.$value->foto)?>" width="150px"></td>
                    <?php }?>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm"data-toggle="modal" data-target="#hapus<?= $value->id_pengaduan?>"> <i class="fas fa-trash"></i></button>
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
<?php  foreach ($pengaduan as $key => $value) { ?>
<div class="modal fade" id="hapus<?= $value->id_pengaduan?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data : <?= $value->desk_pengaduan?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h4>Apakah yakin ingin menghapus data?</h4>
              </div>

            <div class="modal-footer justify-content-between">
            <a href="<?= base_url('admin/hapuspengaduan/'.$value->id_pengaduan)?>" class="btn btn-primary">Ya</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              
            </div>
            
          </div>
          
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                       <?php } ?>