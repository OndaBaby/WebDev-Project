{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroKits</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <style>
        .navbar {
            background-color: #f05026;
            color: #ffffff;
            padding: 20px 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Roboto', sans-serif;
            margin-bottom: 20px;
        }
        .navbar-brand {
            color: #ffffff; /* White */
            font-weight: bold;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 40px; /* Adjust the height as needed */
            width: 40px; /* Adjust the width as needed */
            border-radius: 50%;
            margin-right: 10px;
        }
        .navbar-brand:hover {
            color: #ffffff; /* White */
        }
        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-link {
            color: #ffffff; /* White */
            margin: 0 1rem;
            font-weight: bold;
            text-decoration: none;
        }
        .nav-link:hover {
            color: #ffffff; /* White */
            text-decoration: underline;
        }
        .cart-icon {
            margin-left: 1rem;
            cursor: pointer;
        }

        .shopee-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .shopee-card .card-body {
            padding: 20px;
            margin-bottom: 20px; /* Added margin to the bottom */
        }

        .shopee-card .carousel-inner {
            border-radius: 10px;
        }

        .shopee-card .product-image {
            border-radius: 10px;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover;
            width: 100%;
        }

        .btn-orange {
            background-color: #f05026; /* Shopee orange */
            color: #ffffff; /* White */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .btn-orange:hover {
            background-color: #e0401b; /* Darker shade of Shopee orange */
        }
        .roboto-font {
            font-family: 'Roboto', sans-serif;
        }
        .add-to-cart-btn {
            background-color: #f05026; /* Set your desired color */
            color: #ffffff; /* Set text color */
            border: none; /* Remove border */
            border-radius: 5px; /* Add border radius for button */
            padding: 10px 20px; /* Add padding for button */
            font-size: 16px; /* Set font size */
            transition: background-color 0.3s ease; /* Add transition effect for hover */
        }

        .add-to-cart-btn:hover {
            background-color: #e0401b; /* Change background color on hover */
        }
        .logout-button.shopee-theme {
            background-color: #ee4d2d; /* Adjust the color to match your Shopee theme */
            color: #fff; /* Text color */
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button.shopee-theme:hover {
            background-color: #c6360b; /* Darker color on hover */
        }
    </style>
</head>
<body class="antialiased">
    <header class="navbar">
        <a href="{{ route('welcome') }}"  class="navbar-brand" id="logo">
            <img src="{{ asset('storage/images/LogoE.png') }}" alt="ElectroKits Logo">
            ElectroKits
        </a>
        <div class="nav-links">
            <a href="{{ route('about') }}" class="nav-link"><i class="fas fa-question"></i>About Us</a>
            <a href="{{ route('contact') }}" class="nav-link"><i class="fas fa-phone"></i>Contact Us</a>
            @guest
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            @else
                <div class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
            <a href="{{ auth()->check() ? route('cart') : route('login') }}" class="cart-icon" style="font-size: 24px;">
                <i class="fas fa-shopping-cart" style="color: white;"></i>
            </a>
        </div>
    </header>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white" style="font-family: 'sans-serif';">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="container">
                            <div class="row">
                                @foreach ($products as $product)
                                <div class="col-md-3 mb-4"> <!-- Use col-md-3 to make each container occupy 3 columns on medium-sized screens -->
                                    <div class="card shopee-card">
                                        <div class="card-body">
                                            <div id="carousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                        <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <h5 class="card-title" style="font-family: 'Roboto', sans-serif;">{{ $product->name }}</h5>
                                            <p class="card-text" style="font-family: 'Roboto', sans-serif;">Type: {{ $product->type }}</p>
                                            <p class="card-text" style="font-family: 'Roboto', sans-serif;">Description: {{ $product->description }}</p>
                                            <p class="card-text" style="font-family: 'Roboto', sans-serif;">Cost: ₱{{ $product->cost }}</p>
                                            <a href="{{ route('showFeedback') }}" class="btn btn-primary mt-3 review-button" style="font-size: 14px;">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{ route('cart.add', ['product_id' => $product->id]) }}" class="btn btn-orange mt-3 add-to-cart-btn" style="font-family: 'Roboto', sans-serif;">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroKits</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <!-- Styles -->
    <style>
        /* Custom styles for the header */
        .navbar {
            background-color: #f05026; /* Shopee orange */
            color: #ffffff; /* White */
            padding: 20px 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Roboto', sans-serif; /* Apply Roboto font */
            margin-bottom: 20px; /* Added margin to the bottom */
        }
        .navbar-brand {
            color: #ffffff; /* White */
            font-weight: bold;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 40px; /* Adjust the height as needed */
            width: 40px; /* Adjust the width as needed */
            border-radius: 50%;
            margin-right: 10px;
        }
        .navbar-brand:hover {
            color: #ffffff; /* White */
        }
        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-link {
            color: #ffffff; /* White */
            margin: 0 1rem;
            font-weight: bold;
            text-decoration: none;
        }
        .nav-link:hover {
            color: #ffffff; /* White */
            text-decoration: underline;
        }
        .cart-icon {
            margin-left: 1rem;
            cursor: pointer;
        }

        .shopee-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .shopee-card .card-body {
            padding: 20px;
            margin-bottom: 20px; /* Added margin to the bottom */
        }

        .shopee-card .carousel-inner {
            border-radius: 10px;
        }

        .shopee-card .product-image {
            border-radius: 10px;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover;
            width: 100%;
        }

        .btn-orange {
            background-color: #f05026; /* Shopee orange */
            color: #ffffff; /* White */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .btn-orange:hover {
            background-color: #e0401b; /* Darker shade of Shopee orange */
        }
        .roboto-font {
            font-family: 'Roboto', sans-serif;
        }
        .add-to-cart-btn {
            background-color: #f05026; /* Set your desired color */
            color: #ffffff; /* Set text color */
            border: none; /* Remove border */
            border-radius: 5px; /* Add border radius for button */
            padding: 10px 20px; /* Add padding for button */
            font-size: 16px; /* Set font size */
            transition: background-color 0.3s ease; /* Add transition effect for hover */
        }

        .add-to-cart-btn:hover {
            background-color: #e0401b; /* Change background color on hover */
        }
        .logout-button.shopee-theme {
            background-color: #ee4d2d; /* Adjust the color to match your Shopee theme */
            color: #fff; /* Text color */
            padding: 8px 16px; /* Adjust padding as needed */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button.shopee-theme:hover {
            background-color: #c6360b; /* Darker color on hover */
        }
    </style>
</head>
<body class="antialiased">
    <header class="navbar">
        <a href="{{ route('welcome') }}"  class="navbar-brand" id="logo">
            <img src="{{ asset('storage/images/LogoE.png') }}" alt="ElectroKits Logo">
            ElectroKits
        </a>
        <div class="nav-links">
            <form action="{{ route('customer.search') }}" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Search..." class="search-input">
                <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
            </form>
            <a href="{{ route('about') }}" class="nav-link"><i class="fas fa-question"></i>About Us</a>
            <a href="{{ route('contact') }}" class="nav-link"><i class="fas fa-phone"></i>Contact Us</a>
            <a href="{{ route('faqwel') }}" class="nav-link"><i class="fas fa-question"></i>FAQ</a>
            @guest
                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            @else
                <span class="user-name">{{ Auth::user()->name }}</span> <!-- Display user's name -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button shopee-theme">Logout</button>
                </form>
                <div class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
            <a href="{{ auth()->check() ? route('cart') : route('login') }}" class="cart-icon" style="font-size: 24px;">
                <i class="fas fa-shopping-cart" style="color: white;"></i> <!-- Change the color to black -->
            </a>
        </div>
    </header>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white" style="font-family: 'sans-serif';">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="container">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row">
                                @if(isset($searchResults) && $searchResults->isNotEmpty())
                                    @foreach ($searchResults as $product)
                                        <div class="col-md-3 mb-4">
                                            <div class="card shopee-card">
                                                <div class="card-body">
                                                    <div id="carousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                    <h5 class="card-title" style="font-family: 'Roboto', sans-serif;">{{ $product->name }}</h5>
                                                    <p class="card-text" style="font-family: 'Roboto', sans-serif;">Type: {{ $product->type }}</p>
                                                    <p class="card-text" style="font-family: 'Roboto', sans-serif;">Description: {{ $product->description }}</p>
                                                    <p class="card-text" style="font-family: 'Roboto', sans-serif;">Cost: ₱{{ $product->cost }}</p>
                                                    <a href="{{ route('showFeedback', ['id' => $product->id]) }}" class="btn btn-primary mt-3 review-button" style="font-size: 14px;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    <a href="{{ route('cart.add', ['product_id' => $product->id]) }}" class="btn btn-orange mt-3 add-to-cart-btn" style="font-family: 'Roboto', sans-serif;">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    @foreach ($products as $product)
                                    <div class="col-md-3 mb-4">
                                        <div class="card shopee-card">
                                            <div class="card-body">
                                                <div id="carousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach (explode(',', $product->img_path) as $key => $imgPath)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset($imgPath) }}" alt="Product Image {{ $key + 1 }}" class="d-block w-100 product-image">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                <h5 class="card-title" style="font-family: 'Roboto', sans-serif;">{{ $product->name }}</h5>
                                                <p class="card-text" style="font-family: 'Roboto', sans-serif;">Type: {{ $product->type }}</p>
                                                <p class="card-text" style="font-family: 'Roboto', sans-serif;">Description: {{ $product->description }}</p>
                                                <p class="card-text" style="font-family: 'Roboto', sans-serif;">Cost: ₱{{ $product->cost }}</p>
                                                <a href="{{ route('showFeedback', ['id' => $product->id]) }}" class="btn btn-primary mt-3 review-button" style="font-size: 14px;">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <a href="{{ route('cart.add', ['product_id' => $product->id]) }}" class="btn btn-orange mt-3 add-to-cart-btn" style="font-family: 'Roboto', sans-serif;">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
