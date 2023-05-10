<?php 
    include 'db.php';
    $limit = isset($_GET["records"])? $_GET["records"] : 5;
    $pagenum = isset($_GET['pagenum'])? $_GET['pagenum'] : 1;

    $result = $conn->query("SELECT Title, Author, Price FROM books");
    $total_rows = $result->num_rows;
    $total_pages = ceil($total_rows/$limit);
    $start = ($pagenum - 1) * $limit;
    $search_content = isset($_GET["search"])? $_GET["search"] : '';
    if ($search_content) {
        $pag_result = $conn->query("SELECT Title, Author, Price FROM books 
        WHERE (Title = '$search_content' OR Author = '$search_content' OR Price = '$search_content')
        ORDER BY Title 
        ASC LIMIT $start, $limit");
    } else {
        $pag_result = $conn->query("SELECT Title, Author, Price FROM books ORDER BY Title ASC LIMIT $start, $limit");
    }


    $books = $pag_result->fetch_all(MYSQLI_ASSOC)

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foreverbooks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>
    <!-- =========================== Header ============================== -->
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <a class= "navbar-brand" href="#">Forever Books</a>
                    </div>
                    <div c;ass="collapse navbar-collapse">
                        <div class="navbar-nav" id="navbarNavAltMarkup">
                            <a class="nav-link" href="index.php?page=home">Home</a>
                            <a class="nav-link" href="#">Shelf</a>
                            <a class="nav-link" href="index.php?page=products">Products</a>
                            <a class="nav-link" href="index.php?page=about">About</a>
                            <a class="nav-link" href="index.php?page=login">Login</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>


<main>
    <div class="container-fluid mt-5 mx-auto d-flex justify-content-start">
    <form method="GET" action="index.php?page=products">
        <label for="records">Limit records</label>
        <input type="number" id="records" name="records" />
        <input type="text" value="products" name="page" hidden/>
        <button type="submit">Send</button>
    </form>

    <form method="GET" action="index.php?page=products">
        <label for="search">Search</label>
        <input type="text" id="search" name="search" />
        <input type="text" value="products" name="page" hidden/>
        <button type="submit">Send</button>
    </form>
    </div>

    <nav>
            <ul class="pagination">
                <?php
                echo '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';
                    for ($i = 1; $i <= $total_pages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="index.php?page=products&pagenum='.$i.'&records='.$limit.'">'.$i.'</a></li>';
                    }
                echo '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
                ?>
            </ul>
        </nav>

<table class="table table-hover" id="pagination-container">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($books as $book) : ?>
            <tr>
                <td><?= $book['Title']; ?></td>
                <td><?= $book['Author']; ?></td>
                <td><?= $book['Price']; ?></td>
            <tr>
        <?php endforeach;?> 
    </tbody>
</table>
</main>


