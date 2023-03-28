<?php
  include_once('./connect-to-db.php');
  include_once('./validate-input.php');

  if ($companyName != "" AND $contactPerson != "" AND $phoneNumber != "" AND $address != "") {
    $companyId = $_POST['company-id'];
    $dateEdited = new DateTimeImmutable();
    $dateEdited = $dateEdited->format('Y-m-d');

    // QUESTION: Do I have to replace all PHP variables in the SQL query with placeholders to make the statement safe from SQL injection?
    try {
      $editQuery = "UPDATE `clients`
      SET `company_name` = '$companyName',
      `contact_person` = '$contactPerson',
      `phone` = '$phoneNumber',
      `address` = '$address',
      `edited_at` = '$dateEdited'
      WHERE `company_id` = ?";
      $statement = $connection->prepare($editQuery);
      echo "<br/>";
      $statement->execute([$companyId]);
    } catch (PDOException $e) {
      echo "Could not edit entry: " . $e->getMessage();
    }

    header('location:../pages/dashboard-page.php');
  }
?>
