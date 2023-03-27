<?php
  include_once('./connect-to-clients-db.php');
/*
TODO: Find out about sessions and how to identify which user is logged in and has created a new entry. --> Assign that user's id to the "created-by" column in MySQL INSERT statement. 
TASK: Creating new users in the database via the login form
STRATEGY 1  
If user submits form: 
  Print submitted information
  Check that all required fields have been filled in // How?
    required fields: company-name, contact-person, phone-number, address
  If all required fields have been filled in:
    Create new ID for new entry:
      Get highest ID (max(company_id)) from table
        // * getting length does not work, as we can delete entries from the table. Thus, the last ID !== number of entries.
      new id = highest ID + 1
      // Do I need to check this? Should not happen anyway
      If new id is not in database yet: 
        Create new entry:
          Get data about user and edit (created-by, created-on, edited-on):
          created-by = currently logged in user
          created-on = current datetime
          // This does not belong in the strategy for creating a new user. Separate creating and editing users
          // If this is an edit and not a new creation:
          // edited-on

      Else:
        Error: this id already exists in data base. Please contact system admin.

    Connect to database `customer-management-system`  
    Insert data in `clients` table in database
  Else:
    Keep the information already entered by the user in their fields (so they don't have to re-enter it)
    Alert user about missing information:
      Give red border to fields with missing information

---
TASK: Show all users in database `clients`, with option to edit and delete each one

---

TASK: Edit an already existing user in `clients` database
*/

// Experiment: Get DOM elements
// $document = new DOMDocument();
// $document->loadHTMLFile("dashboard.html");
// $document->saveHTML();
// $customerTable = $document->getElementById('customer-table');
// echo "customerTable: ";
// var_dump($customerTable);
// $customersButton = $document->createElement("button", "Show all customers");
// $customerTable->appendChild($customersButton);
// if ($document->validate()) {
//   echo "valid";
// };
// $document->validateOnParse = true;
// $document->Load('dashboard.html');

// echo $document->getElementById('customer-table')->tagName;

//  // Connect to database `clients` via PDO
//  // --> put in separate file, then include in php page
//  $host = "localhost";
//  $database = "customer_management_system";
//  $charset = "utf8mb4";
//  $username = "root";
//  $password = "";
//  $server = "mysql:host=$host;dbname=$database;charset=$charset";
 
//  try {
//    $connection = new PDO($server, $username, $password);
//  }
//  catch(PDOException $e) {
//    echo $e->getMessage();
//  }

// //  Might need to comment this out for testing.
// // if (isset($_SESSION['user_id'])) {
// //   session_start();

// // } else {
// //   header('location:login.html');
// // }

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }

// // If form was submitted:
// if (isset($_POST['submit'])) {
//   // Validate submitted data
//   $companyName = "";
//   $companyNameErr = "";
//   $contactPerson = "";
//   $contactPersonErr = "";
//   $phoneNumber = "";
//   $phoneNumberErr = "";
//   $address = "";
//   $addressErr = "";

  
//   if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (empty($_POST["company-name"])) {
//       $emailErr = "Company name is required";
//       echo $emailErr;
//     } else {
//       $companyName = test_input($_POST["company-name"]);
//     }
    
//     if (empty($_POST["contact-person"])) {
//       $contactPersonErr = "Contact person is required";
//       echo $contactPersonErr;
//     } else {
//       $contactPerson = test_input($_POST["contact-person"]);
//     }

//     if (empty($_POST['phone-number'])) {
//       $phoneNumberErr = "Phone number is required.";
//       echo $phoneNumberErr;
//     } else {
//       $phoneNumber = test_input($_POST['phone-number']);
//     }

//     if (empty($_POST['address'])) {
//       $addressErr = "Address is required.";
//       echo $addressErr;
//     } else {
//       $address = test_input($_POST['address']);
//     }
//   }

  // If all required fields have been filled:
  if ($companyName != "" AND $contactPerson != "" AND $phoneNumber != "" AND $address != "") {
    // Get current length of database to determine the last company ID (1-indexed).
    $maxIDQuery = "SELECT MAX(company_id) FROM clients";
    $query = $connection->query($maxIDQuery);
    // is there a simpler way to print the ID? There is only one row in the output, so foreach() seems unnecessary
    // Why is the output a nested array??
    $companyID = $query->fetchAll()[0][0] + 1;


    // Generate company ID for new entry
    echo $companyID . "<br/>";
    // Generate missing fields required for complete entry
    $dateCreated = new DateTimeImmutable();
    // echo gettype($dateCreated);
    // $dateCreated = $dateCreated->format('Y-m-d H:i:s');
    // How to convert this date to MySQL date format?
    $dateCreated = $dateCreated->format('Y-m-d');
    echo $dateCreated; // 2023-03-25
    // As the entry was just created, there is no value for edited-on.
    $dateEdited = ""; // or NULL?

    // Query to insert new entry into database
    // `address` seems to be a reserved keyword
    $insertQuery = "INSERT INTO clients (company_id, company_name, contact_person, phone, address, created_at) VALUES ($companyID, '$companyName', '$contactPerson', '$phoneNumber', '$address', '$dateCreated')";
    $query = $connection->query($insertQuery);
    // Hier entsteht ein Problem:
    // Fatal error: Uncaught PDOException: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '9' for key 'PRIMARY' in C:\xampp\htdocs\Customer_Management_System\dashboard.php:138 Stack trace: #0 C:\xampp\htdocs\Customer_Management_System\dashboard.php(138): PDOStatement->execute() #1 {main} thrown in C:\xampp\htdocs\Customer_Management_System\dashboard.php on line 138
    // Observation: When I commented out the following line, the new entry was inserted (as before), but no error was thrown.
    // Assumption: The previous line ` $query = $connection->query($insertQuery);` inserts the entry. Running the following line, `$query->execute();`, attempts to insert it again. 
    // Assumption 2: That is where the `Integrity constraint violation` comes from. The line tried to insert the same entry (same id!) again, but since ids have to be unique, an error is thrown.
    // TODO: Handle this error.
    // $query->execute();
    $queryOutput = $query->fetchAll();

    header('location:../pages/dashboard-page.php');
  }
// }
?>
