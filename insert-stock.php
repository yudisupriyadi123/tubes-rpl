<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $result = mysqli_query($conn, "
        SELECT no_ktp
        FROM petugas_gudang
        WHERE akun_username = '$_SESSION[username]'
    ");
    $row = mysqli_fetch_assoc($result);

    $tanggal_supplai = date('Y-m-d');
    $query = mysqli_query($conn, "INSERT INTO supplier_produk values(
                            '',
                            '$tanggal_supplai',
                            $_POST[jumlah],
                            '$row[no_ktp]',
                            '$_POST[kd_produk]',
                            '$_POST[kd_supplier]'
                        )");
                    
    if ($query) {
        echo "<div class='alert alert-success' role='alert'>Berhasil menambah data.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>";
    }
}

?>
