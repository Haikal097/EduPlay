<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Game Temp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/js/coreui.bundle.min.js"></script>
    <style>
      /* Ensure the page takes full height and allows scrolling */
      html, body {
        min-height: 100%;
        margin: 0;
        padding: 0;
      }

      body {
        background-color: rgb(233, 233, 233) !important;
        overflow-x: hidden;
        padding-bottom: 80px; /* Extra space at the bottom */
      }

      .rectangle-main {
        width: 70%;
        height: auto;
        background-color: #f8f9fa;
        border: 3px solid black;
        padding: 20px;
        margin: 20px auto;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        gap: 20px;
      }

      .rectangle-box {
        width: 45%;
        height: auto;
        background-color: #f8f9fa;
        border: 3px solid black;
        padding: 20px;
        margin: 20px auto;
        border-radius: 5px;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
      }

      .game-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 15px;
      }

      .profile-background {
        width: 97%;
        height: 400px;
        background-color: #007bff;
        position: absolute;
        top: 20px;
        z-index: 1;
      }

      .profile-image {
  width: 80px;
  height: 80px;
  border-radius: 50%; /* Circular profile image */
  margin-right: 20px; /* Space between image and name */
  margin-left: 40px; /* Additional margin to shift image to the right */
  position: relative;
  z-index: 2;
  border: 3px solid grey; /* Added black border */
}

      /* New Styles for Left and Right Containers */
      .container-left {
        width: 30%;
        background-color: #f1f1f1;
        padding: 20px;
        border: 3px solid #ccc;
        margin-right: 10px;
        border-radius: 5px;
      }

      .container-right {
        width: 70%;
        background-color: #f1f1f1;
        padding: 20px;
        border: 3px solid #ccc;
        border-radius: 5px;
      }

      .container-wrapper {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        width: 70%; /* Match the main container width */
        margin: 0 auto;
      }



.publisher-info {
  display: flex;
  align-items: center; /* Align the profile image and name horizontally */
}

.publisher-name {
  font-size: 20px;
  font-weight: bold;
  margin-left: 15px; /* Add space between image and name */
}

.no-publisher {
  color: #6c757d;
  font-style: italic;
}
.heart-icon {
    top: 10px; /* Distance from the top of the container */
    right: 10px; /* Distance from the right of the container */
    font-size: 24px; /* Size of the star icon */
    color: black; /* Default color of the star */
    background: none; /* No background for the button */
    border: none; /* Remove default button border */
    cursor: pointer; /* Pointer cursor for interactivity */
    padding: 0; /* Remove padding for a snug fit */
    z-index: 10; /* Ensure the icon is above other elements */
    transition: color 0.3s ease; /* Smooth color transition */
}

.heart-icon:hover {
    color: red; /* Change color to black on hover */
} 

    </style>
  </head>
  <body>
    @include('mainpage.nav')

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="rectangle-main d-flex flex-column align-items-center position-relative">
    <!-- Star Icon at Top Right -->
    <button class="heart-icon position-absolute" type="button" title="Favorite">
      <i class="fa fa-heart" aria-hidden="true"></i>
    </button>

    <!-- Game Title Above the Rectangle Box -->
    <h3 class="game-title mb-3">{{ $game->title }}</h3>

    <!-- Game iframe -->
    <iframe 
        src="{{ asset('storage/' . $game->file_path . '/index.html') }}" 
        width="100%" 
        height="600px" 
        frameborder="0" 
        allowfullscreen>
    </iframe>
</div>



    <!-- Left and Right Containers Below -->
    <div class="container-wrapper">
    <div class="container-left d-flex flex-column justify-content-start align-items-start">
  <!-- Publisher Info -->
  <div class="publisher-info d-flex align-items-center">
    @if($game->publisher) <!-- Check if the publisher exists -->
      <!-- Profile Image on the Left -->
@if($game->publisher && $game->publisher->profile_image)
    <img src="{{ asset('storage/' . $game->publisher->profile_image) }}" class="publisher-img profile-image mb-2" alt="Publisher Image">
@else
    <img src="{{ asset('images/placeholder_pfp.svg') }}" class="publisher-img profile-image mb-2" alt="Default Profile Image">
@endif

      <!-- Publisher Name on the Right -->
      <h4 class="publisher-name ms-3">{{ $game->publisher->name }}</h4>
    @else
      <!-- Default message when publisher is not available -->
      <p class="no-publisher">Publisher information not available</p>
    @endif
  </div>

  <!-- Divider Line -->
  <hr class="w-100 my-3">

  <!-- Placeholder Text -->
  <p class="text-muted">Views: {{ $game->views }}</p>
  <p class="text-muted">Favourite:</p>
  <p class="text-muted" style="margin-bottom: 5px;">Score: 3.79</p>
  <div class="rating" data-coreui-read-only="true" data-coreui-precision="0.25" data-coreui-toggle="rating" data-coreui-value="3.79" ></div>
  
  <!-- Divider Line -->
  <hr class="w-100 my-3">
  
  <p class="text-muted">Uploaded: {{ $game->created_at->format('d-M-Y') }}</p>
</div>



<div class="container-right">
    <!-- Content for the right container -->
    <h5>Description</h5>
    <p>{{ $game->desc }}</p>

    <!-- Divider Line -->
    <hr class="w-100 my-3">

    <!-- Rating with label -->
    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0">Share your feedback!</p>
        <div data-coreui-precision="0.25" data-coreui-toggle="rating" data-coreui-value="0"></div>
    </div>

    <!-- Textarea below the rating -->
    <textarea class="form-control mt-3" rows="4" placeholder="Add a comment..." style="resize: none;"></textarea>

    <!-- Submit Button -->
    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>


    </div>
  </body>
  <script>
    document.querySelector('.heart-icon').addEventListener('click', function () {
    this.classList.toggle('active');
    if (this.classList.contains('active')) {
        this.querySelector('i').classList.add('fas'); // Filled star (Font Awesome)
        this.querySelector('i').classList.remove('far'); // Outline star (Font Awesome)
        alert('Added to favorites!');
    } else {
        this.querySelector('i').classList.add('far');
        this.querySelector('i').classList.remove('fas');
        alert('Removed from favorites!');
    }
});

  </script>
</html>
