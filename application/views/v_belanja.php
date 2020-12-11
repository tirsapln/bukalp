<div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row ">
          <div class="col-sm-12">
                  <?php

              if ($this->session->flashdata('error')) {
            echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-times"></i> Gagal!</h5>';
            echo $this->session->flashdata('error');
            echo '</div>';
          }

        if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sukses!</h5>';
            echo $this->session->flashdata('pesan');
            echo '</div>';
          }
              

              ?>

          <?php echo form_open('belanja/update'); ?>

<table class="table" cellpadding="6" cellspacing="1" style="width:100%" > 

<tr>
        
        <th width="100px">QTY</th>
        <th>Nama Barang</th>
        <th style="text-align:right">Harga</th>
        <th style="text-align:right">Berat</th>
        <th style="text-align:right">Sub-Total</th>
        
        <th class="text-center">Action</th>
</tr>

<?php $i = 1; ?>

<?php $total_berat=0;
foreach ($this->cart->contents() as $items){ 
        
        $barang= $this->m_home->detail_barang($items['id']);
        $berat= $items['qty'] * $barang->berat;
        $total_berat += $berat;
        ?>

        

        <tr>
                <td><?php echo form_input(array(
                    'name' => $i.'[qty]', 
                    'value' => $items['qty'], 
                    'maxlength' => '3', 
                    'size' => '5',
                    'type'=>'number', 
                    'class' => 'form-control',
                    'min'=>'0')); ?>
                    </td>
                <td>
                        <?php echo $items['name']; ?>
                </td>
                <td style="text-align:right">Rp. <?php echo number_format($items['price'],0); ?></td>
                <td style="text-align:right"><?= $berat?>gr</td>
                <td style="text-align:right">Rp. <?php echo number_format($items['subtotal'],0); ?></td>
                
                <td class="text-center">
                <a href="<?= base_url('belanja/hapus/'.$items['rowid'])?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                <a href="<?= base_url('belanja/cekoutitem/'.$items['rowid'])?>" class="btn btn-success btn-sm"><i class="fa fa-credit-card"></i></a>
                </td>
        </tr>

<?php $i++; ?>

                <?php } ?> 

<tr>
<td>
        
        <td class="right"><strong><h4>Total: </h4></strong></td>
        <td class="right"><strong><h4>Rp. <?php echo number_format($this->cart->total(),0); ?></h4><strong></td>
        <th>Total Berat: <?= $total_berat?> </th>
        </td>
</tr>

</table>

<div class="row">
<div class="col-sm-6">
    <button type="submit" class="btn btn-primary btn-flat"> <i class="fa fa-save"></i> Update Cart </button>
    <a href="<?= base_url('belanja/clear')?>" class="btn btn-success btn-danger"> <i class="fa fa-recycle"></i> Clear Cart </a>
    <a href="<?= base_url('belanja/cekout')?>" class="btn btn-success btn-flat"> <i class="fa fa-credit-card"></i> Check Out </a>
</div>

</div>

<?php echo form_close()?>

<br>
</div>
</div>
</div>
</div>