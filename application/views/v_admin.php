
<?php if ($this->session->userdata('level_user')== "1") { ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php foreach ($totalpm as $key => $value)  {?>
                <h3><?= $value->total ?> </h3>
                <?php } ?>

                <p>Pesanan Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-info"></i>
              </div>
              <a href="<?= base_url('admin/pesanan_masuk')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $totalbarang ?></h3>

                <p>Barang</p>
              </div>
              <div class="icon">
                <i class="fas fa-cubes"></i>
              </div>
              <a href="<?= base_url('barang')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $totalpelanggan ?></h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?= base_url('pelanggan')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>

          <?php if ($this->session->userdata('level_user')== "2") { ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php foreach ($totalpmadmin as $key => $value)  {?>
                <h3><?= $value->total ?> </h3>
          <?php } ?>

                <p>Pesanan Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-info"></i>
              </div>
              <a href="<?= base_url('admin/pesanan_masuk')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php foreach ($totalbarangadmin as $key => $value)  {?>
                <h3><?= $value->total ?></h3>
                <?php } ?>
                <p>Barang</p>
              </div>
              <div class="icon">
                <i class="fas fa-cubes"></i>
              </div>
              <a href="<?= base_url('barang')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php } ?>


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $totalkategori ?></h3>

                <p>Kategori</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="<?= base_url('kategori')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


         


  