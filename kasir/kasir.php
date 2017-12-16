<?php
/**
 * HATI-HATI: Tidak konsisten menamai antara kode_barang dan kode_produk, kd_barang, kd_produk sama saja
 */
$title = 'KASIR';
include('../header.php');
?>
    
    <form class='form-horizontal well' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
        <?php include('insert-kasir.php'); ?>

        <div class='form-group'>
            <label for='id_member' class='control-label col-lg-7'>ID member</label>
            <div class='col-lg-4'>
                <input type='text' name='id_member' class='form-control' />
                <input type='checkbox' id='nonmember' /> bukan member
            </div>
        </div> 
        
        <hr>
        <h4>Barang Belian</h4>
        <hr>
        <div class="products">
        <!-- below just for for cloning by jQuery -->
            <div class="row items" style="display:none">
                <div class="col-lg-8">
                    <div class='form-group'>
                        <label for='barang' class='control-label col-lg-3'>Barang</label>
                        <div class='col-lg-9'>
                            <input type='text' name='barang' class='form-control'
                                placeholder='Cari dengan kode atau nama' autocomplete='off' />
                            <div class="search-result"></div>
                            <input type="hidden" name="kode_barang[]" value="" />
                            <input type="hidden" name="harga[]" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class='form-group'>
                        <label for='jumlah[]' class='control-label col-lg-5'>Jumlah</label>
                        <div class='col-lg-7'>
                            <input type='text' name='jumlah[]' class='form-control jumlah-field' />
                        </div>
                    </div>
                </div>
            </div>
            <!-- above just for for cloning by jQuery -->
            <div class="row items">
                <div class="col-lg-8">
                    <div class='form-group'>
                        <label for='barang' class='control-label col-lg-3'>Barang</label>
                        <div class='col-lg-9'>
                            <input type='text' name='barang' class='form-control'
                                placeholder='Cari dengan kode atau nama' autocomplete='off' />
                            <div class="search-result"></div>
                            <input type="hidden" name="kode_barang[]" value="" />
                            <input type="hidden" name="harga[]" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class='form-group'>
                        <label for='jumlah[]' class='control-label col-lg-5'>Jumlah</label>
                        <div class='col-lg-7'>
                            <input type='text' name='jumlah[]' class='form-control jumlah-field' />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row items">
                <div class="col-lg-8">
                    <div class='form-group'>
                        <label for='barang' class='control-label col-lg-3'>Barang</label>
                        <div class='col-lg-9'>
                            <input type='text' name='barang' class='form-control'
                                placeholder='Cari dengan kode atau nama' autocomplete='off' />
                            <div class="search-result"></div>
                            <input type="hidden" name="kode_barang[]" value="" />
                            <input type="hidden" name="harga[]" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class='form-group'>
                        <label for='jumlah[]' class='control-label col-lg-5'>Jumlah</label>
                        <div class='col-lg-7'>
                            <input type='text' name='jumlah[]' class='form-control jumlah-field' />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class='form-group'>
            <div class='col-lg-5'>
                <div id="harga-total">Rp.0</div>
                <input type="hidden" id="hidden-harga-total" value="0" />
            </div>
            <div class='col-lg-7'>
                <button class='btn btn-danger btn-block'>Proses</button>
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

// add new row every user set focus on last row
$(".products").on('focus', '.row:last input', function(){
    $(".products > .row").first().clone().appendTo(".products")
        .attr('style', ''); // remove display:none css
});

$(".products").on('keyup', 'input[name=barang]', function(e){
    var thisElm = $(this);

    $.ajax({
        method: 'POST',
        url: '../ajax/search_product.php',
        data: { keyword: thisElm.val() }
    }).done(function(res_html){
        thisElm.parent().find(".search-result").html(res_html);
    });
});

// clicking 'list-group-item a' means selecting a product
$('.products').on('click', '.list-group-item a', function(){
    var kode = $(this).data('kd-produk');
    var nama = $(this).data('nama-produk');
    var harga = $(this).data('harga-produk');
    // TODO: use jQuery closest() instead rather than parnets()
    var searchResultElement = $(this).parents(".search-result");
    // important
    searchResultElement.parent().find("input[name^=kode_barang]").val(kode);
    // not important, just display for user
    searchResultElement.parent().find("input[name=barang]").val(nama);
    // just for showing Harga in client
    searchResultElement.parent().find("input[name^=harga]").val(harga);
    // destroy search result
    searchResultElement.html(''); 
    // update showed total harga
    updateHarga(); 
});

function updateHarga()
{
    var total_harga = 0;
    $(".products").find(".row").each(function(idx, data){
        var jumlah = parseInt($(this).find("input[name^=jumlah]").val());
        var harga = parseInt($(this).find("input[name^=harga]").val());
        if (!isNaN(harga) && !isNaN(jumlah)) {
            total_harga += jumlah * harga;
            $("#harga-total").text('Rp.' + total_harga);
        }
    });
};

$(".products").on("keyup", ".jumlah-field", function(){
    updateHarga(); 
});

/* Handled by 'list-group-item a' (search result) click event
$("input[name=barang]").blur(function(){
    updateHarga($(this).closest(".row")); 
});
*/


// prevent user submit form by Enter
// since this page will need user to press Enter to add new row
$(document).ready(function() {
    $(window).keydown(function(e){
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });

    $(window).click(function(){
        // when search result dropdown already showed, close it
        // May be after user search a product, she then go to jumlah field
        $(".search-result").html('');
    });
});

</script>

</body>
</html>
