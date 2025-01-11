<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $note->title }} • Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/js/coreui.bundle.min.js"></script>
    <style>
body {
  background-color: rgb(219, 219, 219) !important;
  overflow-x: hidden;
  padding-bottom: 300px; /* Added extra space at the bottom */
}

.profile-image {
  width: 120px;
  height: 120px;
  border-radius: 50%; /* Circular profile image */
  margin-right: 20px; /* Space between image and name */
  margin-left: 40px; /* Additional margin to shift image to the right */
  position: relative;
  z-index: 2;
  border: 3px solid grey; /* Added grey border */
}

.flex-container {
  display: flex;
  gap: 20px; /* Small gap between boxes */
  padding: 20px;
  width: 80%; /* Adjust width to leave 10% space on each side */
  margin-left: 10%; /* Center the container */
  margin-right: 10%; /* Center the container */
  height: 1000px; /* Reduced height */
  min-height: 80vh; /* Set minimum height for the container to ensure enough space for scrolling */
}

.left-container {
  width: 60%; /* Updated to 60% */
  background-color: #f8f9fa;
  border: 3px solid #ccc;
  padding: 20px;
  border-radius: 5px;
  height: 1159px; /* Set to 100% height of the parent container */
  overflow: auto; /* Allow scrolling if the content exceeds the container's height */
}

/* Right side container (upper and lower stacked vertically) */
.right-side {
    display: flex;
  flex-direction: column; /* Stack containers vertically */
  width: 40%; /* Takes up 40% of the container's width */
  height: 100%; /* Takes up 100% height of the parent container */
  gap: 20px; /* Added gap between upper and lower containers */
}

.upper-right {
  height: 35%; /* Reduced height to 55% */
  background-color: #e9ecef;
  border: 3px solid #ccc;
  padding: 20px;
  border-radius: 5px;
  overflow: auto;
}

.lower-right {
  height: 75%; /* Adjusted to take up 45% of the right side's height */
  background-color: #e9ecef;
  border: 3px solid #ccc;
  padding: 20px;
  border-radius: 5px;
  overflow: auto;
}

/* PDF viewer */
.pdf-viewer {
  width: 100%;
  height: 1065px; /* Adjust height to fit roughly one page */
  border: 5px solid rgb(95, 95, 95); /* Added border (you can adjust the color and width) */
  border-radius: 5px; /* Optional: adds rounded corners */
}

.custom-divider {
  border-top: 2px solid #ccc; /* Gray border */
  margin-top: 20px;  /* Space above divider */
  margin-bottom: 20px;  /* Space below divider */
}
.upload-date {
  font-size: 14px;  /* Smaller font size */
  color: #888;      /* Lighter color for the date */
  margin-left: 10px; /* Add some space between name and date */
}

.description-text {
  font-size: 16px;  /* Adjust the size of the text */
  color: #555;  /* A medium gray color for the text */
  margin-top: 10px;  /* Space above the description text */
  word-wrap: break-word;  /* Ensures long words wrap to the next line */
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

    <!-- Flex Container with Left and Right Boxes -->
    <div class="flex-container">
      <div class="left-container">
        <!-- Content for the left container (PDF Viewer) -->
        <h3>{{ $note->title }}</h3>
        <iframe class="pdf-viewer" src="{{ asset('storage/' . $note->file_path) }}" frameborder="0"></iframe>
      </div>

      <!-- Right Side (Upper and Lower containers stacked vertically) -->
      <div class="right-side">

<!-- Upper Right Container -->
<div class="upper-right">

<!-- Profile Section -->
<div class="d-flex align-items-center">
  <img src="{{ asset('storage/' . $note->user->profile_image) }}" alt="Profile Image" class="profile-image">
  <div class="ms-4"> <!-- Added margin to the left of the profile image -->
    <h4>{{ $note->user->name }} <span class="upload-date">{{ $note->created_at->format('d F Y') }}</span></h4> <!-- Date added -->
    
    <!-- Views and Favourite Section -->
    <div class="d-flex justify-content-start gap-4">
      <div>
        <strong>Views:</strong> {{ $note->views }}
      </div>
      <div>
        <strong>Favourite:</strong> {{ $note->is_favourite ? 'Yes' : 'No' }}
      </div>
    </div>
    
    <!-- Score Section with Star Rating -->
    <div class="mt-3">
      <strong>Score:</strong>
      <div class="rating" data-coreui-read-only="true" data-coreui-precision="0.25" data-coreui-toggle="rating" data-coreui-value="3.79" ></div>
    </div>
  </div>
</div>

<!-- Divider -->
<div class="custom-divider"></div>

<!-- Description Below Divider -->
<p class="description-text">{{ $note->desc }}</p>

</div>

        <!-- Lower Right Container -->
        <div class="lower-right"><!-- Rating with label -->
    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0">Share your feedback!</p>
        <div data-coreui-toggle="rating" data-coreui-value="0"></div>
    </div>

    <!-- Textarea below the rating -->
    <textarea class="form-control mt-3" rows="4" placeholder="Add a comment..." style="resize: none;"></textarea>

    <!-- Submit Button -->
    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
        </div>
      </div>
    </div>

  </body>
</html>
