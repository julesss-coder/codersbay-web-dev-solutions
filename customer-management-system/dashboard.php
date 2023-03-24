<?php
 // Connect to database `clients` via PDO
 $server = "mysql:host=localhost;dbname=customer_management_system";
 $username = "root";
 $password = "";
 
 try {
   $connection = new PDO($server, $username, $password);
 }
 catch(PDOException $e) {
   echo $e->getMessage();
 }

if (isset($_SESSION['user_id'])) {

}
session_start();
<!-- If session variable is empty: -->
if (!$_SESSION['auth']) {
  header('location:login.html');
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

 $statement = $connection->prepare("SELECT * FROM clients");
 $statement->execute(array());
 while($row = $statement->fetch()) {
   echo $row['company_id']." ".$row['company_name']."<br />";
   echo $row['contact_person']." ".$row['phone']."<br />";
   echo $row['address']." ".$row['created_by']."<br />";
   echo $row['created_at']." ".$row['edited_at']."<br />";
 }


?>
