<?php
  $username = "";
  $email = "";
  $errors = array();

  //connnect to DB
  $db = mysqli_connect('localhost', 'root', '', 'registtration');

  // if the register button is clicked
  if (isset($_POST['register'])) {
    $username = mysql_real_escape_string($_POST['username']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $password = mysql_real_escape_string($_POST['password']);

    //ensure form fields filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }

    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Two passwords don't match");
    }

    if(count($errors) == 0) {
        $password = md5($password_1);
        $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
        mysql_query($db, $sql);
    }
  }
?>
