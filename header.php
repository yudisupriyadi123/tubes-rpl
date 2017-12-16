<?php
/**
 * This file needs to called after you specify @var $title that contain page title.
 */
?>
<?php include('../head.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php if ($_SESSION['tipe_akun'] == 'manager'): ?>
    <title><?php echo $title; ?> - Manager - Toko Alfamart</title>
    <?php endif; ?>
    <?php if ($_SESSION['tipe_akun'] == 'kasir'): ?>
    <title><?php echo $title; ?> - Kasir - Toko Alfamart</title>
    <?php endif; ?>
    <?php if ($_SESSION['tipe_akun'] == 'gudang'): ?>
    <title><?php echo $title; ?> - Petugas Gudang - Toko Alfamart</title>
    <?php endif; ?>
    
    <link href='../assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <link href='../assets/css/main.css' rel='stylesheet' type='text/css' />

    <script src='../assets/bootstrap/js/jquery.js' type='text/javascript'></script>
    <script src='../assets/bootstrap/js/jquery-ui.js'></script>
    <script src='../assets/bootstrap/tab.js' type='text/javascript'></script>
    <script src='../assets/bootstrap/dropdown.js' type='text/javascript'></script>

    <?php
    // include css file if exist.
    $cssfile='./css/'.basename($_SERVER['SCRIPT_NAME'], '.php').'.css';
    if (file_exists($cssfile)) {
        echo "<link href='$cssfile' rel='stylesheet' type='text/css' />";
    } ?>

    <?php
    // include js file if exist.
    // array @var $jsfile defined in each of php file that calls this header
    if (isset($jsfiles)) {
        for ($i=0; $i < count($jsfiles); $i++) {
            $jsfile=$jsfiles[$i];
            if (file_exists($jsfile)) {
                echo "<script src='$jsfile' type='text/javascript'></script>";
            }  
        }  
    }
    ?>
</head>
<body>

<div class='container'>
    <div class='page-header'>
        <h2 align='center'><?php echo $title; ?></h2>
    </div>
    
    <?php include('../include/navigation-'.$_SESSION['tipe_akun'].'.php') ?>
