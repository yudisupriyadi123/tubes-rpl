<?php
$tipe_akun = 'gudang';
if (! isset($_GET['kode']) ) header('location:view-product.php');
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok - Bagian Gudang - Toko Alfamart</title>
    <link href='./assets/css/main.css' rel='stylesheet' type='text/css' />
    <link href='./assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    
    <script src='./assets/bootstrap/js/jquery.js' type='text/javascript'></script>
    <script src='./assets/bootstrap/js/jquery-ui.js'></script>
    <script src='./assets/bootstrap/tab.js' type='text/javascript'></script>
    <script src='./assets/bootstrap/dropdown.js' type='text/javascript'></script>

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
        <h2 align='center'>Tambah Stok</h2>
    </div>
    
    <?php include('include/navigation.php') ?>
    
    <form class='form-horizontal well' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
        <?php include('insert-stock.php'); ?>

        <?php
        $sql = "SELECT kd_produk, nama, produsen FROM produk WHERE kd_produk = '$_GET[kode]'";
        $result = mysqli_query($conn, $sql);
        // TODO: tidak harus di while?
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class='form-group'>
            <label for='kd_produk' class='control-label col-lg-5'>Kode</label>
            <div class='col-lg-7'>
                <input type='text' name='kd_produk' class='form-control'
                    value='<?php echo $row['kd_produk']; ?>' readonly />
            </div>
        </div> 

        <div class='form-group'>
            <label for='nama_produk' class='control-label col-lg-5'>Nama</label>
            <div class='col-lg-7'>
                <input type='text' name='nama_produk' class='form-control'
                    value='<?php echo $row['nama']; ?>' readonly />
            </div>
        </div>

        <div class='form-group'>
            <label for='produsen' class='control-label col-lg-5'>Produsen</label>
            <div class='col-lg-7'>
                <input type='text' name='produsen' class='form-control'
                    value='<?php echo $row['produsen']; ?>' readonly />
            </div>
        </div>
        
        <div class='form-group'>
            <label for='jumlah' class='control-label col-lg-5'>Jumlah</label>
            <div class='col-lg-7'>
                <input type='text' name='jumlah' class='form-control' />
            </div>
        </div>
        
        <div class='form-group'>
            <label for='cari_supplier' class='control-label col-lg-5'>Supplier</label>
            <div class='col-lg-7'>
                <input type='text' name='cari_supplier' class='form-control'
                    placeholder="tekan ENTER untuk mencari supplier" />
            </div>
            <!-- TODO: gunakan ajax -->
        </div> 

        <div id="supplier" class="well">Tidak ada supplier</div>
        
        <input type='hidden' name='kd_supplier' value='-1' />
        
        <div class='form-group'>
            <div class='col-lg-offset-5 col-lg-7'>
                <button class='btn btn-danger'>Simpan</button>
                <!-- TODO: atur url absolut -->
                <a href='view_product.php' class='btn btn-default'>Batal</a>
            </div>
        </div>
    </form>
</div>

<script>
    $('input[name=cari_supplier]').keyup(function(e){
        if (e.keyCode == 13) searchSupplier($(this).val());
    });
    function searchSupplier(words) {
        $.ajax({
            method: 'POST',
            url: 'ajax/search_supplier.php',
            data: { keyword: words }
        }).done(function(res_html){
            $("#supplier").html(res_html);
        });  
    }

    // clicking a.supplier-item means selecting a supplier
    $('#supplier').on('click', 'a.supplier-item', function(){
        var kode = $(this).data('kd-supplier');
        getSupplier(kode);
    });
    function getSupplier(kd_supplier) {
        $.ajax({
            method: 'POST',
            url: 'ajax/search_supplier.php',
            data: { keyword: kd_supplier }
        }).done(function(res_html){
            $("#supplier").html(res_html);
        });
    }

    // action before submiting form
    $("form").submit(function(){
        // get kode supplier
        var kode = $("table#data-supplier").data('kd-supplier') || -1;
        $('input[name=kd_supplier').val(kode); 
        return true;
    });

    // prevent user submit form by Enter
    // since this page will search supplier by Enter
    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });
</script>

</body>
</html>
