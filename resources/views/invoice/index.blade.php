<!-- Invoice Page -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
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
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/customrequests') }}">Custom Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('report.index') }}">Report</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/invoice') }}">Invoice</a>
                        </li>
                    @endif
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

    <!-- Hero Section -->
    <div class="hero" style="background-color: #aa9a81;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Invoices</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Section -->
    <div class="container py-5">
        @if($orders->isEmpty())
            <div class="alert alert-info text-center">
                You don't have any payments yet.
            </div>
        @else
            <div class="row">
                @foreach($orders as $order)
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <strong>Invoice: {{ $order->payment->reference }}</strong>
                            </div>
                            <div class="card-body">
                                <p><strong>Status:</strong> {{ ucfirst($order->payment->status) }}</p>
                                <p><strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <hr>
                                <h6 class="fw-bold">Items:</h6>
                                <ul class="list-group list-group-flush mb-3">
                                    @foreach($order->items as $item)
                                        <li class="list-group-item d-flex justify-content-between">
                                            {{ $item->product->name }} x {{ $item->quantity }}
                                            <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('payment.page', $order->id) }}" class="btn btn-outline-dark w-100">
                                    View Payment
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>

</html>