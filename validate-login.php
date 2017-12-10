<?php
/**
 * Checking username and password match any account
 * This file only included by user-login.php (not as standalone script)
 */

function displayError($message) {
  echo '<div class="alert">'.$message.'</div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // sql query
  $sql = "SELECT check_login('$_POST[username]','$_POST[password]') AS status_login";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if ($row['status_login'] == -1) displayError('Username anda salah');
  if ($row['status_login'] ==  0) displayError('Password anda salah');
  if ($row['status_login'] ==  1) {
    $sql = "
      SELECT tipe_akun
      FROM pengguna
      WHERE username = '$_POST[username]'
    ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['tipe_akun'] = $row['tipe_akun'];
    header("location:". $homepage[$row['tipe_akun']]);
  }
}

?>

