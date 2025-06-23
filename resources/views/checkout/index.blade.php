<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
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
                <p class="text-muted">Complete your address and order details.</p>
            </div>
        </div>

        <div class="row">
            {{-- FORM ALAMAT --}}
            <div class="col-md-7">
                <div class="p-4 bg-white rounded shadow-sm">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        {{-- Hidden input data dari product --}}
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">

                        {{-- Quantity --}}
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                value="{{ $quantity }}" min="1" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="First name" required>
                            </div>
                            <div class="col">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Last name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="street_address" class="form-label">Street Address</label>
                            <input type="text" class="form-control" id="street_address" name="street_address"
                                placeholder="Street and number" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                    required>
                            </div>
                            <div class="col">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    placeholder="12345" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="08123456789"
                                required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Continue to Payment</button>
                    </form>
                </div>
            </div>

            {{-- ORDER SUMMARY --}}
            <div class="col-md-5 mt-4 mt-md-0">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h4 class="fw-bold text-dark">Order Summary</h4>
                    <hr>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-1 fw-semibold">{{ $product->name }}</p>
                                <small
                                    class="text-muted d-block">{{ $product->description ?? 'No description available.' }}</small>
                            </div>
                            <div class="text-end">
                                <p class="mb-1">{{ $quantity }} ×</p>
                                <p class="fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="fw-bold text-dark">Total</h5>
                        <h5 class="fw-bold text-dark">Rp{{ number_format($product->price, 0, ',', '.') }}</h5>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <script>
        const quantityInput = document.getElementById('quantity');
        const price = {{ $product->price }};
        const subtotalText = document.querySelectorAll('span.fw-semibold')[0];
        const totalText = document.querySelectorAll('h5.fw-bold.text-dark')[1];

        function updateSummary() {
            const qty = parseInt(quantityInput.value) || 1;
            const total = price * qty;
            subtotalText.innerText = 'Rp' + total.toLocaleString('id-ID');
            totalText.innerText = 'Rp' + total.toLocaleString('id-ID');
            document.querySelector('.text-end p.mb-1').innerText = qty + ' ×';
        }

        quantityInput.addEventListener('input', updateSummary);
    </script>

</body>

</html>