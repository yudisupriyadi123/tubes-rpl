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

  if ($row['status_login'] == 0) displayError('Username anda salah');
  if ($row['status_login'] ==  1) displayError('Password anda salah');
  if ($row['status_login'] ==  2) {
    $sql = "
      SELECT tipe_akun
      FROM pengguna
      WHERE username = '$_POST[username]'
    ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $tipe_akun = $row['tipe_akun'];

    $tabel_pegawai = "";
    if ($tipe_akun == 'kasir') $tabel_pegawai = "petugas_kasir";
    if ($tipe_akun == 'gudang') $tabel_pegawai = "petugas_gudang";

    $ktp = "";
    // manager has no KTP
    if ($tabel_pegawai != "") {
        $result = mysqli_query($conn, "
          SELECT no_ktp
          FROM $tabel_pegawai
          WHERE akun_username = '$_POST[username]'
        ");
        $row = mysqli_fetch_assoc($result);
        $ktp = $row['no_ktp'];
    }
    

    $_SESSION['username'] = $_POST['username'];
    //$_SESSION['password'] = $_POST['password'];
    $_SESSION['tipe_akun'] = $tipe_akun;
    $_SESSION['no_ktp'] = $ktp;
    header("location:". $homepage[$row['tipe_akun']]);
  }
}

?>

