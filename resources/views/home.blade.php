{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <a href="{{ route('customer.index') }}" class="btn btn-primary">Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('content')
<video autoplay loop muted id="video-background">
  <source src="{{ asset('videos/home.mp4') }}" type="video/mp4">
  Your browser does not support the video tag.
</video>

<div id="Connectors" class="tabcontent">
  <div class="card-container">
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/dupont.jpg') }}" alt="Connector">
      <h3>Connectors</h3>
      <p>Click to show more Connectors</p>
    </div>
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/oled.jpg') }}" alt="Display">
      <h3>Displays</h3>
      <p>Click to show more Displays</p>
    </div>
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/step.jpg') }}" alt="Electromechanical">
      <h3>Electromechanical Components</h3>
      <p>Click to show more Electromechanical Components</p>
    </div>
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/fans.jpg') }}" alt="Cooling">
      <h3>Fans and Sensors</h3>
      <p>Click to show more  Fans and Sensors</p>
    </div>
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/resistor.jpg') }}" alt="Passive">
      <h3>Passive Components</h3>
      <p>Click to show more  Passive Components</p>
    </div>
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/supply.jpg') }}" alt="Power">
      <h3>Power Supplies and Modules</h3>
        <p>Click to show more  Power Supplies and Modules</p>
    </div>
    <div class="card" onclick="window.location='{{ route('customer.index') }}'">
      <img src="{{ asset('storage/images/breadboard.jpg') }}" alt="Prototyping">
      <h3>Prototyping</h3>
      <p>Click to show more  Prototyping</p>
    </div>
    <div class="card" onclick="redirectToShop()">
      <img src="{{ asset('storage/images/duino.jpg') }}" alt="Semiconductor">
      <h3>Semiconductor </h3>
      <p>Click to show more  Semiconductor </p>
    </div>
  </div>
</div>
<style>
    #video-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1; /* Ensure the video stays behind other content */
      object-fit: cover; /* Ensure the video covers the entire background */
    }

    /* Style for card container */
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
      margin-top: 20px; /* Added margin to push cards below the header */
      max-width: 1000px; /* Increased maximum width of the container */
      margin-left: auto; /* Centering the container horizontally */
      margin-right: auto; /* Centering the container horizontally */
    }

    /* Style for card */
    .card {
      width: calc(25% - 30px); /* Adjusted card width to fit 4 columns with gap */
      max-width: calc(25% - 30px); /* Added max-width to prevent cards from stretching */
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      text-align: center;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s; /* Smooth transition for background color change */
    }

    /* Change background color when hovering over the card */
    .card:hover {
      background-color: #f5f5f5; /* New background color on hover */
    }

    /* Style for card image */
    .card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto 10px; /* Centering the image vertically and adding margin at the bottom */
      display: block; /* Ensuring the image is displayed as a block element */
    }

    /* Style for card title */
    .card h3 {
      font-size: 18px; /* Adjusting font size for better alignment */
      margin-bottom: 5px; /* Adding a small margin at the bottom */
    }

    /* Style for card description */
    .card p {
      font-size: 14px; /* Adjusting font size for better alignment */
      margin-bottom: 0; /* Removing default margin to prevent extra space */
    }
  </style>
@endsection

