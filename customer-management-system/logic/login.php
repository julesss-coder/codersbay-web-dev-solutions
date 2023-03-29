<!-- FIXME 
- How to debug login.php after sending POST request? -> First create json file for xdebug for current project
-->
<!-- LOOK UP:
Style php page with CSS / Bootstrap
-->
<?php
  session_start();
  include_once('./connect-to-db.php');
  include_once('./validate-login-input.php');
  
  // SQL query to database with prepared statement
  $password = md5($password);
  $sqlQuery = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $query = $connection->query($sqlQuery);
  $query->execute();
  $queryOutput = $query->fetchAll();

  // Warum ist der Output sowohl ein assoziatives als auch ein indexiertes Array?
  // echo print_r($queryOutput[0]['user_id']);
  
  // If a user with the given email and password is found in the `users` database:
  if (count($queryOutput) == 1) {
    // User gets session variable
    $_SESSION['user_id'] = $queryOutput[0]['user_id'];
    header('location:../pages/dashboard-page.php');
  } else {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['error'] = "<p>This user does not exist.<p>";
      header('location:../pages/login-page.php');
    } 
  }
?>

