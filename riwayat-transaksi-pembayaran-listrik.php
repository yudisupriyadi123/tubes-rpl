<?php
$tipe_akun = 'gudang';
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bagian Manager - Toko Alfamart</title>
    <link href='./assets/css/main.css' rel='stylesheet' type='text/css' />
    <link href='./assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    
    <script src='./assets/bootstrap/js/jquery.js' type='text/javascript'></script>
    <script src='./assets/bootstrap/js/jquery-ui.js'></script>
    <script src='./assets/bootstrap/tab.js' type='text/javascript'></script>
    <script src='./assets/bootstrap/dropdown.js' type='text/javascript'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
</head>
<body>

<div class='container'>
    <div class='page-header'>
        <h2 align='center'>Riwayat Transaksi Pembayaran Listrik</h2>
    </div>
    
    <?php include('include/navigation.php') ?>

    <div style='float:right'>
        <a id='save-as-pdf' onclick='demoFromHTML()' href='#/' class='btn btn-primary'>
            <span class='glyphicon glyphicon-plus'></span> Simpan sebagai PDF
        </a>
    </div>
    
    <?php
    include('include/pagination.php');  
    createPagination("
        SELECT
            t.tanggal,
            t.no_ktp,
            tp.biaya_tagihan
        FROM
            transaksi_pembayaran AS tp,
            transaksi AS t
        WHERE
            t.kd_transaksi = tp.kd_transaksi AND
            tp.jenis_pembayaran = 'listrik'
    ");
    ?>
    <div id="content">
    <table class='table table-striped table-hover table-condensed'>
    <tr>
        <th>Tanggal</th>
        <th>ID Kasir</th>
        <th>Biaya Tagihan</th>
    </tr>
    <?php
    if (mysqli_num_rows($query) < 1) {
        echo "<tr><td colspan='5' align='center'>Tidak ada data untuk ditampilkan</td></tr>";
    }

    while ( $data = mysqli_fetch_assoc($query) ):

    ?>
    <tr>
        <td><?php echo $data['tanggal'] ?></td>
        <td><?php echo $data['no_ktp'] ?></td>
        <td><?php echo $data['biaya_tagihan'] ?></td>
    </tr>
    <?php
    endwhile
    ?>
    </table>
    </div>
</div>

<div id="editor"></div>

<script>
        function demoFromHTML() {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('#content')[0];

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 1200
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }
            , margins);
        }
</script>

</body>
</html>
