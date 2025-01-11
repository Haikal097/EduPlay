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
        background-color: rgb(233, 233, 233) !important;
        overflow-x: hidden;
      }
      .rectangle-box {
        width: 80%;
        height: 50%;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 20px;
        margin: 20px auto;
        border-radius: 15px;
        position: relative;
      }
      /* Fix the size of the card */
  .fixed-card {
    width: 460px;
    height: 400px; /* Set a fixed height for the card */
    display: flex;
    flex-direction: column;
  }

  .fixed-card img {
    height: 180px; /* Ensure the image doesn't stretch too much */
    object-fit: cover; /* Ensure the image fills the space without distorting */
  }

  .fixed-card .card-body {
    flex-grow: 1; /* Ensure that the body grows to fill the available space */
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Upload Your Game</h3>
        <form action="{{ route('upload.game') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="title" class="form-label">Game Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="mb-3">
            <label for="desc" class="form-label">Game Description</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="zipFile" class="form-label">Upload Game (.zip)</label>
            <input type="file" class="form-control" id="zipFile" name="zipFile" accept=".zip" required>
          </div>
          <div class="mb-3">
            <label for="noteThumbnail" class="form-label">Upload Thumbnail (Image)</label>
            <input type="file" class="form-control" id="noteThumbnail" name="thumbnail_image" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>


    <div class="rectangle-box d-flex flex-column align-items-center">
      
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Upload game
</button>

    </div>
<!-- Game List Container -->
<div class="rectangle-box d-flex flex-wrap justify-content-start">
@foreach($games as $game)
<div class="col-md-4 mb-4 d-flex justify-content-center">
  <a href="{{ route('game.show', $game->id) }}" class="text-decoration-none">
    <div class="card fixed-card">
      <!-- Corrected Image Path -->
      <img src="{{ asset('storage/games/thumbnails/' . basename($game->thumbnail_path)) }}" class="card-img-top" alt="Game Thumbnail">
      <div class="card-body d-flex flex-column align-items-center text-center">
  <h5 class="card-title">{{ $game->title }}</h5>
  <p class="card-text">{{ $game->publisher->name }}</p>
</div>

    </div>
  </a>
</div>

  @endforeach
</div>


  </body>
</html>
