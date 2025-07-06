<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
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
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Header -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('assets/images/bcs.png') }}" alt="Logo" style="height: 80px;" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni">
        <span class="navbar-toggler-icon"></span>
      </button>
      @auth
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/productint') }}">Indoor</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/productext') }}">Outdoor</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/chat') }}">Chat</a></li>
        <li class="nav-item">
          @if(Auth::user()->role === 'admin')
            <a class="nav-link" href="{{ url('/customrequests') }}">Custom Request</a>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/report') }}">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/orders') }}">Orders</a>
            </li>
          @else
            <a class="nav-link" href="{{ url('/invoice') }}">Invoice</a>
          @endif
        </li>
        <li class="nav-item">
          <span class="nav-link disabled"><b>Welcome, {{ Auth::user()->name }}</b></span>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">@csrf
            <button class="btn btn-link nav-link" type="submit">Logout</button>
          </form>
        </li>
      </ul>
      @endauth
      @guest
        <ul><li><a class="btn btn-outline-light" href="{{ route('login') }}">Login</a></li></ul>
      @endguest
    </div>
  </nav>

  <!-- Content -->
  <div class="container py-5">
    <div class="row g-5 align-items-start">
      <div class="col-md-6 text-center">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image" />
      </div>
      <div class="col-md-6">
        <h2 class="fw-normal text-dark"><b>{{ strtoupper($product->name) }}</b></h2>
        <p class="fs-5 text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-dark">{{ $product->category->name }} Furniture</p>
        <p class="text-dark"><strong>Stok:</strong> {{ $product->stock }} unit</p>

        @auth
          @if(Auth::user()->role === 'customer')
          <div class="d-flex align-items-center mb-3">
            <div class="quantity-selector d-flex align-items-center">
              <button class="btn btn-outline-secondary" type="button" id="btn-minus">−</button>
              <input type="text" class="form-control text-center mx-1" id="quantity-input" value="1" readonly style="width: 60px" />
              <button class="btn btn-outline-secondary" type="button" id="btn-plus">+</button>
            </div>
          </div>
          @endif
        @endauth

        <div class="mb-4">
          @auth
            @if(Auth::user()->role === 'customer')
              <form action="{{ route('checkout') }}" method="GET" onsubmit="updateHiddenQuantity()">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                <button type="submit" class="btn btn-dark w-100">Buy Now</button>
              </form>
            @elseif(Auth::user()->role === 'admin')
              <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit Product</button>
            @endif
          @else
            <button id="guestBuyNow" class="btn btn-dark w-100">Buy Now</button>
          @endauth
        </div>

        <!-- Accordion -->
        <div class="accordion" id="productDetailsAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseDesc">Description</button></h2>
            <div id="collapseDesc" class="accordion-collapse collapse"><div class="accordion-body">{{ $product->description }}</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Product Name</label>
              <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Price</label>
              <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Stock</label>
              <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Category</label>
              <select name="category_id" class="form-control" required>
                <option value="1" {{ $product->category_id == 1 ? 'selected' : '' }}>Indoor</option>
                <option value="2" {{ $product->category_id == 2 ? 'selected' : '' }}>Outdoor</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @guest
  <script>
    document.getElementById('guestBuyNow').addEventListener('click', function () {
      alert("Anda harus login sebagai customer untuk membeli produk.");
      window.location.href = "{{ route('login') }}";
    });
  </script>
  @endguest

  <script>
    const quantityInput = document.getElementById('quantity-input');
    const hiddenQuantity = document.getElementById('hidden-quantity');
    const stock = parseInt({{ $product->stock }});

    function updateHiddenQuantity() {
      hiddenQuantity.value = quantityInput.value;
    }

    if (quantityInput) {
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

      updateHiddenQuantity();
    }
  </script>
</body>
</html>
