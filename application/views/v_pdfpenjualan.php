<!DOCTYPE html>
<html><head>
    <style> 
        table, th, td 
        { border: 1px solid blac; 
          border-collapse: collapse;
        }
    </style>
</head><body>
<p> <h1 class="text-center"> "Data Penjualan" </h1></p>

<table  class="text-center" >
<tr>
                    <th>No</th>
                    <th>Nomor Order</th>
                    <th>Tanggal Order</th>
                    <th>Penerima</th>
                    <th>Ekspedisi</th>
                    <th>Berat</th>
                    <th>Grand Total</th>
                    <th>Total Bayar</th>
                    <th>Transaksi</th>
                    <th>No. Resi</th>

</tr>


<?php $no=1;  foreach ($transaksi as $key => $value) { 
    
    ?>

<tr>
                    <td  style ="text-align : center" width = "30"><?= $no++; ?></td>
                    <td  style ="text-align : center" width = "70"><?= $value->no_order ?></td>
                    <td  style ="text-align : center" width = "50"><?= $value->tgl_order ?></td>
                    
                    <td  style ="text-align : center" width = "160">
                    <b>Nama : </b> <?= $value->nama_penerima ?> <br>
                    <b>No. Telp: </b> <?= $value->hp_penerima ?> <br>
                    <b>Alamat : </b> <?= $value->alamat ?> <br>
                    <b>Kode Pos: </b> <?= $value->kode_pos ?> <br>
                    <b>Lokasi Pengiriman : </b><?= $value->kota ?>, <?= $value->provinsi ?>
                    </td>
                    <td  style ="text-align : center" width = "120">
                    <b>Ekspedisi:</b> <?= $value->ekspedisi ?> <br>
                    <b>Paket:</b> <?= $value->paket ?> | <?= $value->estimasi ?> <br>
                    <b>Ongkos Kirim : </b> Rp. <?= number_format($value->ongkir,0) ?>
                    </td>
                    <td  style ="text-align : center" width = "50"> <?= $value->berat ?> </td>
                    <td  style ="text-align : center" width = "90">Rp. <?= number_format($value->grand_total,0)?></td>                    
                    <td  style ="text-align : center" width = "90">Rp. <?= number_format($value->total_bayar,0) ?></td>
                    <td  style ="text-align : center" width = "120">
                    <b>Atas Nama:</b> <?= $value->atas_nama_pengguna ?> <br>
                    <b>Nama Bank :</b> <?= $value->nama_bank_pengguna ?> <br>
                    <b>No Rekening :</b> <?= $value->no_rek_pengguna?>
                    </td>
                    <td  style ="text-align : center" width = "75"> <?= $value->no_resi ?> </td>
                    
</tr>
<?php }?>
</table>



</body></html>