<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $sql = "INSERT INTO supplier VALUES (
                '',
                '$_POST[nama_supplier]',
                '$_POST[alamat]'
            )";
    $query = mysqli_query($conn, $sql);
                    
    if ($query) {
        echo "<div class='alert alert-success' role='alert'>Berhasil menambah data.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>";
    }
}

?>