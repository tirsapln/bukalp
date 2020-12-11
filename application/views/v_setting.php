<!-- right column -->
<div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Setting</h3>
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

                <?php echo form_open('admin/setting') ?>

                <div class="row">
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_user" class="form-control" value="<?= $setting->nama_user?>" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="no_telpon" class="form-control" value="<?= $setting->no_telpon?>" required>
                        </div>
                    </div>

            </div>
            <br>
            <div class="row">

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control"></select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Kota</label>
                        <input class="text-center" value="id kota = <?= $setting->lokasi?>" disabled>
                        <select name="kota" class="form-control" ></select>
                        
                        </div>
                    </div>
                    <div class="col-sm-12">
                      
                        <i>(jika id kota telah terisi lewati langkah mengisi Provinsi dan Kota)</i>
                        
                      
                    </div>
                    
                </div>
                <br>
                <div class="row">
               

                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Alamat Toko</label>
                        <input type="text" name="alamat" value="<?= $setting->alamat?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control" value="<?= $setting->nama_bank?>" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" name="no_rek" class="form-control" value="<?= $setting->no_rek?>" required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control" value="<?= $setting->atas_nama?>" required>
                        </div>
                    </div>

                    

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $setting->username?>" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?= $setting->password?>" required>
                        </div>
                    </div>



                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('admin') ?>" class="btn btn-success">Kembali</a>
                    </div>

                <?php echo 
                form_close();
                ?>

              </div>
              </div>
              </div>

<script>
    $(document).ready(function() {
        //provinsi
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/provinsi')?>",
            success: function(hasil_provinsi){
                //console.log(hasil_provinsi);
                $("select[name=provinsi]").html(hasil_provinsi);


            }
        });

        //kota
        $("select[name=provinsi]").on("change", function(){
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/lokasi')?>",
                data : 'id_provinsi=' + id_provinsi_terpilih,
                success : function(hasil_kota){
                    //console.log(hasil_kota);
                    $("select[name=kota]").html(hasil_kota);
                }

            });

        });

    });
</script>