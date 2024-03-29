<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header('location:./login-page.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <?php include_once('../logic/connect-to-db.php'); ?>
  <?php include_once('../logic/validate-input.php'); ?>
  <link rel="stylesheet" href="../assets/style.css">
  <title>Customer Management System - Dashboard</title>
</head>
<body>
  <!-- Modal (editing entries) -->
  <div class="modal fade" id="editEntryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body edit-entry-modal-body"></div>
      </div>
    </div>
  </div>

  <!-- Modal (deleting entries) -->
  <div class="modal fade" id="deleteEntryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete entry</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body delete-entry-modal-body">
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand h1" href="#">Customer Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
            <form 
                method="post"
                action="../logic/logout.php">
                  <button 
                    type="submit" 
                    class="btn btn-primary" 
                    name="submit">
                    Sign out
                  </button>
                </form>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Dashboard Container -->
  <div class="container dashboard-page my-5">
    <h1>Dashboard</h1>
    <h2>Create new customer</h2>
    <div class="row create-customer-section mb-5">
      <div class="col create-customer">

        <!-- New customer form -->
        <form 
          method="post"
          action="../logic/dashboard.php"
          class="row g-3">
          <div class="col-12">
            <label for="company-name" class="form-label">Company name</label>
            <input 
              type="text" 
              class="form-control" 
              id="company-name" 
              name="company-name"
              placeholder="Company name"
              required>
          </div>
          <div class="col-12">
            <label for="contact-person" class="form-label">Contact person</label>
            <input 
              type="text" 
              class="form-control" 
              id="contact-person" 
              placeholder="Contact person" 
              name="contact-person"
              required
              >
          </div>
          <div class="col-12">
            <label for="phone-number" class="form-label">Phone number</label>
            <input 
              type="text" 
              class="form-control" 
              id="phone-number" 
              placeholder="Phone number" 
              name="phone-number"
              required>
          </div>
          <div class="col-12">
            <label for="address" class="form-label">Address</label>
            <input 
              type="text" 
              class="form-control" 
              id="address" 
              name="address"
              placeholder="Address"
              required>
          </div>
          <div class="col-12">
            <button 
              type="submit" 
              class="btn btn-primary" 
              name="submit">Create customer</button>
          </div>
        </form>
      </div>
    </div>
    
    <!-- All customers list -->
    <h2>All customers</h2>
    <div class="row">
      <div id="customer-table" class="col customer-table">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Company ID</th>
              <th scope="col">Company name</th>
              <th scope="col">Contact person</th>
              <th scope="col">Phone</th>
              <th scope="col">Address</th>
              <th scope="col">Created by</th>
              <th scope="col">Created at</th>
              <th scope="col">Edited at</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php
            $allEntriesQuery = "SELECT * FROM clients";
            $query = $connection->query($allEntriesQuery);
            foreach($query as $array) {  
              $companyId = $array['company_id'];
              echo "<tr>";
              echo "<th scope='row'>" . $array['company_id'] . "</th>";
              echo "<td>" . $array['company_name'] . "</td>";
              echo "<td>" . $array['contact_person'] . "</td>";
              echo "<td>" . $array['phone'] . "</td>";
              echo "<td>" . $array['address'] . "</td>";
              echo "<td>" . $array['created_by'] . "</td>";
              echo "<td>" . $array['created_at'] . "</td>";
              echo "<td>" . $array['edited_at'] . "</td>";
              if ($array['created_by'] == $_SESSION['user_id']) {
                echo "<td><button type='button' class='btn btn-primary edit-btn'  data-bs-toggle='modal' data-bs-target='#editEntryModal' data-id='$companyId'>Edit</button></td>";
                echo "<td><button type='button' class='delete-btn btn btn-primary'  data-bs-toggle='modal' data-bs-target='#deleteEntryModal' data-id='$companyId'>Delete</button></td>";
              } else {
                echo "<td></td>";
                echo "<td></td>";
              }
              echo "</tr>";
            } 
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="../assets/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
