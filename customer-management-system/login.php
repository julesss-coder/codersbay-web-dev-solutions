<!-- FIXME 
- How to debug login.php after sending POST request? -> First create json file for xdebug for current project
-->
<!-- 1. Check if connection to database was established
    2. Reread code for errors
    3. Always encrypt passwords in database, never save them as text.
      When checking that passwords match, actually check that encryption keys match. E.g. with function `md5($password)`
-->
<!-- LOOK UP:
Style php page with CSS / Bootstrap

-->
<?php
// Connect to database `users` via PDO
$server = "mysql:host=localhost;dbname=customer_management_system";
$dbUsername = "root";
$dbPassword = "";

try {
  $connection = new PDO($server, $dbUsername, $dbPassword);
}
catch(PDOException $e) {
  echo $e->getMessage();
}

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

  // SQL query to database with prepared statement
  $password = md5($password);
  $sqlQuery = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $query = $connection->query($sqlQuery);
  $query->execute();
  $queryOutput = $query->fetchAll();
  if (count($queryOutput) == 1) {
    session_start();
    // User gets session variable
    $_SESSION['user_id'] = $queryOutput[0]['user_id'];
    // header('location:dashboard.html');
    echo "<table class='table'>";
    foreach ($queryOutput as $row) {
      echo "<tr>";
      echo "<td>" . $row['user_id'] . "</td>";
      echo "<td>" . $row['name'] ."</td>";
      echo "<td>" . $row['email'] ."</td>";
      echo "<td>" . $row['password'] ."</td>";
      echo "</tr>";
    } 
    echo "</table>";
  } else {
    // Print message on login page. It doesn't show up now as we are redirecting to login.html.
    echo "Wrong username or password.";
    // header('location:login.html');
  }
  


  // Deal with incorrect user input



  // Strategy for login

  // Get user input
  // If email and password exists in database:
  //   Start session
  //   Forward to page dashboard
  // Else
  //   Print "user does not exist. Please register" 
  

  function printr($s){
    echo "<pre>";
      print_r($s);
    echo "</pre>";
  }
?>

