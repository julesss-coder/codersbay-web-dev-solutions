<?php
  include_once('./connect-to-db.php');

  if (isset($_POST['submit'])) {
    $companyId = $_POST['company-id'];

    // QUESTION: Do I have to replace all PHP variables in the SQL query with placeholders to make the statement safe from SQL injection?
    try {
      $deleteQuery = "DELETE FROM `clients`
      WHERE `company_id` = ?";
      $statement = $connection->prepare($deleteQuery);
      echo "<br/>";
      $statement->execute([$companyId]);
    } catch (PDOException $e) {
      echo "Could not edit entry: " . $e->getMessage();
    }
  }

  header('location:../pages/dashboard-page.php');
?>
