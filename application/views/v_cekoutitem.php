            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-shopping-cart"></i> Cekout
                    <small class="float-right">Date: <?= date('d-m-Y') ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                  
                <div class="col-12 table-responsive">

                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Barang</th>
                      <th>Berat</th>
                      <th>Harga</th>
                      <th>Total Harga</th>
                      
                    </tr>
                    </thead>
                    <tbody >
                    <?php $i = 1; $total_berat = 0;
                     $items = $this->cart->contents()[$rowid];

                        $barang= $this->m_home->detail_barang($items['id']);
                        $berat= $items['qty'] * $barang->berat;
                        $total_berat += $berat; ?>
                    <tr>
                    <td style="text-align:left"> <?php echo number_format($items['qty'],0); ?></td>
                    <td><?php echo $items['name']; ?></td>
                    <td style="text-align:left"><?= $berat?>gr</td>
                    <td style="text-align:left">Rp. <?php echo number_format($items['price'],0); ?></td>
                    <td style="text-align:left">Rp. <?php echo number_format($items['subtotal'],0); ?></td>
                    
                
                    </tr>    
                    
                    


                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              

              <?php 
                  echo validation_errors('<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i>', '</h5> </div>');
                  ?>
              <?php echo form_open('belanja/cekoutitem/'.$rowid); 
              $no_order= date('Y-m-d').strtoupper(random_string('alnum',8));
              //echo $no_order;
              ?>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-sm-8 invoice-col">
                  Tujuan
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
                        <label>Kabupaten/Kota</label>
                        <select name="kota" class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Ekspedisi</label>
                        <select name="ekspedisi" class="form-control"></select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Paket</label>
                        <select name="paket" class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Alamat <small>(harus diisi)</small></label>
                        <input  name="alamat" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Kode POS <small>(harus diisi)</small></label>
                        <input  name="kode_pos" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Penerima <small>(harus diisi)</small></label>
                        <input  name="nama_penerima" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>No Telepon/HP <small>(harus diisi)</small></label>
                        <input  name="hp_penerima" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Catatan Tambahan</label>
                        <input  name="catatan" class="form-control" >
                      </div>
                    </div>

                    <!-- simpan -->
                    


                </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp. <?php  echo number_format($items['subtotal'],0); ?></td>
                      </tr>
                      <tr>
                        <th>Berat:</th>
                        <td><?= $total_berat?> gr</td>
                      </tr>
                      <tr>
                        <th>Ongkos Kirim:</th>
                        <td><label id="ongkir" ></label></td>
                      </tr>
                      <tr>
                        <th>Total Bayar:</th>
                        <td><label id="totalbayar"></label></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
                    <input name="no_order" value="<?= $no_order?>" hidden>
                    <input name="estimasi" hidden>
                    <input name="ongkir" hidden>
                    <input name="berat" value="<?= $total_berat?>" hidden><br>
                    <input name="grand_total" value="<?=$items['subtotal'] ?>" hidden>
                    <input name="total_bayar" hidden>

                    <?php  $items = $this->cart->contents()[$rowid]; {
                        echo form_hidden('qty', $items['qty']);
                    }
                    ?>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('belanja')?>"  class="btn btn-warning"><i class="fas fa-backward"></i> Kembali ke Keranjang</a>
                  
                  <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-shopping-cart"></i> Proses Cekout
                  </button>
                </div>
              </div>

              <?php echo form_close() ?>
            
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
                url: "<?= base_url('rajaongkir/kota')?>",
                data : 'id_provinsi=' + id_provinsi_terpilih,
                success : function(hasil_kota){
                    //console.log(hasil_kota);
                    $("select[name=kota]").html(hasil_kota);
                }

            });

        });

        //ekspedisi
        $("select[name=kota]").on("change", function(){ 

            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/ekspedisi')?>",
                success : function(hasil_ekspedisi){
                    //console.log(hasil_kota);
                    $("select[name=ekspedisi]").html(hasil_ekspedisi);
                }

            });
        });

        //paket
        $("select[name=ekspedisi]").on("change", function(){ 
            //mendapatkan ekspedisi terpilih
            var ekspedisiterpilih = $("select[name=ekspedisi]").val()
            //mendapatkan kota tujuan
            var kotaterpilih = $("option:selected","select[name=kota]").attr('id_kota');
            // data ongkir
            var totalberat = <?= $total_berat?>;
            //alert(expedisi_terpilih);

            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/paketperitem/'.$rowid)?>",
                data : 'ekspedisi='+ekspedisiterpilih +'&id_kota='+kotaterpilih + '&berat='+totalberat,
                success : function(hasil_paket){
                    //console.log(hasil_paket);
                    $("select[name=paket]").html(hasil_paket);
                }

            });
        });

        //ongkir
        $("select[name=paket]").on("change", function(){ 
            var dataongkir = $("option:selected",this).attr('ongkir');
            var reverse = dataongkir.toString().split('').reverse().join(''),
            ribuan_ongkir = reverse.match(/\d{1,3}/g);
            ribuan_ongkir = ribuan_ongkir.join(',').split('').reverse().join('');
            $("#ongkir").html("Rp. "+ribuan_ongkir)


            //menghitung total bayar
            //var ongkir = $("option:selected",this).attr('ongkir');

            var datatotalbayar = parseInt(dataongkir)+parseInt(<?= $items['subtotal'] ?>);
            var reverse2 = datatotalbayar.toString().split('').reverse().join(''),
            ribuan_total_bayar = reverse2.match(/\d{1,3}/g);
            ribuan_total_bayar = ribuan_total_bayar.join(',').split('').reverse().join('');
            $("#totalbayar").html("Rp. "+ribuan_total_bayar);

            //estimasi dan ongkir
            var estimasi=  $("option:selected",this).attr('estimasi');
            $("input[name=estimasi]").val(estimasi);
            $("input[name=ongkir]").val(dataongkir);
            $("input[name=total_bayar]").val(datatotalbayar);



        });






    });
</script>