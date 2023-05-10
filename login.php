<?php

    #validate
    include_once('db.php');

    $usernameErr = $passwordErr = "";
    $username = $password ="";
    $login_error = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Username cannot be empty";
        // } else if (!filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
        //     $usernameErr = "Invalid email format";
        } 
          
          else {
            $username = test_input($_POST["username"]);
        }
    }

        if (empty($_POST["password"])) {
            $passwordErr = "password cannot be empty";
        } else if (strlen($_POST["password"]) < 8) {
            $passwordErr = "password must at least 8 characters";
        } else if (!preg_match("/[A-Z]+/", $_POST["password"])) {
            $passwordErr = "password must have at least one uppercase letter";
        } else if (!preg_match("/[1-9]+/", $_POST["password"])) {
            $passwordErr = "password must have at least one number";
        } else if (!preg_match("/[!@#%^*]+/", $_POST["password"])) {
            $passwordErr = "password must have at least one of these special character !,@,#,%,^,*"; 
        }
        else {
            $password = test_input($_POST["password"]);
        }

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

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foreverbooks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Login</title>
</head>
<body>
        <h1 class="mt-5 text-center"> Login Page </h1>
        <div class="fluid-container mt-5 d-flex justify-content-center">
            <form name="login" action="index.php?page=login" method="post">

                Username: <input type="text" id="username" name="username" value="<?php echo $username;?>"/>
                <span class="error" style="color:red"><?php echo $usernameErr;?>*</span>
                <br> <br>
                Password: <input type="password" id="password" name="password" value="<?php echo $password;?>"/>
                <span class="error" style="color:red"><?php echo $passwordErr;?>*</span>
                <br> 
                <input type="submit" value="login"/>
                <br> <br>
                <a href="index.php?page=register">Register</a>
                <span class="error" style = "color:red"><?php echo $login_error;?></span>
        </div>
    </form>
</body>

</html>
