<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $now = date('Y-m-d');
    $sql = "INSERT INTO transaksi VALUES (
                '',
                '$now',
                '$_SESSION[no_ktp]',
                '$_POST[id_member]'
    )";
    $query = mysqli_query($conn, $sql);

    if (!$query)
    {
        echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>";
    }
    else
    {   
        $last_kd_transaksi = mysqli_insert_id($conn);
        $sql = "INSERT INTO transaksi_pembayaran VALUES (
                    $last_kd_transaksi,
                    $_POST[biaya_admin],
                    $_POST[biaya_tagihan],
                    'online',
                    '',
                    $_POST[no_tagihan]
                )";
        $query = mysqli_query($conn, $sql);
        
        if ($query) {
            echo "<div class='alert alert-success' role='alert'>Berhasil menambah data.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>"; 
        }
    }
}

?>