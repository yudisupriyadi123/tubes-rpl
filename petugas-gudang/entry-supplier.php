<?php
$title = 'Tambah Supplier';
include('../header.php');
?>
    
    <form class='form-horizontal well' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
        <?php include('insert-supplier.php'); ?>

        <div class='form-group'>
            <label for='kd_supplier' class='control-label col-lg-5'>Kode</label>
            <div class='col-lg-7'>
                <input type='text' name='kd_supplier' class='form-control' value='AUTO GENERATED' disabled />
            </div>
        </div> 
        
        <div class='form-group'>
            <label for='nama_supplier' class='control-label col-lg-5'>Nama Supplier</label>
            <div class='col-lg-7'>
                <input type='text' name='nama_supplier' class='form-control' />
            </div>
        </div>

        <div class='form-group'>
            <label for='produsen' class='control-label col-lg-5'>Alamat</label>
            <div class='col-lg-7'>
                <input type='text' name='alamat' class='form-control' />
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

</body>
</html>
