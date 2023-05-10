
<?php
    session_start();
    $pages = array(
        'home' => 'home.html',
        'yourshelf' => 'yourshelf.php',
        'products' => 'products.php',
        'about' => 'about.html',
        'login' => 'login.php',
        'register' => 'register.php'

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