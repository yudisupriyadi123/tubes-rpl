<?php
$title = 'Riwayat Transaksi Pembayaran Online';
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
            t.tanggal,
            t.no_ktp,
            tp.biaya_tagihan
        FROM
            transaksi_pembayaran AS tp,
            transaksi AS t
        WHERE
            t.kd_transaksi = tp.kd_transaksi AND
            tp.jenis_pembayaran = 'online'
    ");
    ?>

    <div id="content">
    <table class='table table-striped table-hover table-condensed'>
    <tr>
        <th>Tanggal</th>
        <th>ID Kasir</th>
        <th>Biaya Tagihan</th>
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
        <td><?php echo $data['biaya_tagihan'] ?></td>
    </tr>
    <?php
    endwhile
    ?>
    </table>
    </div>
</div>

</body>
</html>
