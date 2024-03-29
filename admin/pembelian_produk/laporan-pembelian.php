<?php
$semuadata = [];
$tgl_mulai = "-";
$tgl_selesai = "-";
if(isset($_POST['kirim'])){
  $tgl_mulai = $_POST['tglm'];
  $tgl_selesai = $_POST['tgls'];

  $ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan left join produk pr on pm.id_produk = pr.id_produk WHERE tanggal_book BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
  while($pecah = $ambil->fetch_assoc()){
    $semuadata[] = $pecah;
  }
}


?>


<h2>Laporan Penyewaan dari <?= $tgl_mulai; ?> hingga <?= $tgl_selesai; ?></h2>
<hr>

<form action="" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tglm" value="<?= $tgl_mulai; ?>">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgls" value="<?= $tgl_selesai; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <label for="">&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim">Lihat</button>&nbsp;<a
                href="pembelian_produk/cetak.php?tglm=<?=$tgl_mulai;?>&tgls=<?=$tgl_selesai;?>"
                class="btn btn-primary">Cetak</a>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal Order</th>
            <th>Tanggal Booking(Acara)</th>
            <th>Harga</th>
            <!-- <th>Status</th> -->
        </tr>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach($semuadata as $key => $value): ?>
        <?php $total += $value['harga_produk']; ?>
        <tr>
            <td><?= $key+1; ?>.</td>
            <td><?= $value['nama_pelanggan']; ?></td>
            <td><?= $value['tgl_pesan']; ?></td>
            <td><?= $value['tanggal_book']; ?></td>
            <td>Rp. <?= number_format($value['harga_produk']); ?>,-</td>
            <!-- <td><?= $value['status_pembelian']; ?></td> -->
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp. <?= number_format($total); ?>,-</th>
        </tr>
    </tfoot>
</table>