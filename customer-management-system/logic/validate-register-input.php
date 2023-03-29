<?php
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
// If form was submitted:
  if (isset($_POST['submit'])) {
    echo var_dump($_POST);
    // Validate submitted data
    $fullName = "";
    $emailErr = "";
    $passwordErr = "";
    $email = "";
    $password = "";
    $passwordReentry = "";
    $passwordReentryErr = "";
  
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $fullName = test_input($_POST["full-name"]);
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        echo $emailErr;
      } else {
        //  filter_var() returns true if the email is valid, false otherwise. 
        // i.e. in this case the condition is fulfulled if email VALID
        // => Then why do we assign a value to $emailErr?
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
        $email = test_input($_POST["email"]);
      }
      
      if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        echo $passwordErr;
      } else {
        if (empty($_POST["password-reentry"])) {
          $passwordErr = "Please reenter your chosen password.";
          echo $passwordReentryErr;
        } else {
          if ($password == $passwordReentry) {
            echo "password == reentered password";
            $password = test_input($_POST["password"]);
          }
        }
      }
    }
  }
?>