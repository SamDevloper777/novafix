<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('Assets/faviconn.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <script src="{{ asset('js/lottie.js') }}"></script>
    <style>
        .navbar {
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #333;
        }

        .nav-link {
            font-weight: 600;
            color: #495057;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #e87605;
            text-decoration: underline;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 40px 0;
            color: #495057;
        }

        .footer a {
            color: #495057;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #e87605;
        }

        .social-media-icons i {
            font-size: 18px;
            color: #495057;
            margin-right: 10px;
            transition: color 0.3s ease;
        }

        .social-media-icons i:hover {
            color: #e87605;
        }

        .footer-text {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="main_background fixed-top py-2">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <h1>NovaFix</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto gap-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.contact') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.learn') }}">Learn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('track.status') }}">Track-Status</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container mt-5">
    <h2 class="text-center mb-4">Order Tracking</h2>
    @if($order)
        <div class="card p-4">
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <p><strong>Name:</strong> {{ $order->owner_name ?? 'N/A' }}</p>
                    <p><strong>Product:</strong> {{ $order->product_name ?? 'N/A' }}</p>
                    <p><strong>Contact:</strong> {{ $order->contact ?? 'N/A' }}</p>
                    <p><strong>Brand:</strong> {{ $order->brand ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <p><strong>Type:</strong> {{ $order->type->name ?? 'N/A' }}</p>
                    <p><strong>Service Code:</strong> {{ $order->service_code }}</p>
                    <p><strong>Status:</strong> {{ $order->getStatus() }}</p>
                    <p><strong>Estimated Delivery Date:</strong>
                        @if($order->estimate_delivery && strtotime($order->estimate_delivery) > 0)
                            <?php 
                                $estimatedDate = strtotime($order->estimate_delivery);
                                $modifiedDate = strtotime('+5 days', $estimatedDate); // Adding 5 days
                            ?>
                            {{ date('d M Y', $modifiedDate) }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @else
        <p class="text-danger">Order not found.</p>
    @endif
</div>

    <div class="footer mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <h2>NovaFix</h2>
                    <ul class="navbar-nav">
                        <li class="nav-item py-1"><a href="{{ route('home.warranty') }}" class="nav-link">Warranty
                                Policy</a></li>
                        <li class="nav-item py-1"><a href="{{ route('home.termsAndCondition') }}" class="nav-link">Terms
                                & Conditions</a></li>
                        <li class="nav-item py-1"><a href="{{ route('home.privacyPolicy') }}" class="nav-link">Privacy
                                Policy</a></li>
                        <li class="nav-item py-1"><a href="{{ route('home.ourTeam') }}" class="nav-link">Our Team</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <p><strong>Contact Us:</strong></p>
                    <p><b>+91 7856802002</b></p>
                    <div class="social-media-icons">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-text">
                <p>Copyright ©<span id="aftab"></span> All rights reserved.</p>
            </div>
        </div>
    </div>
    @show

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
</body>

</html>