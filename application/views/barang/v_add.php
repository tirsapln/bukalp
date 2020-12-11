<!-- right column -->
<div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

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

            echo form_open_multipart('barang/add') ?>

            <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Barang</label>
                        <input class="form-control" placeholder="Nama Barang" name="nama_barang" value="<?= set_value('nama_barang')?>">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                      <label>Kategori</label>
                        <select name="id_kategori" class="form-control">
                        <option value="">--Pilih Kategori--</option>
                        <?php foreach ($kategori as $key => $value) { ?>
                            <option value="<?= $value->id_kategori?>"><?= $value->nama_kategori?></option>
                        <?php } ?>
                        
                        </select>
                      </div>
                      </div>

                      <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Harga</label>
                        <input class="form-control" placeholder="Harga" name="harga" value="<?= set_value('harga')?>" >
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Stok Barang</label>
                        <input class="form-control" placeholder="Stok" name="stok" value="<?= set_value('stok')?>" >
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Berat (gr)</label>
                        <input type="number" min="0" class="form-control" placeholder="Berat" name="berat" value="<?= set_value('berat')?>" >
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="textarea" name="deskripsi" placeholder="Deskripsi Barang"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
               </div>
                    </div>
                    </div>

                    
              </p>
            </div>

<div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="preview_gambar" required>
                         </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <img src="<?= base_url('assets/gambar/no_foto.png')?>" id="gambar_load" width="400px">
                         </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('gambarbarang') ?>" class="btn btn-success">Kembali</a>
                    </div>


            <?php echo form_close()?>

            

              </div>
              </div>
              </div>

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

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>