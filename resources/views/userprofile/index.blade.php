<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
      background-color: rgb(233, 233, 233) !important; /* Fallback background color */
      background-image: url('{{ asset('images/blue_bg.svg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      overflow-x: hidden;
    }

      .rectangle-box {
        width: 80%;
        height: 50%;
        background-color:rgba(248, 249, 250, 0.75); /* Light gray background */
        border: 1px solid #dee2e6; /* Light gray border */
        padding: 20px;
        margin: 20px auto; /* Center the box horizontally */
        border-radius: 15px; /* Rounded corners */
        position: relative;
      }

      .rounded-top {
    border-top-left-radius: 15px !important; /* Rounds the top-left corner */
    border-top-right-radius: 15px !important; /* Rounds the top-right corner */
    border-bottom-left-radius: 0 !important; /* Keeps the bottom-left corner square */
    border-bottom-right-radius: 0 !important; /* Keeps the bottom-right corner square */
}

      .rounded-bottom {
    border-top-left-radius: 0 !important; /* Ensures the top-left corner stays square */
    border-top-right-radius: 0 !important; /* Ensures the top-right corner stays square */
    border-bottom-left-radius: 15px !important; /* Rounds the bottom-left corner */
    border-bottom-right-radius: 15px !important; /* Rounds the bottom-right corner */
}

      .profile-background {
        width: 97%; /* Adjust the size as needed */
        height: 400px; /* Adjust the size as needed */
        background-color: #007bff; /* Solid color background */
        position: absolute;
        top: 20px; /* Adjust the position as needed */
        z-index: 1; /* Set z-index for background */
      }

      .profile-image-container {
        position: relative;
        display: inline-block;
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

      .profile-image-container:hover .profile-image {
        filter: brightness(50%); /* Darken the image on hover */
      }

      .edit-icon {
        position: absolute;
        top: 50%;
        left: 35%;
        transform: scaleX(-1) translate(-50%, -50%);
        font-size: 42px;
        color: white;
        display: none;
        user-select: none;
        z-index: 3;
      }

      .profile-image-container:hover .edit-icon {
        display: block;
      }

      .extra-bold-text {
        font-weight: 800; /* Increase the bold weight */
        text-shadow: 2px 2px 0px rgb(133, 133, 133);
      }

      .title-overlap {
        position: absolute;
        top: -20px; /* Adjust this value to position the title */
        left: 15%;
        transform: translateX(-50%);
        background-color: rgba(248, 249, 250, 0); /* Match the background color of the box */
        padding: 0 10px; /* Add some padding to the sides */
      }

      .text-outline {
        color: black; /* Inside color */
        text-shadow: 
          -1px -1px 0 rgb(255, 255, 255),
          1px -1px 0 rgb(255, 255, 255),
          -1px 1px 0 rgb(255, 255, 255),
          1px 1px 0 rgb(255, 255, 255);
      }

      .vertical-divider {
        border-left: 2px solid #dee2e6; /* Color and width of the vertical line */
        height: 120px; /* Adjust the height as needed */
        margin: 0 50px; /* Adjust the margin as needed */
      }

      .user-details {
        width: 400px;
      }

      .no-resize {
        resize: none; /* Disable resizing */
      }

      .bio-text {
        max-height: 110px; /* Set a maximum height */
        max-width: 450px; /* Set a maximum width */
        overflow-y: auto; /* Add a vertical scrollbar if the text is too long */
        overflow-x: hidden; /* Hide horizontal overflow */
        word-wrap: break-word; /* Break long words */
        word-break: break-all; /* Break words at any character to prevent overflow */
      }

      /* Horizontal list layout for favorite notes */
      .horizontal-list {
        display: flex;
        gap: 20px;
        overflow-x: auto; /* Allows horizontal scrolling */
        padding: 10px;
        scrollbar-width: thin; /* For Firefox */
      }

      /* Style each note card */
      .note-card {
        flex-shrink: 0;
        width: 150px;
        height: 180px;
        background: #ffffff;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        transition: transform 0.2s ease-in-out; /* Added transition for filter with 0.3s */
        cursor: pointer;
      }

      .note-card:hover {
        transform: scale(1.05);
        filter: brightness(80%); /* Darken the card */
      }

      /* Thumbnail image styling */
      .thumbnail-image {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border: none; /* Remove the border from the image */
      }

      /* Information overlay below the image */
      .note-info {
        padding: 10px;
        text-align: center;
      }

      .note-info strong {
        display: block;
        font-size: 16px;
        color: #333;
      }

      .note-info p {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
      }

      /* Customize the scrollbar */
      .horizontal-list::-webkit-scrollbar {
        height: 8px;
      }

      .horizontal-list::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
      }

      .horizontal-list::-webkit-scrollbar-thumb:hover {
        background-color: #555;
      }

      /* Wrapper for the horizontal list and navigation buttons */
      .horizontal-list-wrapper {
        position: relative;
        width: 100%;
        overflow: hidden; /* Prevent overflow */
      }

      /* Horizontal list container */
      .horizontal-list-container {
        display: flex;
        gap: 20px;
        padding: 10px;
        transform: translateX(0);
        transition: transform 0.3s ease;
      }
      .activity-list {
    display: flex;
    justify-content: space-between; /* Spread items evenly */
    align-items: center;
    width: 100%;
    padding: 10px 0;
    position: relative;
}

