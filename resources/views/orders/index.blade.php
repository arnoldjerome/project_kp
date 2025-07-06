<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="/assets/css/tiny-slider.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
    <style>
        #chatMessages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f7f7f7;
        }

        .chat-bubble {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            display: inline-block;
            word-wrap: break-word;
        }

        .chat-left {
            background-color: #e4e6eb;
            color: #000;
            text-align: left;
            align-self: flex-start;
            border-bottom-left-radius: 0;
            margin-right: auto;
        }

        .chat-right {
            background-color: #0d6efd;
            color: #fff;
            text-align: right;
            align-self: flex-end;
            border-bottom-right-radius: 0;
            margin-left: auto;
        }
    </style>

</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsFurni">
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
                                <a class="nav-link" href="{{ url('/report') }}">Report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/orders') }}">Orders</a>
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
                @endguest
            </div>
        </div>
    </nav>

    <div class="hero" style="background-color: #aa9a81;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Pending Orders</h1>
                        <p class="mb-4">Manage and confirm pending orders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Order #{{ $order->id }}</h5>
                                <p class="card-text"><strong>User:</strong> {{ $order->user->name ?? 'Unknown' }}</p>
                                <p class="card-text"><strong>Total:</strong>
                                    Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <p class="card-text"><strong>Status:</strong>
                                    <span id="status-badge-{{ $order->id }}" class="badge bg-secondary">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                                <p class="card-text"><strong>Items:</strong></p>
                                <ul class="mb-2">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->product->name ?? 'Produk dihapus' }} × {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                                <div class="mt-auto">
                                    <button class="btn btn-success w-100 pay-btn" data-id="{{ $order->id }}"
                                        data-url="{{ route('orders.pay', $order->id) }}">
                                        Mark as Paid
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.pay-btn').click(function () {
                var button = $(this);
                var orderId = button.data('id');
                var url = button.data('url');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        button.text('Paid')
                            .removeClass('btn-success')
                            .addClass('btn-outline-secondary')
                            .prop('disabled', true);
                        $('#status-badge-' + orderId)
                            .removeClass('bg-secondary')
                            .addClass('bg-success')
                            .text('Paid');
                    },
                    error: function () {
                        alert('Gagal memperbarui status. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>

</body>

</html>