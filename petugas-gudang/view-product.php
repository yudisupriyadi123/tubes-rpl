<?php
$tipe_akun = 'gudang';
include('../header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bagian Gudang - Toko Alfamart</title>
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
		<h2 align='center'>Produk</h2>
	</div>
	
	<?php include('../include/navigation-gudang.php') ?>
	
	<div style='margin-bottom:20px'>
        <a href='entry-product.php' class='btn btn-primary'>
            <span class='glyphicon glyphicon-plus'></span> Tambah Produk
        </a>
    </div>
	
	<table class='table table-striped table-hover table-condensed'>
	<tr>
		<th>Kode</th>
		<th>Nama</th>
		<th>Produsen</th>
		<th>Tindakan</th>
	</tr>
	<?php
	include('../include/pagination.php');	
	createPagination("SELECT * FROM produk");
	
	if (mysqli_num_rows($query) < 1) {
        echo "<tr><td colspan='5' align='center'>Tidak ada data untuk ditampilkan</td></tr>";
    }

	while ( $data = mysqli_fetch_assoc($query) ):
	?>
	<tr>
		<td><?php echo $data['kd_produk'] ?></td>
		<td><?php echo $data['nama'] ?></td>
		<td><?php echo $data['produsen'] ?></td>
		<td>
            <a href='addstock-product.php?kode=<?php echo $data['kd_produk'] ?>'>Tambah Stok</a>
            <!--    CATATAN : karena deadline saya abaikan.
                    TODO    : bereskan dibawah.
            <a href='update-product.php?action=edit&kode=<?php echo $data['kd_produk'] ?>'>Ubah</a> |
            <a href='delete-product.php?kode=<?php echo $data['kd_produk'] ?>'>Hapus</a>
            -->
        </td>
	</tr>
	<?php
	endwhile
	?>
	</table>
</div>

</body>
</html>
