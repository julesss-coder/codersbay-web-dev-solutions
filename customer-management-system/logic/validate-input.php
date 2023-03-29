<?php
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
}
?>