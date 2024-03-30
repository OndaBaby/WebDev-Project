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
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; /* Apply Shopee font */
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }
        .container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #ffffff; /* White */
            z-index: 1; /* Ensure content is above the video */
        }
        .video-container {
            position: relative;
            width: 100%;
            height: 100vh; /* Adjust the height as needed */
            overflow: hidden;
        }
        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Ensure video is behind other content */
        }
        .image-container {
            width: 100%;
            height: 100vh; /* Same height as video containers */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image-container img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    <!-- Video Backgrounds -->
    <div class="video-container">
        <video autoplay loop muted class="video-bg">
            <source src="{{ asset('videos/video (1).mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
<p></p>
    <div class="video-container">
        <video autoplay loop muted class="video-bg">
            <source src="{{ asset('videos/video (2).mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
<p></p>
<div class="video-container">
    <video autoplay loop muted class="video-bg">
        <source src="{{ asset('videos/video (3).mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
<p></p>
    <div class="image-container">
        <img src="{{ asset('storage/images/history.png') }}" alt="History Image">
    </div>

@endsection
