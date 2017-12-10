<?php
include('../header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Online - Kasir - Toko Alfamart</title>
    <link href='../assets/css/main.css' rel='stylesheet' type='text/css' />
    <link href='../assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    
    <script src='../assets/bootstrap/js/jquery.js' type='text/javascript'></script>
    <script src='../assets/bootstrap/js/jquery-ui.js'></script>
    <script src='../assets/bootstrap/tab.js' type='text/javascript'></script>
    <script src='../assets/bootstrap/dropdown.js' type='text/javascript'></script>

    <style>
    form {
        width: 600px;
        margin: 0 auto;
    }
    </style>
</head>
<body>

<div class='container'>
    <div class='page-header'>
        <h2 align='center'>Pembayaran Online</h2>
    </div>
    
    <?php include('../include/navigation-kasir.php') ?>
    
    <form class='form-horizontal well' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
        <?php include('insert-kasir-pembayaran-online.php'); ?>

        <div class='form-group'>
            <label for='id_member' class='control-label col-lg-5'>ID member</label>
            <div class='col-lg-7'>
                <input type='text' name='id_member' class='form-control' />
                <input type='checkbox' id='nonmember' /> bukan member
            </div>
        </div> 

        <div class='form-group'>
            <label for='no_tagihan' class='control-label col-lg-5'>No Tagihan</label>
            <div class='col-lg-7'>
                <input type='text' name='no_tagihan' class='form-control' />
            </div>
        </div>

        <div class='form-group'>
            <label for='biaya_admin' class='control-label col-lg-5'>Biaya Admin</label>
            <div class='col-lg-7'>
                <div class='input-group'>
                    <span class="input-group-addon">Rp.</span>
                    <input type='text' name='biaya_admin' class='form-control' />
                </div>
            </div>
        </div>

        <div class='form-group'>
            <label for='biaya_tagihan' class='control-label col-lg-5'>Biaya Tagihan</label>
            <div class='col-lg-7'>
                <div class='input-group'>
                    <span class="input-group-addon">Rp.</span>
                    <input type='text' name='biaya_tagihan' class='form-control' />
                </div>
            </div>
        </div>
        
        <div class='form-group'>
            <div class='col-lg-offset-5 col-lg-7'>
                <button class='btn btn-danger'>Simpan</button>
                <a href='' class='btn btn-default'>Batal</a>
            </div>
        </div>
    </form>
</div>

<script>
$("#nonmember").click(function(){
    memberElm = $("input[name=id_member]");
    if (memberElm.val() == '999') {
        memberElm.val('');
        memberElm.attr('readonly', false);
    } else {
        memberElm.val('999');
        memberElm.attr('readonly', true);  
    }
});
</script>

</body>
</html>
