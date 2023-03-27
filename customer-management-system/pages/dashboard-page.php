<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/style.css">
  <?php include_once('../logic/connect-to-clients-db.php'); ?>
  <title>Customer Management System - Dashboard</title>
</head>
<body>
  <!-- "Edit entry" modal -->
  <div class="modal fade" id="editEntryModal" tabindex="-1" aria-labelledby="editEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editEntryModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <?php
        // ===== CONTINUE HERE ====
        // How do I get the correct entry / the id of the entry I clicked on INTO THE MODAL, so I can request the data from the database?
        // Alternative: Just copy the data I clicked on and send it to external file. Include that file inside the modal to get the data. Then get user chanegs and send query to database.
        // Alternative: https://stackoverflow.com/questions/13135131/php-getting-variable-from-another-php-file
        // Alternative: https://www.w3schools.com/php/php_file_create.asp#:~:text=PHP%20Write%20to%20File%20%2D%20fwrite,the%20string%20to%20be%20written.
          
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Dashboard Container -->
  <div class="container dashboard-page">
    <h1>Dashboard</h1>
    <h2>Create new customer</h2>
    <div class="row">
      <div class="col create-customer">
        <!-- New customer form -->
        <form 
          method="post"
          action="../logic/dashboard.php"
          class="row g-3">
          <div class="col-md-6">
            <label for="company-name" class="form-label">Company name</label>
            <input 
              type="text" 
              class="form-control" 
              id="company-name" 
              name="company-name"
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
          <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <input 
              type="text" 
              class="form-control" 
              id="address" 
              name="address"
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
    <h2>All customers</h2>
    <div class="row">
      <div id="customer-table" class="col customer-table">
        <table>
          <thead>
            <tr>
              <th>Company ID</th>
              <th>Company name</th>
              <th>Contact person</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Created by</th>
              <th>Created at</th>
              <th>Edited at</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php
            $allEntriesQuery = "SELECT * FROM clients";
            $query = $connection->query($allEntriesQuery);
            foreach($query as $array) {  
              $companyId = $array['company_id'];
              echo "<tr>";
              echo "<td>" . $array['company_id'] . "</td>";
              echo "<td>" . $array['company_name'] . "</td>";
              echo "<td>" . $array['contact_person'] . "</td>";
              echo "<td>" . $array['phone'] . "</td>";
              echo "<td>" . $array['address'] . "</td>";
              echo "<td>" . $array['created_by'] . "</td>";
              echo "<td>" . $array['created_at'] . "</td>";
              echo "<td>" . $array['edited_at'] . "</td>";
              echo "<td><button type='button' class='btn btn-primary edit-btn' name='$companyId' data-bs-toggle='modal' data-bs-target='#editEntryModal'>Edit</button></td>";
              echo "<td><button type='button' class='delete-btn btn btn-primary' name='$companyId'  data-toggle='modal' data-target='#deleteEntryModal'>Delete</button></td>";
              echo "</tr>";
            } 
          ?>
          </tbody>
        </table>
        <!-- Create table
            Request all entries from data base
            For each entry // close php tag
            Add table entry
            // open & close php tag: }
            html for end of table
      -->
      </div>
    </div>
  </div>

  <!-- Bootstrap js or custom js first? -->
  <!-- <script src="../assets/script.js"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
