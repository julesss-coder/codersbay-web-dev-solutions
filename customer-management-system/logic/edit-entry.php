<?php
  session_start();
  include_once('./connect-to-db.php');
  include_once('./validate-input.php');

  $createdBy = $_POST['created_by'];

  // This check is unnecessary, as the user only gets displayed edit buttons for the entry they created.
  if ($createdBy != $_SESSION['user_id']) {
    echo "<p>You do not have the right to edit this entry, as it was created by a different user.</p>
    <p>Back to <a href='../pages/dashboard-page.php'>dashboard</a></p>";
  } else {
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
  }
?>
