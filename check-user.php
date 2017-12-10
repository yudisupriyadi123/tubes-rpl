<?php
session_start();

if (! isset($_SESSION['username']) )
{
    header('location:user-login.php');
}
else
{
    /* @var $tipe_akun didefinisikan di setiap page.
     * Setiap page mengisi @var $tipe_akun untuk menandai page tersebut boleh diakses oleh siapa
     */
    if ($_SESSION['tipe_akun'] != $tipe_akun) {
        header('location:access-forbidden.html');
    }
}

?>
