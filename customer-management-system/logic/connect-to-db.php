<?php
  // QUESTION: Do I have to check for a session variable, in case someone accesses this page directly?
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
?>