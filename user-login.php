<?php
session_start();
include('config.php');
include('connection.php');

if (isset($_SESSION['username'])) header("location:".$homepage[$_SESSION['tipe_akun']]);
?>

<!DOCTYPE html>
<html>
<head>

  <title>USER LOGIN</title>

    <link href='./assets/css/login.css' rel='stylesheet' type='text/css' />

</head>
<body>

    <div class="login">
        <h1 align='center'>USER LOGIN</h1>

        <form class='form-horizontal' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
            <?php include('validate-login.php') ?>
            <input type='text' name='username' maxlength='15' placeholder='Username' />
            <input type='password' name='password' maxlength='20' class='form-control input-lg' placeholder='Password' />
            <button class='btn btn-lg btn-primary btn-block'>Sign In</button>
        </form>
    </div>
  

</body>
</html>

