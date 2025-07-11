<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3//assets/css/all.min.css"
        rel="stylesheet">
    <link href="/assets/css/tiny-slider.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <title>BCS - BALI CIPTA SARANA</title>
    <style>
        .chart-container {
            max-width: 500px;
            margin: 0 auto;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>

</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/bcs.png" alt="Logo" style="height: 80px;">
            </a>

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
                                <a class="nav-link" href="{{ route('report.index') }}">Report</a>
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
    <!-- End Header/Navigation -->


    <div class="container py-5">
        <h1 class="mb-5 text-center">Laporan Ringkasan Penjualan</h1>
        <a href="{{ route('report.download') }}" class="btn btn-danger mb-3">
            <i class="fa fa-print"></i> Cetak PDF
        </a>

        {{-- Statistik Ringkas --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text fs-3">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text fs-3">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Order Berdasarkan Status --}}
        <div class="mb-5">
            <h4 class="mb-3">Visualisasi Orders Berdasarkan Status</h4>
            <div class="chart-container">
                <canvas id="orderChart"></canvas>
            </div>
        </div>

        {{-- Orders Berdasarkan Status dalam List --}}
        <div class="mb-5">
            <h4>Ringkasan Orders by Status</h4>
            <ul class="list-group">
                @foreach ($ordersByStatus as $order)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ ucfirst($order->status) }}
                        <span class="badge bg-primary rounded-pill">{{ $order->count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Tabel Top Customer --}}
        <div class="mb-5">
            <h4>Top Customers</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topCustomers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->orders_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Custom Requests --}}
        <div class="mb-5">
            <h4>5 Custom Requests Terakhir</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-secondary">
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customRequests as $req)
                            <tr>
                                <td>{{ $req->request_detail }}</td>
                                <td>{{ $req->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">

            <div class="sofa-img">
                <img src="/assets/images/sofa.png" alt="Image" class="img-fluid">
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center"><span class="me-1"><img
                                    src="/assets/images/envelope-outline.svg" alt="Image"
                                    class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
                    <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus
                        malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
                        Pellentesque habitant</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Knowledge base</a></li>
                                <li><a href="#">Live chat</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Jobs</a></li>
                                <li><a href="#">Our team</a></li>
                                <li><a href="#">Leadership</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Nordic Chair</a></li>
                                <li><a href="#">Kruzo Aero</a></li>
                                <li><a href="#">Ergonomic Chair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash;
                            Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a
                                href="https://themewagon.com">ThemeWagon</a>
                            <!-- License information: https://untree.co/license/ -->
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </footer>
    <!-- End Footer Section -->


    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/tiny-slider.js"></script>
    <script src="/assets/js/custom.js"></script>

    <!-- Harus di atas sebelum dipakai -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = {!! json_encode($ordersByStatus->pluck('status')) !!};
        const dataCounts = {!! json_encode($ordersByStatus->pluck('count')) !!};

        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Order',
                    data: dataCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: 'white',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>

</html>