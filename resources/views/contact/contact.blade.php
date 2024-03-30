@extends('layouts.app')
@section('content')
    <style>
        /* Custom styles for the header */
        .navbar {
            background-color: #f05026;
            color: #ffffff; /* White */
            padding: 20px 20px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Roboto', sans-serif; /* Apply Roboto font */
        }
        
        .navbar-brand {
            color: #ffffff;
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
        }
        .social-icon svg {
            width: 70px; /* Adjust the width as needed */
            height: 70px; /* Adjust the height as needed */
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

        /* Background Video */
        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        /* Email Icon */
        .email-icon {
            height: 20px; /* Adjust the height as needed */
            width: 20px; /* Adjust the width as needed */
            margin-right: 5px; /* Adjust the margin as needed */
            fill: #333; /* Adjust the fill color as needed */
        }
    </style>

    <!-- Background Video -->
    <video autoplay loop muted class="background-video">
        <source src="{{ asset('videos/contact.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <h2>Landline</h2>
        <p>(123) 456-7890</p>
        <h3>Email</h3>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" class="email-icon" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg>
            @donnanthony.baldoza@tup.edu.ph
        </p>
        <p><svg xmlns="http://www.w3.org/2000/svg" class="email-icon" viewBox="0 0 20 20" fill="currentColor">
            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
        </svg>
            @adrianphilip.onda@tup.edu.ph
        </p>
        <p>
            <svg xmlns="http://www.w3.org/2000/svg" class="email-icon" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg>
            @aminah.malic@tup.edu.ph
        </p>
        <h2>Contact Us</h2>
        <p>If you have any questions or inquiries, please feel free to <a href="contact">contact us</a>.</p>
        <p>Call us: +639949021448</p>
        <h2>Our Social Media</h2>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=61557896005874" class="social-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
                </svg>
                Support our Facebook
            </a>
            <a href="https://www.instagram.com/3lectrokits_/" class="social-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Support our Instagram
            </a>
        </div>
    </div>
@endsection
