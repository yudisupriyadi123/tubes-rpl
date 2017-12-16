<?php
$title = 'Riwayat Transaksi Pembelian';
$jsfiles = array(
    '../assets/js/jspdf.js',
    './js/save-as-pdf.js');
include('../header.php');
?>

    <div style='float:right'>
        <a id='save-as-pdf' onclick='demoFromHTML()' href='#/' class='btn btn-primary'>
            <span class='glyphicon glyphicon-plus'></span> Simpan sebagai PDF
        </a>
    </div>

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
    ?>
    
    <div id="content">
    <table class='table table-striped table-hover table-condensed'>
    <tr>
        <th>Tanggal</th>
        <th>ID Kasir</th>
        <th>Jumlah Barang Belian</th>
    </tr>
    <?php
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
</div>

</body>
</html>
