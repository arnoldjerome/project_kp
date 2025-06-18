<!-- Revised Payment Page with Dynamic Order Display and QR Code Integration -->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout - Payment</title>
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="/assets/images/bcs.png" alt="Logo" style="height: 80px;">
      </a>
    </div>
  </nav>

  <div class="container py-5">
    <h2 class="mb-4">Pembayaran</h2>

    <div class="card mb-4">
      <div class="card-header">
        <strong>Detail Pesanan</strong>
      </div>
      <div class="card-body">
        <p><strong>Invoice:</strong> {{ $order->payment->reference }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->payment->status) }}</p>
        <p><strong>Metode Pembayaran:</strong> BCA QRIS</p>
        <p><strong>Total Bayar:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

        <table class="table mt-4">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->items as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td>{{ $item->quantity }}</td>
              <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="text-center mb-4">
      <h5>Scan QRIS BCA untuk Membayar</h5>
      <img src="{{ asset('assets/images/qris-dummy.png') }}" alt="QRIS" style="width: 250px;">
      <p class="mt-2 text-muted">Gunakan aplikasi e-wallet / m-banking untuk menyelesaikan pembayaran</p>
    </div>

    @if($order->payment->status === 'pending')
    <form action="{{ route('payment.confirm', $order->payment->id) }}" method="POST">
      @csrf
      @method('PUT')
      <button type="submit" class="btn btn-success w-100">Saya Sudah Bayar</button>
    </form>
    @else
    <div class="alert alert-success text-center">
      Pembayaran sudah dikonfirmasi. Terima kasih!
    </div>
    @endif
  </div>

  <footer class="bg-light py-4 mt-5">
    <div class="container text-center">
      <p class="mb-0">&copy; {{ date('Y') }} Furni. All rights reserved.</p>
    </div>
  </footer>

  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
