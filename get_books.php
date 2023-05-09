<?php 
    include 'db.php';
    $limit = isset($_POST["records"])? $_POST["records"] : 5;
    $pagenum = isset($_GET['pagenum'])? $_GET['pagenum'] : 1;

    $result = $conn->query("SELECT Title, Author, Price FROM books");
    $total_rows = $result->num_rows;
    $total_pages = ceil($total_rows/$limit);
    $start = ($pagenum - 1) * $limit;
    $pag_result = $conn->query("SELECT Title, Author, Price FROM books ORDER BY Title ASC LIMIT $start, $limit");

    $books = $pag_result->fetch_all(MYSQLI_ASSOC)

?>