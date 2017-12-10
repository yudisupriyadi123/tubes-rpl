<?php
function createPagination($query_Sql) {
    global $query;
    global $conn;
    /**
     * START - alur program untuk PAGINATION
     *
     * @var $number_pagination          jumlah pagination (bukan 1 - 10 tapi semua)
     * @var $min_number_pagination      angka mulai dari pagination - digunakan untuk sort pagination agar hanya tampilkan 10 baris pagination
     * @var $max_number_pagination      angka akhir dari pagination - digunakan untuk sort pagination agar hanya tampilkan 10 baris pagination
     * @var $total_limit                jumlah data yang ditampilkan dalam page. Default: 5     - digunakan untuk query MySQL
     * @var $min_limit                  start / awal indeks data yang akan ditampilkan.         - digunakan untuk query MySQL
     */
            if ( empty($_GET['page']) )
                $_GET['page'] = 1;
            
            $_GET['page']   = (int) $_GET['page']; // convert to integer
        
            $query = mysqli_query($conn, $query_Sql);

            if (!$query) {
                echo "<div class='alert alert-danger' role='alert'>" . mysqli_error($conn) . "</div>"; 
                exit;
            }

            $jmlh_baris = mysqli_num_rows($query);
        
            if ($jmlh_baris > 0) {
                $number_pagination = $jmlh_baris / 5;
        
                    if (is_float($number_pagination) ) {
                        $number_pagination = (int) $number_pagination; // convert to intenger
                        $number_pagination++;
                    }
            
                $min_number_pagination = 1; // set MIN pagination
                $max_number_pagination = 10; // set MAX pagination
        
                if ($_GET['page'] >= 10) {
                    $min_number_pagination = $_GET['page'] - 9;
                    $max_number_pagination = $_GET['page'];
                }
            
                if ($number_pagination < 10)
                    $max_number_pagination = $number_pagination;
            
                if  ($_GET['page'] == $max_number_pagination) {
                    if ($number_pagination != $max_number_pagination) {
                        $min_number_pagination++;
                        $max_number_pagination++;
                    } elseif ($max_number_pagination >= 10) {
                        $min_number_pagination = $_GET['page'] - 9;
                        $max_number_pagination = $_GET['page'];
                    }
                } elseif ($_GET['page'] == $min_number_pagination) {
                    if ($_GET['page'] != 1) {
                        $min_number_pagination--;
                        $max_number_mupagination--;
                    }
                }
    
                $total_limit    = 5;
                $min_limit      = ($_GET['page'] * 5) - 5;
            
                echo "<ul class='pagination'>";
                echo "<li><a href='?page=1'>&laquo;</a></li>";
                for ($i = $min_number_pagination; $i <= $max_number_pagination; $i++) {
                    // untuk memberi efek pagination sedang aktif (with CSS)
                    $attr_active = '';
                    if ($i == $_GET['page'])
                        $attr_active = 'class="active"';
                    
                    echo "<li $attr_active><a href='?page=$i'>$i</a></li>";
                }
                echo "<li><a href='?page=$number_pagination'>&raquo;</a></li>";
                echo "</ul>";

                $query = mysqli_query($conn, "$query_Sql limit $min_limit, $total_limit");
            }
            
            return $query;

    /* END - alur program untuk PAGINATION */
}
