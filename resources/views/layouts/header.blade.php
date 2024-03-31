<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f05026; /* Shopee orange */
            color: #ffffff; /* White */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
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
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-right: 10px;
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

        .nav-link i {
            margin-right: 5px;
        }

        .cart-icon {
            margin-left: 1rem;
            cursor: pointer;
        }

        .cart-icon svg {
            height: 30px;
            width: 30px;
        }

    </style>
</head>
</head>
<header class="navbar">
    <a href="{{ Auth::check() ? (Auth::user()->usertype === 'admin' ? route('admin.home') : (Auth::user()->usertype === 'user' ? route('home') : route('welcome'))) : route('welcome') }}" class="navbar-brand">
        <img src="{{ asset('storage/images/LogoE.png') }}" alt="ElectroKits Logo">ElektroKits
    </a>
    <div class="nav-links">
                <a href="{{ route('customer') }}" class="nav-link">Customers</a>
                <a href="{{ route('product') }}" class="nav-link">Products</a>
                <a href="{{ route('order.index') }}" class="nav-link">Orders</a>
                <a href="{{ route('analytics') }}" class="nav-link">Analytics</a>
                <a href="{{ route('product') }}" class="nav-link">Feedbacks</a>
                <a href="{{ route('inventory') }}" class="nav-link">Inventory</a>
            <div class="dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        {{ __('View Profile') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
    </div>
</header>
</body>
</html>
