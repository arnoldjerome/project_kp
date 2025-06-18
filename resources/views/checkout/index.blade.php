<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout - Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet"> {{-- Optional CSS --}}
</head>

<body class="bg-light">

  {{-- HEADER --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="/assets/images/bcs.png" alt="Logo" style="height: 80px;">
      </a>
    </div>
  </nav>

  <div class="container py-5">
    {{-- Judul Halaman --}}
    <div class="row mb-4">
      <div class="col">
        <h2 style="color: #000; font-weight: bold;">Checkout</h2>
        <p class="text-muted">Complete your addresss details.</p>
      </div>
    </div>

    <div class="row">
      {{-- FORM ALAMAT --}}
      <div class="col-md-7">
        <div class="p-4 bg-white rounded shadow-sm">
          <form action="#" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
              </div>
              <div class="col">
                <label for="last_name" class="form-label">Second Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Second name" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="street_address" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Street and number" required>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
              </div>
              <div class="col">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="00-000" pattern="\d{2}-\d{3}" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="country" class="form-label">Country</label>
              <select id="country" name="country" class="form-select" required>
                <option selected disabled>Select country</option>
                <option value="Poland">Poland</option>
                <option value="Indonesia">Indonesia</option>
                <option value="USA">United States</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="123456789" pattern="\d{9}" required>
              <small class="form-text text-muted">Keep 9-digit format with no spaces and dashes.</small>
            </div>

            <button type="submit" class="btn btn-dark w-100">Continue to Payment</button>
          </form>
        </div>
      </div>

      {{-- ORDER SUMMARY --}}
      <div class="col-md-5 mt-4 mt-md-0">
        <div class="p-4 bg-white rounded shadow-sm">
          <h4 style="color: #000; font-weight: bold;">Order summary</h4>
          <hr>
          <div class="mb-3">
            {{-- Produk --}}
            <div class="d-flex justify-content-between mb-3">
              <div>
                <p class="mb-1">Product name</p>
                <small>Color: RED<br>Size: 32</small>
              </div>
              <div class="text-end">
                <p class="mb-1">1 ×</p>
                <p>15.99€</p>
              </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
              <div>
                <p class="mb-1">Product name</p>
                <small>Color: RED<br>Size: 32</small>
              </div>
              <div class="text-end">
                <p class="mb-1">1 ×</p>
                <p>10.99€</p>
              </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
              <div>
                <p class="mb-1">Product name</p>
                <small>Color: RED<br>Size: 32</small>
              </div>
              <div class="text-end">
                <p class="mb-1">1 ×</p>
                <p>5.99€</p>
              </div>
            </div>
          </div>

          <hr>
          <div class="d-flex justify-content-between">
            <span>Subtotal (3 items)</span>
            <strong>32,97 €</strong>
          </div>
          <div class="d-flex justify-content-between">
            <span>Shipping cost</span>
            <strong>8,99 €</strong>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <h5 style="color: #000; font-weight: bold;">Total</h5>
            <h5 style="color: #000; font-weight: bold;"><strong>41,96 €</strong></h5>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
