<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Untree.co">
  <title>Register | Furni</title>

  <!-- Styles -->
  <link rel="shortcut icon" href="favicon.png">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="assets/css/tiny-slider.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow border-0">
          <div class="card-body">
            <h2 class="text-center mb-4">Register</h2>
            <form action="#" method="POST">
              <div class="form-group mb-3">
                <label for="registerName">Full Name</label>
                <input type="text" class="form-control" id="registerName" placeholder="Enter your name">
              </div>
              <div class="form-group mb-3">
                <label for="registerEmail">Email address</label>
                <input type="email" class="form-control" id="registerEmail" placeholder="Enter email">
              </div>
              <div class="form-group mb-4">
                <label for="registerPassword">Password</label>
                <input type="password" class="form-control" id="registerPassword" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-outline-primary w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login.html">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/tiny-slider.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>
