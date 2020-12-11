<div class="card card-solid">
        <div class="card-body pb-0">

        <div class="col-md-12">
            <!-- general form elements disabled -->
            

              <?php

              if($this->session->flashdata('pesan')){
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo $this->session->flashdata('pesan');
                
                echo '</h5></div>';
              }
              

              ?>

                <?php echo form_open_multipart('pelanggan/akun') ?>

                <div class="row">
                

                    <div class="col-sm-12 ">
                      <!-- text input -->
                      <div class="form-group ">
                              <img src="<?= base_url('assets/foto/'.$akun->foto)?>" class="text-center" weight="200px" height="250" >
                              <br><label>Ubah Foto</label>
                        <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                   <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_pelanggan" class="form-control" value="<?= $akun->nama_pelanggan?>" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="<?= $akun->nik?>" readonly>
                        </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>No Telepon/HP : </label>
                        <input type="text" name="no_telpon" class="form-control" value="<?= $akun->no_telpon?>" required>
                        </div>
                    </div>

                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?= $akun->alamat?>" required>
                        </div>
                    </div>
                    

                    
                
               

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $akun->email?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?= $akun->password?>" required>
                        </div>
                    </div>
                    

                   

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url() ?>" class="btn btn-success">Kembali</a>
                    </div>

                <?php echo 
                form_close();
                ?>
</div>
</div>
</div>
</div>