<?php
$tipe_akun = 'gudang';
include('../header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bagian Manager - Toko Alfamart</title>
    <link href='../assets/css/main.css' rel='stylesheet' type='text/css' />
    <link href='../assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    
    <script src='../assets/bootstrap/js/jquery.js' type='text/javascript'></script>
    <script src='../assets/bootstrap/js/jquery-ui.js'></script>
    <script src='../assets/bootstrap/tab.js' type='text/javascript'></script>
    <script src='../assets/bootstrap/dropdown.js' type='text/javascript'></script>
</head>
<body>

<div class='container'>
    <div class='page-header'>
        <h2 align='center'>Riwayat Transaksi Pembelian</h2>
    </div>
    
    <?php include('../include/navigation-manager.php') ?>
    
    <table class='table table-striped table-hover table-condensed'>
    <tr>
        <th>Tanggal</th>
        <th>ID Kasir</th>
        <th>Jumlah Barang Belian</th>
    </tr>
    <?php
    include('../include/pagination.php');  
    createPagination("
        SELECT
            jumlah_barangbelian(tp.kd_transaksi) AS jumlah_barang,
            t.tanggal,
            t.no_ktp
        FROM
            transaksi_pembelian AS tp,
            transaksi AS t
        WHERE
            t.kd_transaksi = tp.kd_transaksi
    ");
    
    if (mysqli_num_rows($query) < 1) {
        echo "<tr><td colspan='5' align='center'>Tidak ada data untuk ditampilkan</td></tr>";
    }

    while ( $data = mysqli_fetch_assoc($query) ):

    ?>
    <tr>
        <td><?php echo $data['tanggal'] ?></td>
        <td><?php echo $data['no_ktp'] ?></td>
        <td><?php echo $data['jumlah_barang'] ?></td>
    </tr>
    <?php
    endwhile
    ?>
    </table>
</div>

</body>
</html>
