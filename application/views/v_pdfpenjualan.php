<!DOCTYPE html>
<html><head>
</head><body>
<p> <h1 style ="text-align : center"> "Data Penjualan" </h1></p>

<table  class="text-center" style ="border : 1px solid " >
<tr>
                    <th style ="border : 1px solid ">No</th>
                    <th style ="border : 1px solid ">Nomor Order</th>
                    <th style ="border : 1px solid ">Tanggal Order</th>
                    <th style ="border : 1px solid ">Penerima</th>
                    <th style ="border : 1px solid ">Ekspedisi</th>
                    <th style ="border : 1px solid ">Berat</th>
                    <th style ="border : 1px solid ">Grand Total</th>
                    <th style ="border : 1px solid ">Total Bayar</th>
                    <th style ="border : 1px solid ">Transaksi</th>
                    <th style ="border : 1px solid ">No. Resi</th>

</tr>


<?php $no=1;  foreach ($transaksi as $key => $value) { 
    
    ?>

<tr>
                    <td  style ="border : 1px solid; text-align : center" width = "30"><?= $no++; ?></td>
                    <td  style ="border : 1px solid; text-align : center" width = "70"><?= $value->no_order ?></td>
                    <td  style ="border : 1px solid; text-align : center" width = "50"><?= $value->tgl_order ?></td>
                    
                    <td  style ="border : 1px solid; text-align : center" width = "150">
                    <b>Nama : </b> <?= $value->nama_penerima ?> <br>
                    <b>No. Telp: </b> <?= $value->hp_penerima ?> <br>
                    <b>Alamat : </b> <?= $value->alamat ?> <br>
                    <b>Kode Pos: </b> <?= $value->kode_pos ?> <br>
                    <b>Lokasi Pengiriman : </b><?= $value->kota ?>, <?= $value->provinsi ?>
                    </td>
                    <td  style ="border : 1px solid; text-align : center" width = "100">
                    <b>Ekspedisi:</b> <?= $value->ekspedisi ?> <br>
                    <b>Paket:</b> <?= $value->paket ?> | <?= $value->estimasi ?> <br>
                    <b>Ongkos Kirim : </b> Rp. <?= number_format($value->ongkir,0) ?>
                    </td>
                    <td  style ="border : 1px solid; text-align : center" width = "50"> <?= $value->berat ?> </td>
                    <td  style ="border : 1px solid; text-align : center" width = "50">Rp. <?= number_format($value->grand_total,0)?></td>                    
                    <td  style ="border : 1px solid; text-align : center" width = "50">Rp. <?= number_format($value->total_bayar,0) ?></td>
                    <td  style ="border : 1px solid; text-align : center" width = "100">
                    <b>Atas Nama:</b> <?= $value->atas_nama_pengguna ?> <br>
                    <b>Nama Bank :</b> <?= $value->nama_bank_pengguna ?> <br>
                    <b>No Rekening :</b> <?= $value->no_rek_pengguna?>
                    </td>
                    <td  style ="border : 1px solid; text-align : center" width = "75"> <?= $value->no_resi ?> </td>
                    
</tr>
<?php }?>
</table>



</body></html>