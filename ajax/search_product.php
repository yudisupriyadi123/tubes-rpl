<?php
include('../connection.php');

$sql = "
    SELECT * FROM produk
    WHERE
        kd_produk LIKE '%$_POST[keyword]%' OR
        nama LIKE '%$_POST[keyword]%'
    ";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

if ($num_rows == 0) echo 'Tidak ada barang yang cocok';
if ($num_rows >= 1)
{
    echo '<ul class="list-group" style="absolute">';
    echo '<li class="list-group-item">Hasil Pencarian:</li>';
    $no = 0;
    while ($no <= 2 && $row = mysqli_fetch_assoc($result)):
        $no++;
?>
        <li class="list-group-item">
            <a href='#/' class='barang-item'
                data-kd-produk='<?php echo $row['kd_produk']; ?>'
                data-nama-produk='<?php echo $row['nama']; ?>'
                data-harga-produk='<?php echo $row['harga']; ?>'>
                <?php echo $no.". (".$row['kd_produk'].") ".$row['nama'].""; ?>
            </a>
        </li>  

<?php
    endwhile;
    if ($no == 3) {
        echo "<li class='list-group-item' style='background-color: #f3fc66'>
                Hanya 3 item yang ditampilkan.
                Gunakan kata kunci yang spesifik.</li>";
    }
    echo '</ul>';
}
?>
