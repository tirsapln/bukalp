<div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">

          <?php foreach ($cari as $key => $value) {
            ?>
          


          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <?php 
            echo form_open('belanja/add'); 
            echo form_hidden('id', $value->id_barang);
            echo form_hidden('qty', 1);
            echo form_hidden('price', $value->harga);
            echo form_hidden('name', $value->nama_barang);
            echo form_hidden('lokasi', $value->id_user);
            echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));

            ?>
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                        <h2 class="lead"><b><?= $value->nama_barang?></b></h2>
                        <table>
                          <tr>
                            <th>Toko</th>
                            <th>:</th>
                            <td><?= $value->nama_user?></td>
                          </tr>
                          <tr>
                            <th>Stok</th>
                            <th>:</th>
                            <td><?= $value->stok?></td>
                          </tr>
                        </table>
                    </div>
                    <div class="col-12 text-center">
                      <img src="<?= base_url('assets/gambar/'.$value->gambar) ?>"  width="300px" height="250px" >
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="text-left">
                    <h4><span class="badge bg-primary"> Rp.  <?= number_format($value->harga, 0)?></span></h4>
                    </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="text-right">
                    <a href="<?= base_url('home/detail_barang/'.$value->id_barang)?>" class="btn btn-sm bg-success">
                      <i class="fas fa-eye"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                      <i class="fas fa-cart-plus"></i> Add
                    </button>
                  </div>
                  </div>
                  </div>
                </div>
              </div>
              <?php echo 
              form_close();
               ?>
            </div>

          <?php } ?>

          </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/template/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Barang berhasil ditambahkan ke keranjang.'
      })
    });
  });
  </script>