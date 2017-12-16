<?php
$title = 'Tambah Produk';
include('../header.php');
?>
    
    <form class='form-horizontal well' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
        <?php include('insert-product.php'); ?>

        <div class='form-group'>
            <label for='kd_produk' class='control-label col-lg-5'>Kode</label>
            <div class='col-lg-7'>
                <input type='text' name='kd_produk' class='form-control' />
            </div>
        </div> 
        
        <div class='form-group'>
            <label for='nama_produk' class='control-label col-lg-5'>Nama</label>
            <div class='col-lg-7'>
                <input type='text' name='nama_produk' class='form-control' />
            </div>
        </div>

        <div class='form-group'>
            <label for='produsen' class='control-label col-lg-5'>Produsen</label>
            <div class='col-lg-7'>
                <input type='text' name='produsen' class='form-control' />
            </div>
        </div>
        
        <div class='form-group'>
            <label for='sertifikat_mui' class='control-label col-lg-5'>Sertifikat MUI</label>
            <div class='col-lg-7'>
                <input type='text' name='sertifikat_mui' class='form-control' />
            </div>
        </div>

        <div class='form-group'>
            <label for='sertifikat_bpom' class='control-label col-lg-5'>Sertifikat BPOM</label>
            <div class='col-lg-7'>
                <input type='text' name='sertifikat_bpom' class='form-control' />
            </div>
        </div>

        <div class='form-group'>
            <label for='harga' class='control-label col-lg-5'>Harga</label>
            <div class='col-lg-7'>
                <div class='input-group'>
                    <span class="input-group-addon">Rp.</span>
                    <input type='text' name='harga' class='form-control' />
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

</body>
</html>
