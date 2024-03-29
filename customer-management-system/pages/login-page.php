<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/style.css">
  <title>Customer Management System - Login</title>
</head>
<body>
  <!-- Wie schaffe ich es, die Werte inm Formular zu behalten? -->
  <!-- Der Ansatz auf https://www.w3schools.com/php/php_form_complete.asp funktioniert nicht. -->
  <div class="container my-3 login-page">
    <h1>Please log in</h1>
    <div class="row">
      <div class="col">
        <form 
          method="post"
          action="../logic/login.php"
          >
          <div class="mb-3">
            <label 
              for="email" 
              class="form-label">Email address
              <span class="error">*</span>
            </label>
            <input 
              type="email" 
              class="form-control" 
              id="email" 
              name="email" 
              aria-describedby="emailHelp" 
              required
            >
          </div>
          <div class="mb-3">
            <label 
              for="password" 
              class="form-label">Password
              <span class="error">*</span>
            </label>
            <input 
              type="password" 
              class="form-control" 
              id="password" 
              name="password" 
              required
            >
          </div>
          <?php
          session_start();
          if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
          }
          ?>
          <button 
            type="submit" 
            name="submit"
            class="login-btn btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
<?php 
  // If user gets to login page after sign out: end session
  // In order to end session, it needs to be started first. 
  // I need to pass $_SESSION['error'] to this page to alert a user that their user data does not exist. Therefore, I cannot reset the session on the top of the page. trying the bottom now:
  // session_start();
  session_destroy();
  $_SESSION = array();
?>
