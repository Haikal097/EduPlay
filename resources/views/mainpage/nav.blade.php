<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->

    <style>
      .navbar-custom {
        height: 90px; /* Adjust the height as needed */
        padding: 10px 20px; /* Adjust the padding as needed */
      }
      .navbar-brand img {
        width: 40px; /* Adjust the width as needed */
        height: 40px; /* Adjust the height as needed */
      }
      .navbar-brand strong {
        font-size: 1.5rem; /* Adjust the font size as needed */
      }
      .bg {
        background: linear-gradient(to top, #2344a1, #3664e3); /* Gradient from blue to white */      
      }
      .button_login, .button_register {
        display: inline-block;
        outline: 0;
        border: 0;
        cursor: pointer;
        will-change: box-shadow, transform;
        background: radial-gradient(100% 100% at 100% 0%,rgb(230, 230, 230) 0%,rgb(255, 255, 255) 100%);
        box-shadow: 0px 2px 4px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px rgb(58 65 111 / 50%);
        padding: 0 32px;
        line-height: 43px;
        border-radius: 6px;
        color: #fff;
        height: 48px;
        font-size: 18px;
        font-weight: bold;
        color:#3c4fe0;
        transition: box-shadow 0.15s ease, transform 0.15s ease;
      }
      .button_login:hover, .button_register:hover {
        box-shadow: 0px 4px 8px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px #3c4fe0;
        transform: translateY(-2px);
      }
      .button_login:active, .button_register:active {
        box-shadow: inset 0px 3px 7px #3c4fe0;
        transform: translateY(2px);
      }
      .hover-highlight {
        position: relative;
        display: inline-block;
        text-decoration: none;
      }
      .hover-highlight::after {
        content: '';
        position: absolute;
        width: 70%;
        transform: scaleX(0);
        height: 3px;
        bottom: -3px;
        left: 50%;
        margin-left: -35%;
        bottom: -15px;
        background-color: rgb(255, 255, 255); /* Highlight color */
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
        text-decoration: none;
      }
      .hover-highlight:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-light bg navbar-custom">
        <div class="ml-3">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/eduplay_logowhite.svg') }}" class="d-inline-block align-top" alt="Logo">
                <strong class="ms-2 text-white">EduPlay</strong>
            </a>
        </div>
        
        <div class="d-flex justify-content-center align-items-center">
          <a href="{{ url('/') }}" class="hover-highlight text-center d-block w-100 px-5"><strong class="text-white">Home</strong></a>
          <a href="{{ url('/games') }}" class="hover-highlight text-center d-block w-100 px-5"><strong class="text-white">Games</strong></a>
          <a href="{{ url('/notes') }}" class="hover-highlight text-center d-block w-100 px-5"><strong class="text-white">Notes</strong></a>
        </div>

        <div class="ml-auto">
        @if (Route::has('login'))
    @auth
        <div class="d-flex align-items-center">
            <a href="{{ url('/userprofile/' . auth()->user()->id) }}">
                @if(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="profile-image rounded-circle img-fluid mt-n2" style="width: 60px; height: 60px; border: 2px solid white;">
                @else
                    <img src="{{ asset('images/placeholder_pfp.svg') }}" alt="Default Profile Image" class="profile-image rounded-circle img-fluid mt-n2" style="width: 60px; height: 60px; border: 2px solid white;">
                @endif
            </a>

            <!-- Log Out Button with Icon -->
            <form action="{{ route('logout') }}" method="POST" class="ms-3">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> <!-- Font Awesome Logout Icon -->
                </button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}" class="button_login text-decoration-none">Log in</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="button_register text-decoration-none">Register</a>
        @endif
    @endauth
@endif
        </div>
    </nav>
  </body>
</html>
