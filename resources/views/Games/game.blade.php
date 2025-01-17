<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $game->title }} • Game</title>
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
        height: 360px;
        background-color: #f1f1f1;
        padding: 20px;
        border: 3px solid #ccc;
        margin-right: 10px;
        border-radius: 5px;
      }

      .container-right {
        width: 70%;
        height: 1000px;
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

*{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    opacity: 0;
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
    .fa-heart {
        color: gray;
        cursor: pointer;
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }

    .fa-heart.favorited {
        color: red;
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
    <!-- Favorite Icon -->
<button class="heart-icon position-absolute"
        type="button"
        title="Favorite"
        data-game-id="{{ $game->id }}"
        data-favorited="{{ $isFavorited ? 'true' : 'false' }}">
        <i class="fa fa-heart {{ $isFavorited ? 'favorited' : '' }}"></i>
</button>


    <!-- Game Title -->
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
  <p class="text-muted">Favourite: {{$favoriteCount}}</p>
  <p class="text-muted" style="margin-bottom: 5px;">Score: {{ number_format($averageRating, 2) }} ({{ $feedbackCount }} rating{{ $feedbackCount > 1 ? 's' : '' }})</p>

<div class="rating" 
     data-coreui-read-only="true" 
     data-coreui-precision="0.25" 
     data-coreui-toggle="rating" 
     data-coreui-value="{{ $averageRating }}">
</div>

  
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

    <!-- Feedback Form -->
    @php
    $existingFeedback = $game->feedback->where('user_id', auth()->id())->first();
    $formAction = $existingFeedback 
    ? route('feedbackgame.update', $existingFeedback->id) 
    : route('feedback-game.store', ['game' => $game->id]);
@endphp

<form method="POST" action="{{ $formAction }}">
    @csrf
    @if ($existingFeedback)
        @method('PUT')
    @endif
        <!-- Hidden inputs -->
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <input type="hidden" name="game_id" value="{{ $game->id }}">

    <!-- Rating with Label -->
    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-0">{{ $existingFeedback ? 'Edit your feedback!' : 'Share your feedback!' }}</p>
        <div class="rate ms-auto">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                    {{ $existingFeedback && $existingFeedback->rating == $i ? 'checked' : '' }} />
                <label for="star{{ $i }}" title="{{ $i }} stars">{{ $i }} stars</label>
            @endfor
        </div>
    </div>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Textarea for Comment -->
    <textarea 
        class="form-control mt-3 @error('comment') is-invalid @enderror" 
        name="comment" 
        rows="4" 
        placeholder="Add a comment..." 
        style="resize: none;">{{ $existingFeedback ? $existingFeedback->comment : '' }}</textarea>

    <!-- Submit/Edit/Delete Buttons -->
    <div class="text-end mt-3">
        @if ($existingFeedback)
            <div class="btn-group" role="group">
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger" 
                        onclick="if (confirm('Are you sure you want to delete this feedback?')) { 
                            document.getElementById('delete-form').submit(); 
                        }">
                    Delete
                </button>

                <!-- Edit Button -->
                <button type="submit" class="btn btn-primary ms-2">Update</button>
            </div>
        @else
            <button type="submit" class="btn btn-primary">Submit</button>
        @endif
    </div>
</form>

@if ($existingFeedback)
    <!-- Hidden Delete Form -->
    <form id="delete-form" action="{{ route('feedbackgame.destroy', $existingFeedback->id) }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endif

    
    <!-- User Comments Section -->
@forelse($game->feedback as $comment)
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
  </body>
  <script>
document.addEventListener('DOMContentLoaded', function () {
    const heartIcon = document.querySelector('.heart-icon');

    heartIcon.addEventListener('click', function () {
        const gameId = this.getAttribute('data-game-id');
        const isFavorited = this.getAttribute('data-favorited') === 'true';
        const icon = this.querySelector('i');

        // Send AJAX request
        fetch(`/games/${gameId}/favorite`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                // Toggle the favorited state
                if (isFavorited) {
                    icon.classList.remove('favorited');
                    this.setAttribute('data-favorited', 'false');
                } else {
                    icon.classList.add('favorited');
                    this.setAttribute('data-favorited', 'true');
                }
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>

</html>
