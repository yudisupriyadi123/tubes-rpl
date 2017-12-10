<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $sql = "INSERT INTO produk VALUES (
                '$_POST[kd_produk]',
                '$_POST[nama_produk]',
                '$_POST[produsen]',
                '$_POST[sertifikat_mui]',
                '$_POST[sertifikat_bpom]',
                '$_POST[harga]'
            )";
    $query = mysqli_query($conn, $sql);
                    
    if ($query) {
        echo "<div class='alert alert-success' role='alert'>Berhasil menambah data.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>";
    }
}

?>