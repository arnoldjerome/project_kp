<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3//assets/css/all.min.css" rel="stylesheet">
  <link href="/assets/css/tiny-slider.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
  <style>
    body {
      background-color: #fefdf9;
    }

    .product-image {
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    .quantity-selector {
      width: 140px;
    }

    .accordion-button {
      padding-left: 0;
    }

    .accordion-item {
      border: none;
    }

    .btn-dark {
      background-color: #2d2d2d;
      border: none;
    }

    .text-dark {
      color: #000 !important;
    }
  </style>
</head>

<body>

  <!-- Start Header/Navigation -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <img src="assets/images/bcs.png" alt="Logo" style="height: 80px;">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
        aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="active"><a class="nav-link" href="shop.html">Shop</a></li>
          <li><a class="nav-link" href="about.html">About us</a></li>
          <li><a class="nav-link" href="services.html">Services</a></li>
          <li><a class="nav-link" href="blog.html">Blog</a></li>
          <li><a class="nav-link" href="contact.html">Contact us</a></li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
          <li><a class="nav-link" href="login.html"><img src="/assets/images/user.svg"></a></li>
          <li><a class="nav-link" href="cart.html"><img src="/assets/images/cart.svg"></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <div class="container py-5">
    <div class="row g-5 align-items-start">
      <!-- Gambar Produk -->
      <div class="col-md-6 text-center">
        <img src="/assets/images/in/10.png" alt="Produk" class="product-image">
      </div>

      <!-- Detail Produk -->
      <div class="col-md-6">
        <h2 class="fw-normal text-dark"><b>SOFA</b></h2>
        <p class="fs-5 text-dark">Rp 1.500.000</p>
        <p class="text-dark">Indoor Furniture</p>

        <!-- Selector jumlah -->
        <div class="d-flex align-items-center mb-3">
          <div class="quantity-selector d-flex align-items-center">
            <button class="btn btn-outline-secondary" type="button" id="btn-minus">−</button>
            <input type="text" class="form-control text-center mx-1" id="quantity-input" value="1" readonly
              style="width: 60px;">
            <button class="btn btn-outline-secondary" type="button" id="btn-plus">+</button>
          </div>
        </div>

        <!-- Tombol keranjang -->
        <div class="mb-4">
          <button class="btn btn-dark w-100">Buy Now</button>
        </div>

        <!-- Accordion untuk info tambahan -->
        <div class="accordion" id="productDetailsAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingDesc">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseDesc">
                Description
              </button>
            </h2>
            <div id="collapseDesc" class="accordion-collapse collapse" data-bs-parent="#productDetailsAccordion">
              <div class="accordion-body">
                Ini adalah deskripsi produk lengkap. Cocok untuk segala kebutuhan dan dibuat dengan material berkualitas.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingDetails">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseDetails">
                Detail
              </button>
            </h2>
            <div id="collapseDetails" class="accordion-collapse collapse" data-bs-parent="#productDetailsAccordion">
              <div class="accordion-body">
                • Ukuran: 40x60 cm<br>
                • Material: Beton alami<br>
                • Berat: 5 kg
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingReturn">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseReturn">
                Stok
              </button>
            </h2>
            <div id="collapseReturn" class="accordion-collapse collapse" data-bs-parent="#productDetailsAccordion">
              <div class="accordion-body">
                Tersedia: 25 unit
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Bootstrap dan JS Button Logic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('btn-minus').addEventListener('click', () => {
      const input = document.getElementById('quantity-input');
      let value = parseInt(input.value);
      if (value > 1) {
        input.value = value - 1;
      }
    });

    document.getElementById('btn-plus').addEventListener('click', () => {
      const input = document.getElementById('quantity-input');
      let value = parseInt(input.value);
      input.value = value + 1;
    });
  </script>
</body>

</html>
