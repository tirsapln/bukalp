<div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Gambar : <?= $barang->nama_barang ?></h3>

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
              <?php 
            //notif
            echo validation_errors('<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i>', '</h5> </div>');
            //
            if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i>'.$error_upload. '</h5> </div>';
            }

            echo form_open_multipart('gambarbarang/add/'.$barang->id_barang) ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Keterangan Gambar</label>
                        <input class="form-control" placeholder="Nama Barang" name="ket" value="<?= set_value('ket')?>">
                      </div>
                      </div>

                      
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="preview_gambar" required>
                         </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <img src="<?= base_url('assets/gambar/no_foto.png')?>" id="gambar_load" width="200px">
                         </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('barang') ?>" class="btn btn-success">Kembali</a>
                    </div>

              
            <?php echo 
            form_close();
            ?>

<hr>
            <div class="row">
            <?php foreach ($gambarbarang as $key => $value) { ?>
               
            
            <div class="col-sm-4 text-center">
                      <!-- text input -->
                      <div class="form-group">
                        <img src="<?= base_url('assets/gambarbarang/'.$value->gambar)?>" id="gambar_load" width="250px" height="200px">
                        
                         </div>
                         <p for="">Ket: <?= $value->ket?></p>
                         <button class="btn btn-danger btn-sm btn-block"data-toggle="modal" data-target="#hapus<?= $value->id_gambar?>"> <i class="fas fa-trash"></i> Hapus</button>
                    
                    </div>
            <?php }?>
            </div>
                
              


              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

<!-- /.hapus -->
<?php  foreach ($gambarbarang as $key => $value) { ?>
<div class="modal fade" id="hapus<?= $value->id_gambar?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Data : <?= $value->ket?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
            <div class="form-group ">
                        <img src="<?= base_url('assets/gambarbarang/'.$value->gambar)?>" id="gambar_load" width="250px" height="200px">
                        
                         </div>

              <h5>Apakah yakin ingin menghapus data?</h5>
              
              </div>

            <div class="modal-footer justify-content-between">
            <a href="<?= base_url('gambarbarang/hapus/'.$value->id_barang.'/'.$value->id_gambar)?>" class="btn btn-primary">Ya</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              
            </div>
            
          </div>
          
          
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
                       <?php } ?>


<!-- PREVIEW -->

<script>

function bacaGambar(input) {
    if (input.files && input.files[0]) {
        var reader= new FileReader();
        reader.onload = function(e) {
            $('#gambar_load').attr('src', e.target.result);
            
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#preview_gambar").change(function() {
    bacaGambar(this);
}
);

</script>