<!DOCTYPE html>
<html><head>
<style> 
        table, th, td 
        { border: 1px solid blac; 
          border-collapse: collapse;
        }
    </style>
</head><body>
<p> <h1 class="text-center"> "Data Barang" </h1></p>

<table  class="text-center" >
<tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Berat</th>
                    <th>Deskripsi</th>
</tr>


<?php $no=1;  foreach ($barang as $key => $value) { 
    
    ?>

<tr>
                    <td  style ="text-align : center" width = "50"><?= $no++; ?></td>
                    <td  style ="text-align : center" width = "150"><?= $value->nama_barang ?><br><img src="<?= base_url('assets/gambar/'.$value->gambar)?>"  width="150px"></td>
                    <td  style ="text-align : center" width = "75"><?= $value->nama_kategori ?></td>
                    <td  style ="text-align : center" width = "75">Rp. <?= number_format($value->harga,0) ?></td>
                    <td  style ="text-align : center" width = "50"> <?= $value->berat ?> </td>
                    <td  style ="text-align : center" width = "50"><?= $value->stok?></td>                    
                    <td  style ="text-align : center" width = "200"><?= $value->deskripsi ?></td>
</tr>
<?php }?>
</table>



</body></html>