<?php
  include_once('./connect-to-db.php');
  include_once('./validate-register-input.php');

  $maxIDQuery = "SELECT MAX(user_id) FROM users";
  $query = $connection->query($maxIDQuery);
  $userID = $query->fetchAll()[0][0] + 1;
  $password = md5($password);
  $addUserQuery = "INSERT INTO `users` (user_id, name, email, password) VALUES ($userID, '$fullName', '$email', '$password');";
  $query = $connection->query($addUserQuery);
  $output = $query->fetchAll();

  header('location:../pages/login-page.php');
?>
