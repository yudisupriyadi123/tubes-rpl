<?php
include('../connection.php');

$sql = "
    SELECT * FROM supplier
    WHERE
        kd_supplier LIKE '%$_POST[keyword]%' OR
        nama LIKE '%$_POST[keyword]%'
    ";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

if ($num_rows == 0) echo 'Tidak ada supplier yang cocok';
if ($num_rows == 1):
    $row = mysqli_fetch_assoc($result);
?>

<table id='data-supplier' data-kd-supplier='<?php echo $row['kd_supplier']; ?>'>
<col width="80">
<col width="12">
<tr>
    <td>Nama</td>
    <td>:</td>
    <td><?php echo $row['nama']; ?></td>
</tr>
<tr>
    <td>Alamat</td>
    <td>:</td>
    <td><?php echo $row['alamat']; ?></td>
</tr>
</table>

<?php
endif;
if ($num_rows > 1)
{
    echo "Ada $num_rows supplier ditemukan (<b>klik untuk memilih</b>): <br><br>";

    $no = 0;
    while ($row = mysqli_fetch_assoc($result)):
        $no++;
?>

<a href='#/' class='supplier-item' data-kd-supplier='<?php echo $row['kd_supplier']; ?>'>
    <?php echo $no.". ".$row['nama']." (".$row['alamat'].")"; ?>
</a> <br>

<?php
    endwhile;
}
?>
