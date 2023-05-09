<?php
  session_start();
    #validate
    include_once('db.php');

    $usernameErr = $passwordErr = "";
    $username = $password ="";
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
      
              // if (hash('md5', $password) === $r_password) {
                if ($password === $r_password) {
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
                  echo "Incorrect username or password";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form name="login" action="index.php?page=login" method="post">

        Email: <input type="text" id="username" name="username" value="<?php echo $username;?>"/>
        <span class="error"><?php echo $usernameErr;?></span>
        <br> <br>
        Password: <input type="password" id="password" name="password" value="<?php echo $password;?>"/>
        <span class="error"><?php echo $passwordErr;?></span>
        <br>
        <input type="submit" value="login"/>

    </form>
</body>

</html>
