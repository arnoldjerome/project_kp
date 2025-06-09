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
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3//assets/css/all.min.css" rel="stylesheet">
		<link href="/assets/css/tiny-slider.css" rel="stylesheet">
		<link href="/assets/css/style.css" rel="stylesheet">
		<title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
            <div class="container">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li >
                        <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
            </div>
            </div>
          </nav>
		<!-- End Header/Navigation -->

		<!-- Chat Section -->
<div class="container py-5" style="height: 80vh;">
    <div class="row justify-content-center h-100">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow rounded-4 h-100 d-flex flex-column">
          <div class="card-header bg-secondary text-white rounded-top-4">
            <h5 class="mb-0">Live Chat</h5>
          </div>
          <div class="card-body overflow-auto px-4 py-3" id="chat-box" style="flex-grow: 1;">
            <!-- Chat bubbles -->
            <div class="d-flex justify-content-start mb-3">
              <div class="p-3 bg-light rounded-3">Hi, how can I help you?</div>
            </div>
            <div class="d-flex justify-content-end mb-3">
              <div class="p-3 bg-primary text-white rounded-3">I want to know more about your services.</div>
            </div>
          </div>
          <div class="card-footer bg-white">
            <div class="input-group">
              <input type="text" id="message-input" class="form-control" placeholder="Type a message...">
              <button class="btn btn-primary" id="send-btn">Send</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Chat Section -->


		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="/assets/images/sofa.png" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="/assets/images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

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
						<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

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
									<li><a href="#">Chat</a></li>
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
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a hreff="https://themewagon.com">ThemeWagon</a>  <!-- License information: https://untree.co/license/ -->
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


		<script src="/assets/js/bootstrap.bundle.min./assets/js"></script>
		<script src="/assets/js/tiny-slider./assets/js"></script>
		<script src="/assets/js/custom.js"></script>
	</body>

</html>
