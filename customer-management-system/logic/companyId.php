<?php

if (isset($_POST['submit'])) {
  $companyId = "";
  $companyIdErr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["company-id"])) {
      $companyIdErr = "Company id is required";
      echo $companyIdErr;
    } else {

      $companyId = test_input($_POST["company-id"]);
      echo $companyId;
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
}
?>