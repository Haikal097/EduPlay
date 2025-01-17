<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EduPlay</title>
  <!-- Include Font Awesome CDN for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <style>
    body {
      min-height: 100vh;
      background-color: rgb(233, 233, 233) !important;
      background-image: url('{{ asset('images/blue_bg.svg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      overflow-x: hidden;
    }

    .rectangle-box {
      width: 75%;
      height: 700px;
      background-color: rgba(0, 0, 0, 0.6);
      border: 1px solid rgb(0, 0, 0);
      padding: 20px;
      margin: 0 auto;
      border-radius: 15px;
      justify-content: start;
      overflow-y: auto; /* Enable vertical scrolling if content overflows */
      overflow-x: hidden; /* Prevent horizontal scrolling */
    }

    /* Side Navbar */
    .side-navbar {
      height: 100%;
      width: 280px;
      position: fixed;
      top: 90px;
      left: 0;
      background: linear-gradient(to bottom, rgba(0, 6, 65, 0.7), rgba(35, 69, 161, 0.5), rgba(35, 69, 161, 0.1));
      padding-top: 20px;
      overflow-x: hidden;
      z-index: 1;
      padding-left: 20px;
      padding-right: 20px;
    }

    /* Title for Search Results */
    .side-navbar h3 {
      color: white;
      text-align: center;
      margin-bottom: 10px;
      font-size: 24px;
      font-weight: bold;
    }

    /* Dividing line between sections */
    .side-navbar .divider {
      border-top: 1px solid rgba(255, 255, 255, 0.4);
      margin: 10px 0;
    }

    /* Styling filter options */
    .side-navbar a {
      padding: 15px 30px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: block;
      transition: 0.3s;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .side-navbar a:hover {
      background-color: rgba(221, 221, 221, 0.3);
    }

    /* Icons */
    .side-navbar a i {
      margin-right: 15px;
    }

    /* Adjust main content to prevent overlap */
    .main-content {
      margin-left: 280px;
      padding: 20px;
    }

    .hr-sect {
      display: flex;
      flex-basis: 100%;
      align-items: center;
      color: rgba(255, 255, 255, 0.7);
      font-size: 16px;
      margin: 8px 0px;
    }

    .hr-sect::before,
    .hr-sect::after {
      content: "";
      flex-grow: 1;
      background: rgba(255, 255, 255, 0.7);
      height: 1px;
      font-size: 0px;
      line-height: 0px;
      margin: 0px 16px;
    }

    /* Container for the cards, using Flexbox */
    .card-wrapper {
      display: flex;
  flex-wrap: wrap; /* Allow cards to wrap to the next line */
  justify-content: center; /* Centers the cards horizontally */
  align-items: center; /* Centers the cards vertically if they overflow */
      gap: 20px;
      padding: 20px;
    }

    .card {
      width: calc(50% - 20px); /* Ensures two cards fit per row */
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      display: flex;
      flex-direction: column;
      text-decoration: none;
    }

    .user-profile {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.profile-pic-container {
  margin-right: 15px;
}

.profile-pic {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.user-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  margin-right: 15px;
}

.user-name {
  font-size: 16px;
  font-weight: bold;
  margin: 0;
}

.user-email {
  font-size: 14px;
  color: #777;
  margin: 0;
}

.user-stats {
  display: flex;
  align-items: center;
  margin-right: 15px;
}

.stats {
  margin: 0 10px;
}

.stats div {
  font-size: 14px;
}

.stat-value {
  font-size: 16px;
  font-weight: bold;
  color: #333;
}

.divider-vertical {
  width: 1px;
  height: 40px;
  background-color: #ddd;
  margin: 0 10px;
}

.follow-btn-container {
  margin-left: auto;
}

.follow-btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 8px;
  font-size: 16px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
}

.follow-btn i {
  color: white;
}

.follow-btn:hover {
  background-color: #45a049;
}

.play-icon-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.play-icon-button {
  background-color: #007bff; /* Blue background */
  color: #fff; /* White icon color */
  border: none; /* Remove border */
  border-radius: 50%; /* Circular button */
  width: 50px; /* Button width */
  height: 50px; /* Button height */
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer; /* Pointer cursor on hover */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  transition: background-color 0.3s, transform 0.2s;
  text-decoration: none; /* Remove underline */
}

.play-icon-button:hover {
  background-color: #0056b3; /* Darker blue on hover */
  transform: scale(1.1); /* Slightly enlarge on hover */
}

.play-icon-button:active {
  transform: scale(1); /* Reset scale on click */
}

.play-icon {
  font-size: 20px; /* Icon size */
}

.card-game {
  width: 96%; /* Reduce the width to 80% of the parent container */
  max-width: 1500px; /* Optional: Set a max-width to prevent it from getting too wide */
  margin: 20px auto; /* Add gap on top and bottom, and center the card horizontally */
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
  display: flex;
  flex-direction: column;
  text-decoration: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.game-thumbnail-container {
  flex-shrink: 0;
  width: 300px;
  height: 120px;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  margin-right: 20px;
}

.game-thumbnail {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.game-info {
  flex: 1;
}

.game-name {
  font-size: 20px;
  font-weight: bold;
  color: #333;
  margin: 0 0 5px;
}

.uploader-name {
  font-size: 14px;
  color: #666;
  margin: 0;
}

.game-stats {
  width: 20%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.stat-item {
  display: flex;
  align-items: center;
  font-size: 14px;
  color: #333;
}

.stat-item i {
  color: #666;
  margin-right: 6px;
  font-size: 16px;
}

.card-game .stat-value {
  font-weight: bold;
  margin-left: 4px;
}
.game-info .game-name {
  font-size: 1.5rem; /* Increase font size for the game name */
  font-weight: bold; /* Make it stand out */
  margin: 0;
  color: #333; /* Optional: Adjust color for better visibility */
}

.game-info .uploader-name {
  font-size: 1.2rem; /* Increase font size for the uploader name */
  color: #555; /* Optional: Adjust color for a subtler look */
  margin: 5px 0 0;
}
.read-icon-button {
        width: 50px; /* Button width */
        height: 50px; /* Button height */
        background-color: #007bff; /* Blue background */
        color: white; /* White icon color */
        border: none;
        border-radius: 50%; /* Circular button */
        padding: 12px;
        font-size: 20px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
    }

    .read-icon-button:hover {
        background-color: #0056b3; /* Darker blue on hover */
        transform: scale(1.1); /* Slight scale effect on hover */
    }

    .read-icon-button:focus {
        outline: none; /* Remove outline on focus */
    }

    .read-icon {
        font-size: 18px; /* Icon size */
    }
  </style>
</head>

<body>
  @include('mainpage.nav')

  <!-- Side Navbar -->
  <div class="side-navbar">
    <h3>Search Results</h3>
    <div class="divider"></div> <!-- Dividing line -->
    <h3 class="mb-4">Filters</h3> <!-- Added margin-bottom here -->
    <a href="#"><i class="fa-solid fa-cube"></i> All</a>
    <a href="#"><i class="fas fa-users"></i> People</a>
    <a href="#"><i class="fas fa-gamepad"></i> Games</a>
    <a href="#"><i class="fas fa-sticky-note"></i> Notes</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1 class="text-center">Search Results: {{$totalResults}}</h1>
    <div class="rectangle-box mt-4 mb-1 text-center">

<!-- Check if there are users -->
@if($users->isNotEmpty())

<div class="hr-sect"><i class="fas fa-users me-2"></i>People</div>
    <!-- Card Wrapper -->
    <div class="card-wrapper">
        @foreach($users as $user)
            <a href="{{ url('/userprofile/' . $user->id) }}" class="card">
                <div class="user-profile d-flex align-items-center justify-content-between">
                    <!-- Profile Picture -->
                    <div class="profile-pic-container">
                        <img src="{{ asset('images/placeholder_pfp.svg') }}" alt="User Profile" class="profile-pic">
                    </div>

                    <!-- Name and Email -->
                    <div class="user-info">
                        <p class="user-name">{{ $user->name }}</p>
                        <p class="user-email">{{ $user->email }}</p>
                    </div>

                    <!-- Followers and Following -->
                    <div class="user-stats d-flex align-items-center">
                        <div class="stats text-center">
                            <div>Followers</div>
                            <div class="stat-value">3</div>
                        </div>
                        <div class="divider-vertical"></div>
                        <div class="stats text-center">
                            <div>Following</div>
                            <div class="stat-value">3</div>
                        </div>
                    </div>

                    <!-- Follow Icon -->
                    <div class="follow-btn-container">
                        <button class="follow-btn">
                            <i class="fas fa-user-plus"></i>
                        </button>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif

      
@if($games->isNotEmpty())
      <div class="hr-sect"><i class="fas fa-gamepad me-2"></i>Games</div>
<!-- Loop through the games -->
@foreach($games as $game)
    <div class="card-game">
        <div class="game-card d-flex align-items-center justify-content-between">
            <!-- Game Thumbnail -->
            <div class="game-thumbnail-container">
                <img src="{{ asset('storage/' . $game->thumbnail_path) }}" alt="Game Thumbnail" class="game-thumbnail">
            </div>

            <!-- Game Name and Uploader -->
            <div class="game-info">
                <p class="game-name">{{ $game->title }}</p>
                <p class="uploader-name">Uploaded by: {{ $game->uploader_name }}</p>
            </div>

            <!-- Views and Favorites -->
            <div class="game-stats text-center mr-5">
                <div class="stat-item">
                    <i class="fas fa-eye"></i> <span class="stat-value">{{ number_format($game->views) }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-heart"></i> <span class="stat-value">{{ number_format($game->favorites_count) }}</span>
                </div>
            </div>

<!-- Play Icon with Link for Games -->
<div class="play-icon-container">
    <a href="{{ url('/games/' . $game->id) }}" class="play-icon-button">
        <i class="fas fa-play play-icon"></i>
    </a>
</div>

        </div>
    </div>
@endforeach
@endif

@if($notes->isNotEmpty())
      <div class="hr-sect"><i class="fas fa-sticky-note me-2"></i>Notes</div>
<!-- Loop through the notes -->
@foreach($notes as $note)
    <div class="card-game">
        <div class="game-card d-flex align-items-center justify-content-between">
            <!-- Note Thumbnail -->
            <div class="game-thumbnail-container">
                <img src="{{ asset('storage/' . $note->thumbnail_path) }}" alt="Note Thumbnail" class="game-thumbnail">
            </div>

            <!-- Note Title and Uploader -->
            <div class="game-info">
                <p class="game-name">{{ $note->title }}</p>
                <p class="uploader-name">Uploaded by: {{ $note->uploader_name }}</p>
            </div>

            <!-- Views and Favorites -->
            <div class="game-stats text-center mr-5">
                <div class="stat-item">
                    <i class="fas fa-eye"></i> <span class="stat-value">{{ number_format($note->views) }}</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-heart"></i> <span class="stat-value">{{ number_format($note->favorites_count) }}</span>
                </div>
            </div>

<!-- Read Icon with Link -->
<div class="read-icon-container">
    <a href="{{ url('/notes/' . $note->id) }}" class="read-icon-button">
        <i class="fas fa-book read-icon"></i>
    </a>
</div>

        </div>
    </div>
@endforeach
@endif
    </div>
  </div>

</body>

</html>
