<?php
  include_once('./connect-to-db.php');
  include_once('./validate-input.php');


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

      *Else:
        Error: this id already exists in data base. Please contact system admin.

    Connect to database `customer-management-system`  
    Insert data in `clients` table in database
  *Else:
    Keep the information already entered by the user in their fields (so they don't have to re-enter it)
    Alert user about missing information:
      Give red border to fields with missing information
*/

  if ($companyName != "" AND $contactPerson != "" AND $phoneNumber != "" AND $address != "") {
    // Get current length of database to determine the last company ID (1-indexed).
    $maxIDQuery = "SELECT MAX(company_id) FROM clients";
    $query = $connection->query($maxIDQuery);
    // Why is the output a nested array??
    $companyID = $query->fetchAll()[0][0] + 1;

    $dateCreated = new DateTimeImmutable();
    // How to convert this date to MySQL date format?
    $dateCreated = $dateCreated->format('Y-m-d');

    // Query to insert new entry into database
    $insertQuery = "INSERT INTO clients (company_id, company_name, contact_person, phone, address, created_at) VALUES ($companyID, '$companyName', '$contactPerson', '$phoneNumber', '$address', '$dateCreated')";
    $query = $connection->query($insertQuery);
    $queryOutput = $query->fetchAll();

    header('location:../pages/dashboard-page.php');
  }
?>
