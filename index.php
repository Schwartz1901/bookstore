
<?php 
    $pages = array(
        'home' => 'home.html',
        'yourshelf' => 'yourshelf.php',
        'store' => 'store.php',
        'about' => 'about.html',
        'login' => 'login.php',
        'register' => 'register.html'

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