.activity-item {
    flex: 1; /* Allow items to share equal space */
    text-align: center;
}

.activity-item h3 {
    margin: 0;
    font-size: 1.25rem; /* Adjust heading size */
    color: #333;
}

.activity-count {
    font-size: 1.5rem; /* Slightly larger for emphasis */
    font-weight: bold;
    color: #007bff; /* Bootstrap primary blue */
    margin: 5px 0 0;
}

/* Vertical Divider */
.vertical-divider2 {
    width: 1px;
    height: 60px;
    background-color: #dee2e6; /* Light gray color */
    margin: 0 10px; /* Add spacing around the divider */
}

a {
  text-decoration: none !important;
}

    </style>
  </head>
  <body>
    @include('mainpage.nav')

    @if(session('success'))
      <div class="alert alert-success alert-popup">
          {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger alert-popup">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <div class="container mt-5">
    <div class="rectangle-box d-flex align-items-center position-relative rounded-top mb-2">
    <!-- Info Icon -->
    <a href="#" class="info-icon position-absolute" style="top: -2px; right: 4px;" data-bs-toggle="modal" data-bs-target="#infoModal">
        <i class="bi bi-info-circle-fill" style="font-size: 1.5rem; color: #007bff;"></i>
    </a>

    <!-- Profile image and edit option -->
    @if($profileUser->profile_image)
        <div class="profile-image-container">
            <a href="#" data-bs-toggle="modal" data-bs-target="#editpfpModal">
              <img src="{{ asset('storage/' . $profileUser->profile_image) }}" alt="Profile Image" class="profile-image">
              <span class="edit-icon">&#9998;</span>
            </a>
        </div>
    @else
        <div class="profile-image-container">
            <a href="#" data-bs-toggle="modal" data-bs-target="#editpfpModal">
              <img src="{{ asset('images/placeholder_pfp.svg') }}" alt="Default Profile Image" class="profile-image">
              <span class="edit-icon">&#9998;</span>
            </a>
        </div>
    @endif

    <div class="user-details flex-grow-2">
        <h1 class="extra-bold-text">{{ $profileUser->name }}</h1>
        <p>{{ $profileUser->email }}</p>

        @if(Auth::id() === $profileUser->id)
            <!-- Only show the edit button if viewing own profile -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editinfoModal">Edit Profile</button>
        @endif
    </div>

    <div class="vertical-divider"></div> <!-- Vertical divider -->
    <div class="d-flex flex-column align-items-start ml-3">
        <p class="bio-text">
            {{ $profileUser->bio ? $profileUser->bio : 'This user hasn\'t set a bio yet.' }}
        </p>
    </div>
</div>
        
<div class="rectangle-box d-flex align-items-center flex-column rounded-bottom mt-2 p-3">
    <div class="activity-list d-flex justify-content-around w-100 align-items-center">
        <!-- Notes -->
        <div class="activity-item text-center">
            <h3 class="mb-1">Notes</h3>
            
    <a href="{{ route('notelist.index', ['id' => request()->route('id')]) }}" style="text-decoration: none;">
    <p class="activity-count display-6 fw-bold">{{ $notesCount ?? 0 }}</p>
  </a>
        </div>
        <!-- Divider -->
        <div class="vertical-divider2 bg-secondary" style="width: 1px; height: 50px;"></div>
        <!-- Games -->
        <div class="activity-item text-center">
    <h3 class="mb-1">Games</h3>
    <a href="{{ route('gamelist.index', ['id' => request()->route('id')]) }}" style="text-decoration: none;">
        <p class="activity-count display-6 fw-bold">{{ $gamesCount ?? 0 }}</p>
    </a>
</div>
    </div>
</div>






        <!-- Favorite games list -->
        <div class="rectangle-box d-flex align-items-center flex-column">
            <h2 class="title-overlap text-outline"><strong>&#9733; Favourite Games </strong></h2>
            @if($favouriteGames->isEmpty())
                <p>{{ $profileUser->name }} has no favorite games yet.</p>
            @else
                <div class="horizontal-list-wrapper">
                    <div class="horizontal-list-container">
                        <div class="horizontal-list d-flex align-items-center">
                        @foreach($favouriteGames as $favorite)
                        <a href="{{ route('game.show', ['id' => $favorite->game->id]) }}" class="note-card-link">
                              <div class="note-card">
                                  <img src="{{ Storage::url($favorite->game->thumbnail_path) }}" class="thumbnail-image" alt="Thumbnail">
                                  <div class="note-info">
                                      <strong>{{ $favorite->game->title }}</strong>
                                      <p>{{ $favorite->game->user->name }}</p>
                                  </div>
                              </div>
                          </a>
                      @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- Favorite notes list -->
        <div class="rectangle-box d-flex align-items-center flex-column">
            <h2 class="title-overlap text-outline"><strong>&#9733; Favourite Notes </strong></h2>
            @if($favouriteNotes->isEmpty())
                <p>{{ $profileUser->name }} has no favorite notes yet.</p>
            @else
                <div class="horizontal-list-wrapper">
                    <div class="horizontal-list-container">
                        <div class="horizontal-list d-flex align-items-center">
                        @foreach($favouriteNotes as $favorite)
                            <a href="{{ route('notes.show', ['id' => $favorite->note->id]) }}" class="note-card-link">
                                <div class="note-card">
                                    <img src="{{ Storage::url($favorite->note->thumbnail_path) }}" class="thumbnail-image" alt="Thumbnail">
                                    <div class="note-info">
                                        <strong>{{ $favorite->note->title }}</strong>
                                        <p>{{ $favorite->note->user->name }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
    </div>

    @if(Auth::id() === $profileUser->id)
        <!-- Modal for Editing Profile Picture -->
        <div class="modal fade" id="editpfpModal" tabindex="-1" aria-labelledby="editpfpModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editpfpModalLabel">Edit Profile Picture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">Max File: 2 MB</label>
                                <input type="file" class="form-control" id="profile_image" name="img">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Editing Profile Info -->
        <div class="modal fade" id="editinfoModal" tabindex="-1" aria-labelledby="editinfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editinfoModalLabel">Edit Profile Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" action="{{ route('userprofile.update') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $profileUser->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $profileUser->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control no-resize" id="bio" name="bio" rows="3">{{ $profileUser->bio }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Here you can display additional information about the user, profile, or any relevant details.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <script>
        // Hide the alert after 3 seconds
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500); // Wait for the transition to complete before removing the element
            }
        }, 3000); // 3 seconds
    </script>
</body>
</html>
