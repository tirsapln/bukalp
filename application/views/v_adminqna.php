<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data QnA?</h3>

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
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php  $no=1;
                       foreach ($qna as $key => $value) { ?>
                          
                       
                      
                  <tr>
                  <td><?= $no++ ?></td>
                    <td><?= $value->nama ?></td>
                    <td><?= $value->email ?></td>
                    <td><?= $value->pertanyaan ?></td>
                    <td><?= $value->jawaban ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_qna?>"> <i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"data-toggle="modal" data-target="#hapus<?= $value->id_qna?>"> <i class="fas fa-trash"></i></button>
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





<!-- /.EDIT qna -->
<?php  foreach ($qna as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value->id_qna?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <?php


              echo form_open('admin/editqna/'.$value->id_qna);
              ?>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Pertanyaan</label>
                    <input type="name" class="form-control" value="<?= $value->pertanyaan?>" name="pertanyaan" placeholder="Pertanyaan" disabled>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Jawaban</label>
                    <input type="name" class="form-control" value="<?= $value->jawaban?>" name="jawaban" placeholder="Jawaban" required>
                  </div>

                  
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            
          </div>
          <?php
              echo form_close();
              ?>
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                       <?php } ?>



<!-- /.hapus qna -->
<?php  foreach ($qna as $key => $value) { ?>
<div class="modal fade" id="hapus<?= $value->id_qna?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data : <?= $value->pertanyaan?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h3>Apakah yakin ingin menghapus data?</h3>
              </div>

            <div class="modal-footer justify-content-between">
            <a href="<?= base_url('admin/hapusqna/'.$value->id_qna)?>" class="btn btn-primary">Ya</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              
            </div>
            
          </div>
          
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                       <?php } ?>