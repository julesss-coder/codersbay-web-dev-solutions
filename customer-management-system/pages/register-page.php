<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/style.css">
  <title>Customer Management System - Register</title>
</head>
<body>
  <div class="container my-3 register-page">
    <h1>Please register:</h1>
    <div class="row">
      <div class="col">
        <form
          method="post"  
          action="../logic/register.php"
        >
        <div class="mb-3">
            <label 
              for="full-name" 
              class="form-label">Full name</label>
            <input 
              type="text" 
              class="form-control" 
              id="full-name" 
              name="full-name"
            >
          </div>
          <div class="mb-3">
            <label 
              for="email" 
              class="form-label">Email address</label>
            <input 
              type="email" 
              class="form-control" 
              id="email" 
              name="email"
              aria-describedby="emailHelp"
              required
            >
            <span class="error">*</span>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label 
              for="password" 
              class="form-label">Password</label>
            <input 
              type="password" 
              class="form-control" 
              id="password"
              name="password"
              required
            >
            <span class="error">*</span>
          </div>
          <div class="mb-3">
            <label 
              for="password-reentry" 
              class="form-label">Reenter password</label>
            <input 
              type="password" 
              class="form-control" 
              id="password-reentry"
              name="password-reentry"
              required
            >
            <span class="error">*</span>
          </div>
          <button 
            type="submit"
            name="submit"
            class="register-btn btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
