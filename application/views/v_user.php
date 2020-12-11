<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data User</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#add" ><i class="fas fa-plus"></i>  Tambah Data 
                  </button>
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
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <?php  $no=1;
                       foreach ($user as $key => $value) { ?>
                          
                       
                      
                  <tr>
                  <td><?= $no++ ?></td>
                    <td><?= $value->nama_user ?></td>
                    <td><?= $value->username ?></td>
                    <td><?= $value->password ?></td>
                    <td><?php
                    if($value->level_user == 1)
                    {
                        echo '<span class="badge badge-primary">Super Admin</span>';
                    }
                    else if($value->level_user == 2)
                    {
                        echo '<span class="badge badge-success">Admin</span>';
                    }
                    else if($value->level_user == 3)
                    {
                        echo '<span class="badge badge-warning">User</span>';
                    }
                    ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_user?>"> <i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"data-toggle="modal" data-target="#hapus<?= $value->id_user?>"> <i class="fas fa-trash"></i></button>
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


<!-- /.TAMBAH USER -->
          <div class="modal fade" id="add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <?php


              echo form_open('user/add');
              ?>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama User</label>
                    <input type="name" class="form-control" name="nama_user" placeholder="Nama User" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="name" class="form-control" name="username" placeholder="Username" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="name" class="form-control" name="password" placeholder="Password" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Level User</label>
                    <select name="level_user" class="form-control">
                      <option value="1" selected> Super Admin </option>
                      <option value="2"> Admin </option>
                      <option value="3"> User </option>
                    </select>
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


<!-- /.EDIT USER -->
<?php  foreach ($user as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value->id_user?>">
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


              echo form_open('user/edit/'.$value->id_user);
              ?>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama User</label>
                    <input type="name" class="form-control" value="<?= $value->nama_user?>" name="nama_user" placeholder="Nama User" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="name" class="form-control" value="<?= $value->username?>" name="username" placeholder="Username" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="name" class="form-control" value ="<?= $value->password?>" name="password" placeholder="Password" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Level User</label>
                    <select name="level_user" class="form-control">
                      <option value="1" <?php if ($value->level_user == 1) {
                        echo 'selected';
                      } ?>> Super Admin </option>
                      <option value="2" <?php if ($value->level_user == 2) {
                        echo 'selected';
                      } ?>> Admin </option>
                      <option value="3"<?php if ($value->level_user == 3) {
                        echo 'selected';
                      } ?>> User </option>
                    </select>
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



<!-- /.hapus USER -->
<?php  foreach ($user as $key => $value) { ?>
<div class="modal fade" id="hapus<?= $value->id_user?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data : <?= $value->nama_user?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h3>Apakah yakin ingin menghapus data?</h3>
              </div>

            <div class="modal-footer justify-content-between">
            <a href="<?= base_url('user/hapus/'.$value->id_user)?>" class="btn btn-primary">Ya</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              
            </div>
            
          </div>
          
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                       <?php } ?>