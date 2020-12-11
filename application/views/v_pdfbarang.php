<!DOCTYPE html>
<html><head>
</head><body>
<p> <h1 style ="text-align : center"> "Data Barang" </h1></p>

<table  class="text-center" style ="border : 1px solid " >
<tr>
                    <th style ="border : 1px solid ">No</th>
                    <th style ="border : 1px solid ">Nama Barang</th>
                    <th style ="border : 1px solid ">Kategori</th>
                    <th style ="border : 1px solid ">Harga</th>
                    <th style ="border : 1px solid ">Stok</th>
                    <th style ="border : 1px solid ">Berat</th>
                    <th style ="border : 1px solid ">Deskripsi</th>
</tr>


<?php $no=1;  foreach ($barang as $key => $value) { 
    
    ?>

<tr>
                    <td  style ="border : 1px solid; text-align : center" width = "50"><?= $no++; ?></td>
                    <td  style ="border : 1px solid; text-align : center" width = "150"><?= $value->nama_barang ?><br><img src="<?= base_url('assets/gambar/'.$value->gambar)?>"  width="150px"></td>
                    <td  style ="border : 1px solid; text-align : center" width = "75"><?= $value->nama_kategori ?></td>
                    <td  style ="border : 1px solid; text-align : center" width = "75">Rp. <?= number_format($value->harga,0) ?></td>
                    <td  style ="border : 1px solid; text-align : center" width = "50"> <?= $value->berat ?> </td>
                    <td  style ="border : 1px solid; text-align : center" width = "50"><?= $value->stok?></td>                    
                    <td  style ="border : 1px solid; text-align : center" width = "200"><?= $value->deskripsi ?></td>
</tr>
<?php }?>
</table>



</body></html>