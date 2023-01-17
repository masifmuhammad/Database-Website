<?php
// Start the session
session_start();



// If parameters username and password not properly set, redirect to home page
if (!empty($_POST['username']) && !empty($_POST['password'])) {

    // A separate file to hide login details
    include './connection.php';

    // username and password sent from form
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $query = "SELECT username 
            FROM ea_Admin 
            WHERE username = '$username' and password = '$password';";

    // Run Select SQL query
    $results = $conn->query($query);

    $count = $results->num_rows;

    // Close connection after executing the query
    $conn->close();

    // If result matched given username and password, there must be 1 row
    if ($count == 1) {
        $_SESSION["username"] = $username;

        header("location: index.php");
        die();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      background-color: #C7AD7F;
      color: white;
      font-family: sans-serif;
      text-align: center;
    }
    .login-form {
      background-color: #333;
      border-radius: 10px;
      display: inline-block;
      padding: 50px;
      margin: 30px;
    }
    .login-form input[type="text"],
    .login-form input[type="password"] {
      border: none;
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 10px;
      padding: 10px;
      width: 90%;
    }
    .login-form label {
      display: block;
      font-size: 18px;
      margin-bottom: 5px;
    }
    .login-form #login_form_error {
      color: red;
      font-size: 14px;
      margin-bottom: 20px;
    }
    .login-button {
      background-color: lightgreen;
      border: none;
      border-radius: 5px;
      color: black;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
    }
    .login-button:hover {
      background-color: #C7AD7F;
      color: #333;
    }
  </style>
  <script>
    function animateLogout() {
      const loginForm = document.querySelector('.login-form');
      loginForm.style.transform = 'scale(1.2)';
      setTimeout(() => {
        loginForm.style.transform = 'scale(1)';
      }, 300);
    }
  </script>
</head>
<body class="login">
  <form class="login-form" action="login.php" method="POST">
    <label for="username">Username:</label><br/>
    <input type="text" name="username" required/><br/><br/>
    <label for="password">Password:</label><br/>
    <input type="password" name="password" required/><br/><br/>
    <?php
    if (!empty($error)) {
        ?>
        <p id="login_form_error"><?php echo $error ?></p><br>
        <?php
    }
    ?>
    <input type="submit" value="Login" class="login-button" onclick="animateLogout()">
  </form>

</body>
</html>

