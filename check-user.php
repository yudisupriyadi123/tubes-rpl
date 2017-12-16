<?php

if (! isset($_SESSION['username']) )
{
    header('location:../user-login.php');
}
else
{
    // $dir is global variable first defined inside `config.php`
    $user_dir = $dir[$_SESSION['tipe_akun']];
    // checking if user is access only their area of application
    if (strpos($_SERVER['REQUEST_URI'], "/$user_dir/") == false) {
        header('location:../access-forbidden.html');
    }
}

?>
