<?php
  session_start();
  include_once('./connect-to-db.php');
  include_once('./validate-input.php');
  if (!isset($_SESSION['user_id'])) {
    echo "<p>Access denied.</p>";
  } else {  
    if ($companyName != "" AND $contactPerson != "" AND $phoneNumber != "" AND $address != "") {
      // Get current length of database to determine the last company ID (1-indexed).
      $maxIDQuery = "SELECT MAX(company_id) FROM clients";
      $query = $connection->query($maxIDQuery);
      $companyID = $query->fetchAll()[0][0] + 1;

      $dateCreated = new DateTimeImmutable();
      $dateCreated = $dateCreated->format('Y-m-d');
      $createdBy = $_SESSION['user_id'];

      // Query to insert new entry into database
      $insertQuery = "INSERT INTO clients (company_id, company_name, contact_person, phone, address, created_by, created_at) VALUES ($companyID, '$companyName', '$contactPerson', '$phoneNumber', '$address', '$createdBy', '$dateCreated')";
      $query = $connection->query($insertQuery);
      $queryOutput = $query->fetchAll();

      header('location:../pages/dashboard-page.php');
    }
  }
?>
