<?php
  // Connect to database `clients` via PDO
 $host = "localhost";
 $database = "customer_management_system";
 $charset = "utf8mb4";
 $username = "root";
 $password = "";
 $server = "mysql:host=$host;dbname=$database;charset=$charset";
 
 try {
   $connection = new PDO($server, $username, $password);
 }
 catch(PDOException $e) {
   echo $e->getMessage();
 }

//  Might need to comment this out for testing.
// if (isset($_SESSION['user_id'])) {
//   session_start();

// } else {
//   header('location:login.html');
// }


?>