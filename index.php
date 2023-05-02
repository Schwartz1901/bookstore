<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foreverbooks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <!-- =========================== Header ============================== -->
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <a class= "navbar-brand" href="#">Forever Books</a>
                    </div>
                    <div c;ass="collapse navbar-collapse">
                        <div class="navbar-nav" id="navbarNavAltMarkup">
                            <a class="nav-link" href="index.php?page=home">Home</a>
                            <a class="nav-link" href="#">Your shelf</a>
                            <a class="nav-link" href="index.php?page=store">Store</a>
                            <a class="nav-link" href="#">About Us</a>
                            <a class="nav-link" href="#">Login</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    <!-- =========================== Main content ============================== -->
        <main>
            <?php 
                $pages = array(
                    'home' => 'home.html',
                    'yourshelf' => 'yourshelf.php',
                    'store' => 'store.php',
                    'aboutus' => 'aboutus.php',
                    'login' => 'login.php'
                );

                // Check for the page parameter
                if (isset($_GET['page']) && isset($pages[$_GET['page']])) {
                    $page = $pages[$_GET['page']];
                } else {
                    $page = $pages['home'];
                }
                // Include the appropriate file
                include($page);
            ?>
        </main>
    <!-- =========================== Footer ================================= -->
        <footer class="container-fluid mt-5">
            <p>&copy; My Simple Bookstore online <?php echo date('Y'); ?></p>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>