
<?php 
    require_once("db.php"); 
    $sql = "SELECT Title, Author, Price FROM books";
    $result = $conn->query($sql);


    $limit = 10;
    $page = 0;
    $output = '';

    if(isset($_POSTR["page"])) {
        $page = $_POST["page"];
    } else {
        $page = 1;
    }

    $start_from =($page - 1) * $limit;
    $query = mysqli_query($conn, "SELECT Title, Author, Price FROM books ORDER BY Title ASC LIMIT $start_from, $limit" );
    $output .= '
        <div class="container-fluid mt-5">
            <table class="table table-hover">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                </tr>
    ';
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_array($query)) {
            $output .= '
                <tr>
                    <td>'.ucfirst($row["Title"]).'</td>
                    <td>'.ucfirst($row["Author"]).'</td>
                    <td>'.ucfirst($row["Price"]).'</td>
                </tr>
            ';
        }
    } else {
        $output.='
            <tr>
                <td> Data not Found. </td>
            </tr>
        ';
    }

    $output .= '
        </table>
        </div>
    ';

    //pagination
    $query = mysqli_query($conn, "SELECT Title, Author, Price FROM books");
    $total_records = mysqli_num_rows($query);
    $total_pages = ceil($total_records/$limit);
    $output .= '<ul class="pagination">';

    if($page > 1) {
        $previous = $page - 1;
        $output .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
        $output .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
    }

    for($i=1; $i<=$total_pages; $i++) {
        $active_class = "";
        if($i == $page) {
            $active_class ="active";
        }
        $output .= '<li class="page-item"'.$active_class.'" id="'.$i.'"><span class="page-link">'.$i.'</span></li>';
    }

    if($page < $total_pages) {
        $page++;
        $output .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i class ="fa fa-arrow-right"></i></span></li>';
        $output .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
    }
    $output .= '</ul>';
    echo $output;
?>

