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
  position: relative;
}

/* Right side container (upper and lower stacked vertically) */
.right-side {
    display: flex;
  flex-direction: column; /* Stack containers vertically */
  width: 40%; /* Takes up 40% of the container's width */
  height: 125%; /* Takes up 100% height of the parent container */
  gap: 20px; /* Added gap between upper and lower containers */
}

.upper-right {
  height: 25%; /* Reduced height to 55% */
  background-color: #e9ecef;
  border: 3px solid #ccc;
  padding: 20px;
  border-radius: 5px;
  overflow: auto;
}

.lower-right {
  height: 839px; /* Adjusted to take up 45% of the right side's height */
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
  border-top: 2px solid #ddd;
  margin-top: 15px;
  margin-bottom: 15px;
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

.user-comment {
  border-top: 1px solid #ccc; /* Optional: Adds a separator line before the comment */
  padding-top: 10px;
}

.comment-image {
  width: 50px; /* Increase the size (adjust as needed) */
  height: 50px; /* Match the width for a perfect circle */
  border-radius: 50%; /* Keeps the circular shape */
  border: 2px solid #ddd; /* Optional border */
}

.text-muted {
  font-size: 12px;
}

h6 {
  margin-bottom: 0;
}

textarea.form-control {
  resize: none;
}
.rate {
  display: flex; /* Make the container a flexbox */
  flex-direction: row-reverse; /* Reverse the order of children */
  justify-content: flex-end; /* Align stars to the right */
}
.rate input {
  display: none; /* Hide radio buttons */
}

.rate label {
  font-size: 20px; /* Adjust size of stars */
  margin: 0 5px; /* Spacing between stars */
  cursor: pointer; /* Pointer cursor for labels */
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
.heart-icon-link {
  position: absolute;
  top: 10px; /* Adjust the top position */
  right: 10px; /* Adjust the right position */
}

.heart-icon {
  font-size: 1.5rem; /* Adjust heart icon size */
  color: gray; /* Default color */
}

.heart-icon-link .heart-icon:hover {
  color: red !important; /* Use !important to override other styles */
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
    <div class="left-container" style="position: relative;">
  <!-- Content for the left container (PDF Viewer) -->
  <h3>{{ $note->title }}</h3>
  <iframe class="pdf-viewer" src="{{ asset('storage/' . $note->file_path) }}" frameborder="0"></iframe>

<!-- Heart Icon on the top right -->
<a href="#" class="heart-icon-link">
  <i class="fas fa-heart {{ $note->is_favourite ? 'text-danger' : 'text-muted' }} heart-icon fs-4" id="favorite-icon-{{ $note->id }}" data-note-id="{{ $note->id }}"></i>
</a>


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
      <strong>Favourite:</strong> {{ $favoriteCount }}
      </div>
    </div>
    
<!-- Score Section with Star Rating -->
<div class="mt-3">
    <strong>Score:</strong> 
    <span>{{ number_format($note->average_rating, 2) }}</span>
    <small class="text-muted">({{ $note->feedback->count() }} ratings)</small>
    <div class="rating" data-coreui-read-only="true" data-coreui-precision="0.25" data-coreui-toggle="rating" 
         data-coreui-value="{{ $note->average_rating }}" ></div>
</div>


  </div>
</div>

<!-- Divider -->
<div class="custom-divider"></div>

<!-- Description Below Divider -->
<p class="description-text">{{ $note->desc }}</p>

</div>

<!-- Lower Right Container -->
<div class="lower-right">
@php
    $existingFeedback = $note->feedback->where('user_id', auth()->id())->first();
    $formAction = $existingFeedback 
        ? "/feedback/{$existingFeedback->id}" 
        : "/feedback";
@endphp

<form id="feedbackForm" method="POST" action="{{ $formAction }}">
    @csrf
    @if($existingFeedback)
        @method('PUT')
    @endif
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="note_id" value="{{ $note->id }}">
    <input type="hidden" name="rating" id="ratingInput" value="{{ $existingFeedback ? $existingFeedback->rating : 0 }}">

    <!-- Rating with label -->
    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0 ms-2">{{ $existingFeedback ? 'Edit your feedback!' : 'Share your feedback!' }}</p>
        <div class="rate ms-auto">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                    {{ $existingFeedback && $existingFeedback->rating == $i ? 'checked' : '' }} />
                <label for="star{{ $i }}" title="{{ $i }} stars">{{ $i }} stars</label>
            @endfor
        </div>
    </div>

    <!-- Display validation errors if any -->
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Textarea below the rating -->
    <textarea 
        class="form-control mt-3 @error('comment') is-invalid @enderror" 
        rows="4" 
        name="comment" 
        placeholder="Add a comment..." 
        style="resize: none;">{{ $existingFeedback ? $existingFeedback->comment : '' }}</textarea>

<!-- Submit/Edit/Delete Buttons -->
<div class="text-end mt-3">
    @if($existingFeedback)
        <div class="btn-group" role="group">
            <!-- Delete button first -->
            <button type="button" class="btn btn-danger rounded-start" 
                    onclick="if(confirm('Are you sure you want to delete this feedback?')) { 
                        document.getElementById('delete-form').submit(); 
                    }">
                Delete
            </button>
            <!-- Edit button second with a small gap -->
            <button type="submit" class="btn btn-primary rounded-end ms-1" style="min-width: 70px;">
    Edit
</button>

        </div>
    @else
        <button type="submit" class="btn btn-primary rounded">
            Submit
        </button>
    @endif
</div>


</form>

@if($existingFeedback)
    <form id="delete-form" action="/feedback/{{ $existingFeedback->id }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endif


<!-- User Comments Section -->
@forelse($note->feedback as $comment)
  <div class="user-comment mt-4">
    <div class="d-flex align-items-center">
      <!-- User's Profile Pic -->
      @if($comment->user->profile_image)
        <img src="{{ asset('storage/' . $comment->user->profile_image) }}" 
             alt="Profile Image" 
             class="comment-image" 
             width="30" 
             height="30">
      @else
        <img src="{{ asset('images/placeholder_pfp.svg') }}" 
             alt="Default Profile Image" 
             class="comment-image" 
             width="30" 
             height="30">
      @endif

      <div class="ms-3">
        <!-- User's Name and Date -->
        <h6 class="mb-0">
          {{ $comment->user->name }}
          <span class="text-muted">| {{ $comment->created_at->format('F d, Y') }}</span>
        </h6>
        <!-- Star Rating -->
        <div data-coreui-precision="0.25" 
             data-coreui-toggle="rating" 
             data-coreui-value="{{ $comment->rating }}" 
             data-coreui-read-only="true"
             class="mt-1">
        </div>
      </div>
    </div>

    <!-- Comment Text -->
    @if($comment->comment)
      <p class="mt-2" style="word-wrap: break-word;">{{ $comment->comment }}</p>
    @endif
  </div>
@empty
<div class="text-center mt-4">
  <hr> <!-- Divider above the message -->
  <p class="text-muted mt-2">No feedback yet. Be the first to share your thoughts!</p>
</div>
@endforelse

  
  
</div>


      </div>
    </div>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.heart-icon').forEach(icon => {
      icon.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default anchor behavior

        const noteId = this.getAttribute('data-note-id');
        const heartIcon = this; // This is the heart icon itself

        // Make the AJAX request to toggle the favorite status
        fetch(`/favorite/${noteId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({ note_id: noteId })
        })
        .then(response => response.json())
        .then(data => {
          if (data.message === 'Note added to favorites') {
            // Change heart color to red when added to favorites
            heartIcon.classList.remove('text-muted');
            heartIcon.classList.add('text-danger');
            alert('Note added to favorites');
          } else if (data.message === 'Note removed from favorites') {
            // Change heart color to gray when removed from favorites
            heartIcon.classList.remove('text-danger');
            heartIcon.classList.add('text-muted');
            alert('Note removed from favorites');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred while processing your request');
        });
      });
    });
  });
</script>


  </body>
</html>
