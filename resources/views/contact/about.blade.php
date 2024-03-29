@extends('layouts.app')
@section('content')
    <style>
        /* Custom styles for the header */
        .navbar {
            background-color: #f05026; /* Shopee orange */
            color: #ffffff; /* White */
            padding: 20px 20px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Roboto', sans-serif; /* Apply Roboto font */
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
        .cart-icon svg {
            height: 30px; /* Adjust the height as needed */
            width: 30px; /* Adjust the width as needed */
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2, h3 {
            font-weight: 600;
        }
        p {
            margin-bottom: 20px;
        }.logout-button.shopee-theme {
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
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to Your Company Name. We are dedicated to providing the best products and services to our customers.</p>
        <h2>Our Mission</h2>
        <p>Our mission is to deliver high-quality products that meet the needs of our customers.</p>
        <h2>Our Team</h2>
        <p>We have a dedicated team of professionals who are committed to delivering excellence in everything we do.</p>
        <h2>Contact Us</h2>
        <p>If you have any questions or inquiries, please feel free to <a href="contact">contact us</a>.</p>
    </div>
@endsection
