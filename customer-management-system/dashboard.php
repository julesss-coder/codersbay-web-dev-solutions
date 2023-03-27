<?php
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
      Get length of database `clients`
      new id = length + 1
      // Do I need to check this? Should not happen anyway
      If new id is not in database yet: 
        Create new entry:
          Get data about user and edit (created-by, created-on, edited-on):
          created-by = currently logged in user
          created-on = current datetime
          // This does not belong in the strategy for creating a new user. Separate creating and editing users/
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

//  Might need to comment this out for testing.
// if (isset($_SESSION['user_id'])) {
//   session_start();

// } else {
//   header('location:login.html');
// }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// If form was submitted:
if (isset($_POST['submit'])) {
  // Validate submitted data
  $companyName = "";
  $companyNameErr = "";
  $contactPerson = "";
  $contactPersonErr = "";
  $phoneNumber = "";
  $phoneNumberErr = "";
  $address = "";
  $addressErr = "";

  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["company-name"])) {
      $emailErr = "Company name is required";
      echo $emailErr;
    } else {
      $companyName = test_input($_POST["company-name"]);
    }
    
    if (empty($_POST["contact-person"])) {
      $contactPersonErr = "Contact person is required";
      echo $contactPersonErr;
    } else {
      $contactPerson = test_input($_POST["contact-person"]);
    }

    if (empty($_POST['phone-number'])) {
      $phoneNumberErr = "Phone number is required.";
      echo $phoneNumberErr;
    } else {
      $phoneNumber = test_input($_POST['phone-number']);
    }

    if (empty($_POST['address'])) {
      $addressErr = "Address is required.";
      echo $addressErr;
    } else {
      $address = test_input($_POST['address']);
    }
  }

  // If all required fields have been filled:
  if ($companyName != "" AND $contactPerson != "" AND $phoneNumber != "" AND $address != "") {
    // Get current length of database to determine the last (1-indexed) company ID.
    $lengthQuery = "SELECT COUNT(*) FROM clients";
    $query = $connection->query($lengthQuery);
    $query->execute();
    $queryOutput = $query->fetchAll();
    // Why is the output a nested array??
    $lastCompanyID = $queryOutput[0][0]; // prints the number of elements in database

    // Generate company ID for new entry
    $companyID = $lastCompanyID + 1;
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
    $insertQuery = "INSERT INTO clients (company_id, company_name, contact_person, phone, created_at) VALUES ($companyID, '$companyName', '$contactPerson', '$phoneNumber', '$dateCreated')";
    $query = $connection->query($insertQuery);
    // Hier entsteht ein Problem:
    // Fatal error: Uncaught PDOException: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '9' for key 'PRIMARY' in C:\xampp\htdocs\Customer_Management_System\dashboard.php:138 Stack trace: #0 C:\xampp\htdocs\Customer_Management_System\dashboard.php(138): PDOStatement->execute() #1 {main} thrown in C:\xampp\htdocs\Customer_Management_System\dashboard.php on line 138
    // Observation: When I commented out the following line, the new entry was inserted (as before), but no error was thrown.
    // Assumption: The previous line ` $query = $connection->query($insertQuery);` inserts the entry. Running the following line, `$query->execute();`, attempts to insert it again. 
    // Assunmption 2: That is where the `Integrity constraint violation` comes from. The line tried to insert the same entry (same id!) again, but since ids have to be unique, an error is thrown.
    // TODO: Handle this error.
    // $query->execute();
    $queryOutput = $query->fetchAll();

  }

  // echo $companyName . "<br/>";
  // echo $contactPerson . "<br/>";
  // echo $phoneNumber . "<br/>";
  // echo $address . "<br/>";  
}


// SQL query to database with prepared statement
$sqlQuery = "SELECT * FROM clients";
$query = $connection->query($sqlQuery);
$query->execute();
$queryOutput = $query->fetchAll();
echo "All clients: <br>";
print_r($queryOutput); // Are all entries in `clients` printed?


?>
