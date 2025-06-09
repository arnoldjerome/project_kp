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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-wNfYc2rO2mfIyt9f9Q4tZ0O0ax9OdrN+jC8A1y6v9Ek5CRmRUJzjXigIQdcZkXzHZQzLxxBvlh9PvWRZ6HFvYw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="/assets/css/tiny-slider.css" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet">
	<title>BCS - BALI CIPTA SARANA</title>
</head>

<body>

	<!-- Start Header/Navigation -->
	<!--<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar"> -->
	<nav class="custom-navbar navbar navbar-expand-md navbar-dark" aria-label="Furni navigation bar">


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
            <a class="nav-link" href="{{ url('/productint') }}">Indoor</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/productext') }}">Outdoor</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/chat') }}">Chat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/invoice') }}">Invoice</a>
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

	<!-- Start Hero Section -->
	<div class="hero" style="background-color: #aa9a81;">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>BALI CIPTA <span clsas="d-block"> SARANA </span></h1>
						<p class="mb-4">Bringing timeless comfort and style to both indoor and outdoor living.</p>
						<p><a href="#indoor" class="btn btn-secondary me-2">Our Catalog</a><a href="#footer"
								class="btn btn-white-outline">Contact Us</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="/assets/images/1.png" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->


	<!-- INDOOR -->
	<!-- Start Product Section -->
	<div class="product-section">
		<div class="container">
			<div class="row">

				<!-- Start Column 1 -->
				<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
					<h2 id="indoor" class="mb-4 section-title"><b>Indoor Exclusive</b></h2>
					<p class="mb-4">Crafted from premium teak wood, this indoor product combines natural beauty with exceptional durability. Designed for indoor use, it showcases the timeless appeal of solid teak—renowned for its strength, sturdiness, and resistance to wear. With a finely finished surface and a robust build, it offers both style and long-lasting performance, making it a perfect addition to any interior space. </p>
					<p><a href="{{ url('/productint') }}" class="btn">See More</a></p>
				</div>
				<!-- End Column 1 -->

				<!-- Start Column 2 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="/assets/images/in/22.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Nordic Chair</h3>
						<strong class="product-price">$50.00</strong>

						<span class="icon-cross">
							<img src="/assets/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 2 -->

				<!-- Start Column 3 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="/assets/images/in/10.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Kruzo Aero Chair</h3>
						<strong class="product-price">$78.00</strong>

						<span class="icon-cross">
							<img src="/assets/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 3 -->

				<!-- Start Column 4 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="/assets/images/in/11.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Ergonomic Chair</h3>
						<strong class="product-price">$43.00</strong>

						<span class="icon-cross">
							<img src="/assets/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 4 -->

			</div>
            <div class="row mt-5">
                <div class="col-12 col-md-6 col-lg-3">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/in/17.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Elegant Sofa</h3>
                        <strong class="product-price">$85.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/in/6.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Vintage Armchair</h3>
                        <strong class="product-price">$70.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/in/18.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Wooden Stool</h3>
                        <strong class="product-price">$35.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/in/19.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Office Chair</h3>
                        <strong class="product-price">$60.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
		</div>
	</div>
	<!-- End Product Section -->


	<!-- OUTDOOR -->
    <!-- Start Product Section -->
	<div class="product-section">
		<div class="container">
			<div class="row">

				<!-- Start Column 1 -->
				<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
					<h2 class="mb-4 section-title"><b>Bold Outdoor</b></h2>
					<p class="mb-4">Expertly crafted from solid teak wood, this outdoor piece is made to withstand the elements. Designed for open-air environments, it boasts exceptional strength, weather resistance, and timeless charm. The natural durability of teak ensures that it remains sturdy and beautiful, even through sun, rain, and time—making it a reliable and stylish companion for any outdoor space.</p>
					<p><a href="{{ url('/productext') }}" class="btn">See More</a></p>
				</div>
				<!-- End Column 1 -->

				<!-- Start Column 2 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="/assets/images/out/7.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Nordic Chair</h3>
						<strong class="product-price">$50.00</strong>

						<span class="icon-cross">
							<img src="/assets/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 2 -->

				<!-- Start Column 3 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="/assets/images/out/12.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Kruzo Aero Chair</h3>
						<strong class="product-price">$78.00</strong>

						<span class="icon-cross">
							<img src="/assets/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 3 -->

				<!-- Start Column 4 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" href="cart.html">
						<img src="/assets/images/out/13.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Ergonomic Chair</h3>
						<strong class="product-price">$43.00</strong>

						<span class="icon-cross">
							<img src="/assets/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- End Column 4 -->

			</div>
            <div class="row mt-5">
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/out/21.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Elegant Sofa</h3>
                        <strong class="product-price">$85.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/out/23.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Vintage Armchair</h3>
                        <strong class="product-price">$70.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/out/29.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Wooden Stool</h3>
                        <strong class="product-price">$35.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <a class="product-item" href="cart.html">
                        <img src="/assets/images/out/30.png" class="img-fluid product-thumbnail">
                        <h3 class="product-title">Office Chair</h3>
                        <strong class="product-price">$60.00</strong>
                        <span class="icon-cross">
                            <img src="/assets/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
		</div>
	</div>
	<!-- End Product Section -->



	<!-- Start We Help Section -->
	<div class="we-help-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-7 mb-5 mb-lg-0">
					<div class="imgs-grid">
						<div class="grid grid-1"><img src="/assets/images/img-grid-1.jpg" alt="Untree.co"></div>
						<div class="grid grid-2"><img src="/assets/images/img-grid-2.jpg" alt="Untree.co"></div>
						<div class="grid grid-3"><img src="/assets/images/img-grid-3.jpg" alt="Untree.co"></div>
					</div>
				</div>
				<div class="col-lg-5 ps-lg-5">
					<h2 class="section-title mb-4" style="color: black;"><b>From Vision to Wooden Perfection</b></h2>
					<p style="color: white;">We offer custom furniture and wood products tailored to your unique ideas and needs. Simply click the chat button to connect with our customer service team and share your concept. If you already have a sketch, feel free to send it over. Don’t have one yet? No worries—our team can help create a sketch for you.</p>
                    <br>
                    <p style="color: white;"><b>Tap the chat button now and let’s start bringing your dream wood creation to life!</b></p>
					<p><a herf="#" class="btn">Chat Now</a></p>
				</div>
			</div>
		</div>
	</div>
	<!-- End We Help Section -->



	<!-- Start Footer Section -->
	<footer class="footer-section">
		<div class="container relative">

			<div class="sofa-img">
				<img src="/assets/images/sofa.png" alt="Image" class="img-fluid">
			</div>



			<div id="footer" class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Bali Cipta Sarana<span>.</span></a></div>
					<p class="mb-4">Bringing timeless comfort and style to both indoor and outdoor living.</p>

					<ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                    </ul>
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


	<script src="/assets/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/tiny-slider.js"></script>
	<script src="/assets/js/custom.js"></script>
</body>

</html>