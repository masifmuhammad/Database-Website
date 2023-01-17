<!DOCTYPE html>
<html>
<head>
  <title>Logout</title>
  <style>
    body {
      background-color: #C7AD7F;
      color: #333;
      font-family: sans-serif;
      text-align: center;
    }
    .logout-message {
      background-color: #C7AD7F;
      border-radius: 10px;
      display: inline-block;
      padding: 20px;
      margin: 20px;
    }
    .logout-button {
      background-color: lightgreen;
      border: none;
      border-radius: 5px;
      color: #333;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
    }
    .logout-button:hover {
      background-color: #C7AD7F;
      color: white;
    }
  </style>
  <script>
    function animateLogout() {
      const logoutMessage = document.querySelector('.logout-message');
      logoutMessage.style.transform = 'scale(1.2)';
      setTimeout(() => {
        logoutMessage.style.transform = 'scale(1)';
      }, 300);
    }
  </script>
</head>
<body>

<?php
// Initialize the session
session_start();

// Set session variables
$_SESSION["logged_out"] = true;

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();
?>

<div class="logout-message">
  <p>You have been successfully logged out.</p>
</div>

<form action="login.php">
  <input type="submit" value="Go to login page" class="logout-button" onclick="animateLogout()">
</form>

</body>
</html>
