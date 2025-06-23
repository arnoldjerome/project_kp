<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3//assets/css/all.min.css"
    rel="stylesheet" />
  <link href="/assets/css/tiny-slider.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
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
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('assets/images/bcs.png') }}" alt="Logo" style="height: 80px;" />
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
        aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      @auth
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/productint') }}">Indoor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/productext') }}">Outdoor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/chat') }}">Chat</a>
      </li>
      <li class="nav-item">
        @if(Auth::user()->role === 'admin')
      <a class="nav-link" href="{{ url('/customrequests') }}">Custom Request</a>
      @else
      <a class="nav-link" href="{{ url('/invoice') }}">Invoice</a>
      @endif
      </li>
      <li class="nav-item">
        <span class="nav-link disabled" style="cursor: default; color: #ffffff; font-weight: 500;">
        <b>Welcome, {{ Auth::user()->name }}</b>
        </span>
      </li>
      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-link nav-link" type="submit">Logout</button>
        </form>
      </li>
      </ul>
    @endauth

      @guest
      <ul>
      <li>
        <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
      </li>
      </ul>
    @endguest
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <div class="container py-5">
    <div class="row g-5 align-items-start">
      <!-- Gambar Produk -->
      <div class="col-md-6 text-center">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image" />
      </div>

      <!-- Detail Produk -->
      <div class="col-md-6">
        <h2 class="fw-normal text-dark"><b>{{ strtoupper($product->name) }}</b></h2>
        <p class="fs-5 text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-dark">{{ $product->category->name }} Furniture</p>

        <!-- Selector jumlah -->
        <div class="d-flex align-items-center mb-3">
          <div class="quantity-selector d-flex align-items-center">
            <button class="btn btn-outline-secondary" type="button" id="btn-minus">−</button>
            <input type="text" class="form-control text-center mx-1" id="quantity-input" value="1" readonly
              style="width: 60px" />
            <button class="btn btn-outline-secondary" type="button" id="btn-plus">+</button>
          </div>
        </div>

        <!-- Tombol keranjang -->
        <div class="mb-4">
          @auth
          @if(Auth::user()->role === 'customer')
        <form action="{{ route('checkout') }}" method="GET" onsubmit="updateHiddenQuantity()">
            >
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" id="hidden-quantity" value="1">
        <button type="submit" class="btn btn-dark w-100">Buy Now</button>
        </form>
        @else
        <button class="btn btn-secondary w-100" disabled>Only customers can buy</button>
        @endif
      @else
        <button id="guestBuyNow" class="btn btn-dark w-100">Buy Now</button>
      @endauth
        </div>

        @guest
      <script>
        document.getElementById('guestBuyNow').addEventListener('click', function () {
        alert("Anda harus login sebagai customer untuk membeli produk.");
        window.location.href = "{{ route('login') }}";
        });
      </script>
    @endguest

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
                {{ $product->description }}
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
                Tersedia: {{ $product->stock }} unit
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
    // Guest Buy Now alert and redirect
    @guest
    document.getElementById('guestBuyNow').addEventListener('click', function () {
      alert("Anda tidak bisa melakukan pembelian karena anda belum melakukan login.");
      window.location.href = "{{ route('login') }}";
    });
  @endguest
  </script>

<script>
    const quantityInput = document.getElementById('quantity-input');
    const hiddenQuantity = document.getElementById('hidden-quantity');
    const stock = parseInt({{ $product->stock }});

    function updateHiddenQuantity() {
      hiddenQuantity.value = quantityInput.value;
    }

    document.getElementById('btn-plus').addEventListener('click', () => {
      let value = parseInt(quantityInput.value);
      if (value < stock) {
        quantityInput.value = value + 1;
        updateHiddenQuantity();
      } else {
        alert("Jumlah melebihi stok.");
      }
    });

    document.getElementById('btn-minus').addEventListener('click', () => {
      let value = parseInt(quantityInput.value);
      if (value > 1) {
        quantityInput.value = value - 1;
        updateHiddenQuantity();
      }
    });

    // Inisialisasi nilai hidden quantity saat pertama kali
    updateHiddenQuantity();
    </script>
</body>

</html>