<div class="row">
          <div class="col-12">
              <?php

              if($this->session->flashdata('pesan')){
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo $this->session->flashdata('pesan');
                
                echo '</h5></div>';
              }
              

              ?>
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Bantuan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">QnA?</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Pengaduan</a>
                  </li>
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <div class="post">
                    <div class="user-block">
                        <img src="<?= base_url()?>assets/gambar/no_foto.png"  alt="user image">
                        <span class="username">
                          <a href="#">Cara Berbelanja di BukaLapas</a>
                        </span>
                        <span class="description">Author : Admin BukaLapas</span>
                      </div>
                      <p>
                          Langkah-langkah berbelanja di buka lapas!
                          <br>
                          1. Login menggunkan akun anda. <br>
                          2. Pilih barang-barang yang ingin anda beli dan masukkan ke dalam keranjang belanja <br>
                          3. Jika sudah dipilih anda bisa melihat keranjang belanja anda, apakah sudah sesuai <br>
                          4. Perhatikan jumlah barang yang akan dibeli <br>
                          5. Jika telah sesuai, Pilih Checkout bisa semua barang atau per item <br>
                          6. Isi formulir pemesanan, dan pilih lokasi pengiriman <br>
                          7. Kemudian, Lanjut ke proses Transaksi dengan mengirimkan nominal uang sesuai dengan total harga<br>
                          8. Upload bukti pembayaran 
                      </p>
                    </div>

                    <div class="post">
                    <div class="user-block">
                        <img src="<?= base_url()?>assets/gambar/no_foto.png"  alt="user image">
                        <span class="username">
                          <a href="#">Cara membuat akun</a>
                        </span>
                        <span class="description">Author : Admin BukaLapas</span>
                      </div>
                      <p>
                          Langkah-langkah buat akun.
                          <br>
                          1. Masukkan ke halaman <a href="<?= base_url('pelanggan/register') ?>"> Registrasi</a><br>
                          2. Isi data diri berupa Nama Lengkap, NIK, Email dan Password <br>
                          3. Kemudian tekan tombol Register
                      </p>
                    </div>

                    <div class="post">
                    <div class="user-block">
                        <img src="<?= base_url()?>assets/gambar/no_foto.png"  alt="user image">
                        <span class="username">
                          <a href="#">Cara Login</a>
                        </span>
                        <span class="description">Author : Admin BukaLapas</span>
                      </div>
                      <p>
                          Langkah-langkah login.
                          <br>
                          1. Masukkan ke halaman <a href="<?= base_url('pelanggan/login') ?>"> Login</a><br>
                          2. Masukkan Email dan Password yang valid <br>
                          3. Kemudian tekan tombol Login
                      </p>
                    </div>

                    <div class="post">
                    <div class="user-block">
                        <img src="<?= base_url()?>assets/gambar/no_foto.png"  alt="user image">
                        <span class="username">
                          <a href="#">Proses Checkout</a>
                        </span>
                        <span class="description">Author : Admin BukaLapas</span>
                      </div>
                      <p>
                          Perlu diperhatikan untuk checkout sejumlah barang harus pada toko yang sama <br>
                          jika tidak maka proses checkout tidak akan berjalan. <br>
                          Untuk data diri pastikan untuk mengisi data dengan benar dan valid <br>
                      </p>
                    </div>

                    <div class="post">
                    <div class="user-block">
                        <img src="<?= base_url()?>assets/gambar/no_foto.png"  alt="user image">
                        <span class="username">
                          <a href="#">Transaksi</a>
                        </span>
                        <span class="description">Author : Admin BukaLapas</span>
                      </div>
                      <p>
                         Usahakan untuk mengirimkan jumlah uang sesuai total yang tertera, dan tidak boleh kurang dari angka tersebut.
                      </p>
                    </div>
                    
                    </div>


                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    
                    <?php foreach ($qnaa as $key => $value) {
                        
                    ?>
                    <div class="post">
                    <div class="user-block">
                        <img src="<?= base_url()?>assets/gambar/no_foto.png"  alt="user image">
                        <span class="username">
                          <a href="#"><?= $value->pertanyaan ?></a>
                        </span>
                        <span class="description">Author : <?= $value->nama ?></span>
                      </div>
                      <p>
                      <?= $value->jawaban ?>
                      </p>
                    </div>
                    <?php } ?>

                    
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kirim Pertanyaan</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('home/bantuan');?>
                <div class="card-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap <small>(harus diisi)</small></label>
                    <input  name="nama" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email <small>(harus diisi)</small></label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pertanyaan <small>(harus diisi)</small></label>
                    <input  name="pertanyaan" class="form-control" id="exampleInputEmail1" placeholder="Pertanyaan">
                  </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
              <?php echo form_close();?>
            </div>
            


                  </div>

                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kirim Pengaduan</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('home/pengaduan');?>
                <div class="card-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap <small>(harus diisi)</small></label>
                    <input  name="nama" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email <small>(harus diisi)</small></label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi Pengaduan <small>(harus diisi)</small></label>
                    <input  name="desk_pengaduan" class="form-control" id="exampleInputEmail1" placeholder="Deskripsi Pengaduan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan Foto </label>
                    <input  type="file" name="foto" class="form-control" id="exampleInputEmail1" placeholder="Deskripsi Pengaduan">
                  </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
              <?php echo form_close();?>
            </div>
                  </div>

                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>