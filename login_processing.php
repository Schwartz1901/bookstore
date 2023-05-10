  <?php
    include_once('db.php');
    if ($username && $password) {    
            $sql_select = "SELECT password FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql_select);
            $row = mysqli_fetch_row($result);
            $r_password = $row[0];
            echo hash('md5', $password) === $r_password;
                if (hash('md5', $password) === $r_password) {
                // if ($password === $r_password) {
                    $cookie_name = $username;
                    $cookie_value = "ref";
                    $_SESSION[$username] = "Logged in";
                    if (!isset($_COOKIE[$cookie_name])) {
                        setcookie($cookie_name, $cookie_value, time() + 86400, "/");
                    }
                    //direc to home
                    echo 'ri';
                    header( 'Location: home.html');
                    exit();
                } else {
                    $login_error =  "Incorrect username or password";
                }
            }

?>