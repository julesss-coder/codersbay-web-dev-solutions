<!-- FIXME
  - [ ] Build field to check password

-->
<?php

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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
        $email = test_input($_POST["email"]);
        echo $email;
      }
  
      if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        echo $passwordErr;
      } else {
        $password = test_input($_POST["password"]);
        echo $password;
      }
    }
  
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

     // Connect to database `users` via PDO
  $server = "mysql:host=localhost;dbname=customer_management_system";
  $username = "root";
  $password = "";
  
  try {
    $connection = new PDO($server, $username, $password);
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }

  // SQL query to database
  // $sqlQuery = "select * from users";
  // foreach ($connection->query($sqlQuery) as $row) {
  //   echo $row['user_id']."<br />";
  //   echo $row['name']."<br />";
  //   echo $row['email']."<br />";
  //   echo $row['password']."<br /><br />";
  // }

  // Prepared statement with anonymous parameters

  $statement = $connection->prepare("SELECT * FROM users");
  $statement->execute(array());
  while($row = $statement->fetch()) {
    echo $row['user_id']." ".$row['name']."<br />";
    echo "E-Mail: ".$row['email']."<br /><br />";
  }


?>
