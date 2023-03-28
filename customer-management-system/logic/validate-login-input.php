<?php
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
// If form was submitted:
  if (isset($_POST['submit'])) {
    // Validate submitted data
    $emailErr = "";
    $passwordErr = "";
    $email = "";
    $password = "";
  
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        // echo $email;
      }
      
      if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        echo $passwordErr;
      } else {
        $password = test_input($_POST["password"]);
        // echo $password;
      }
    }
  }
?>