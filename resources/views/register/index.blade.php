<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | BCS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .btn-custom {
      background-color: #d0c1a9;
      color: #000;
      border: none;
    }

    .btn-custom:hover {
      background-color: #b8a88e;
      color: #000;
    }
  </style>
</head>

<body class="bg-light">

  <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background-color: #d0c1a9;">
    <div class="row w-100 justify-content-center">
      <div class="col-lg-8 bg-white rounded-4 shadow d-flex overflow-hidden p-0">

        <!-- Left Panel (background image full) -->
        <div class="col-md-6 p-0" style="background: url('/assets/images/bcsBg.png') no-repeat center center; background-size: cover;">
          <!-- Empty -->
        </div>

        <!-- Right Panel -->
        <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
          <h4 class="mb-4"><b>Register</b></h4>
          <form action="#" method="POST">
            <div class="mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" required />
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" required />
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" placeholder="Repeat Password" name="repeat_password" required />
            </div>
            <button type="submit" class="btn btn-custom w-100 mb-2">Register</button>
            <div class="text-center">
              <small>Already have an account? <a href="login" class="text-primary text-decoration-none">Login</a></small>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
