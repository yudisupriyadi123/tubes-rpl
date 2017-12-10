<?php
// TODO: hapus akun ratna di petugas kasir, karena dia gudang
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
        $sql = "INSERT INTO transaksi_pembelian VALUES ($last_kd_transaksi)";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>";
        } else {
            $sql = "";
            // loop over input field
            for ($index = 0; $index < count($_POST['kode_barang']); $index++) {
                // only insert completed field
                if ( !empty($_POST['kode_barang'][$index]) && !empty($_POST['jumlah'][$index])) {
                    $sql .= "INSERT INTO barang_belian VALUES (
                                $last_kd_transaksi,
                                '',
                                {$_POST['jumlah'][$index]},
                                '{$_POST['kode_barang'][$index]}'
                            );";
                }
            }

            if (!empty($sql)) {
                $query = mysqli_multi_query($conn, $sql);

                if ($query) {
                    echo "<div class='alert alert-success' role='alert'>Berhasil menambah data.</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>"; 
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>\$sql kosong</div>"; 
            }
        }    
    }
}

?>