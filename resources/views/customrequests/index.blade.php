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

    <!-- Bootstrap /assets/CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="assets/css/tiny-slider.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <title>BCS - BALI CIPTA SARANA </title>
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
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/customrequests') }}">Custom Request</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/report') }}">Report</a>
                                </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/invoice') }}">Invoice</a>
                            </li>
                        @endif
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

    <!-- Start Hero Section -->
    <div class="hero" style="background-color: #aa9a81;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Custom Requests</h1>
                        <p class="mb-4">View and manage all customer custom furniture requests.</p>
                    </div>
                </div>
                <!-- <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="/assets/images/couch.png" class="img-fluid">
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Custom Request List -->
    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                @foreach ($requests as $request)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow">
                            <img src="{{ asset($request->file_url) }}" class="card-img-top" alt="Sketsa"
                                style="height: 250px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Request by User #{{ $request->user_id }}</h5>
                                <p class="card-text">{{ $request->request_detail }}</p>
                                <p class="card-text"><strong>Harga:</strong>
                                    Rp{{ number_format($request->price, 0, ',', '.') }}</p>
                                <div class="mt-auto">
                                    <div class="mb-2">
                                        <span id="status-badge-{{ $request->id }}"
                                            class="badge bg-{{ $request->status === 'approved' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </div>

                                    @if ($request->status === 'pending')
                                        <button class="btn btn-success w-100 approve-btn" data-id="{{ $request->id }}"
                                            data-url="{{ route('customrequests.approve', $request->id) }}">
                                            Approve
                                        </button>
                                    @else
                                        <button class="btn btn-outline-secondary w-100" disabled>Approved</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Custom Request List -->

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/tiny-slider.js"></script>
    <script src="/assets/js/custom.js"></script>


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
                                hreff="https://themewagon.com">ThemeWagon</a>
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


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.approve-btn').click(function () {
                var button = $(this);
                var requestId = button.data('id');
                var url = button.data('url');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: 'approved'
                    },
                    success: function (response) {
                        // Ubah teks tombol, nonaktifkan, ubah status
                        button.text('Approved').removeClass('btn-success').addClass('btn-outline-secondary').prop('disabled', true);
                        $('#status-badge-' + requestId).removeClass('bg-secondary').addClass('bg-success').text('Approved');
                    },
                    error: function (xhr) {
                        alert('Gagal mengubah status. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
</body>

</html>