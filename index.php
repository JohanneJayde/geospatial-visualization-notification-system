<!--
HTML file for user login, will also act as the landing page for project website
Code taken from https://codeshack.io/secure-login-system-php-mysql/
and modified to fit our project
-->
<?php
  include('php/config.php');
  include('php/database.php'); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>USAF NATURAL DISASTER ALERT</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="login">
  <h1>Login</h1>
  <form action="php/login.php" method="post" autocomplete="off">
    <label for="email">
      <i class="fas fa-envelope"></i>
    </label>
    <input type="email" name="email" placeholder="Email" id="email" required>
    <label for="password">
      <i class="fas fa-lock"></i>
    </label>
    <input type="password" name="password" placeholder="Password" id="password" required>

    <input type="submit" value="Login">
  </form>
  <h2>Register</h2>
  <a href="registration.html">Register</a>
</div>
</body>
</html>