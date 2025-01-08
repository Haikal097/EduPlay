<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
      body {
        background-color:rgb(233, 233, 233) !important; /* Change this to your desired background color */
        overflow-x: hidden;
      }
      .rectangle-box {
        width: 80%;
        height: 50%;
        background-color: #f8f9fa; /* Light gray background */
        border: 1px solid #dee2e6; /* Light gray border */
        padding: 20px;
        margin: 20px auto; /* Center the box horizontally */
        border-radius: 15px; /* Rounded corners */
        position: relative;
      }
      .profile-background {
        width: 97%; /* Adjust the size as needed */
        height: 400px; /* Adjust the size as needed */
        background-color: #007bff; /* Solid color background */
        position: absolute;
        top: 20px; /* Adjust the position as needed */
        z-index: 1; /* Set z-index for background */
      }
      .profile-image {
        width: 150px; /* Adjust the size as needed */
        height: 150px; /* Adjust the size as needed */
        border-radius: 50%; /* Make the image circular */
        margin-right: 20px; /* Space between image and text */
        margin-left: 40px; /* Shift the image to the right */
        position: relative; /* Ensure it is positioned relative to the parent */
        z-index: 2; /* Set z-index for image to be in front */
        border: 3px solid black; /* Add border */
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

    <div class="rectangle-box d-flex align-items-center">
  </body>
</html>