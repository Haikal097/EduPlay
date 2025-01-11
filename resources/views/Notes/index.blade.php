<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
      body {
        background-color: rgb(233, 233, 233) !important;
        overflow-x: hidden;
      }

      .rectangle-box {
        width: 100%;
        height: 50%;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 20px;
        margin: 20px auto;
        border-radius: 15px;
        position: relative;
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
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-right: 20px;
        margin-left: 40px;
        position: relative;
        z-index: 2;
        border: 3px solid black;
      }

      .extra-bold-text {
        font-weight: 800;
        text-shadow: 2px 2px 0px rgb(161, 161, 161);
      }

      .fixed-width-card {
        width: 800px;
      }

      .fixed-height-card {
        height: 100px;
        overflow: hidden;
        display: flex;
        flex-direction: row;
      }

      .thumbnail-container {
        width: 225px;
        height: 150px;
        overflow: hidden;
        position: relative;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .thumbnail-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.3s ease;
      }

      .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        flex-grow: 1;
      }

      .hover-container .download-btn,
      .hover-container .favorite-btn {
        transform: translateX(100%);
        opacity: 0;
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        padding: 10px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .hover-container:hover .download-btn,
      .hover-container:hover .favorite-btn {
        transform: translateX(0);
        opacity: 1;
      }

      .hover-container .download-btn:hover,
      .hover-container .favorite-btn:hover {
        transform: scale(1.1);
        background-color: white;
        color: black;
      }

      .hover-container .download-btn:hover i,
      .hover-container .favorite-btn:hover i {
        color: black;
      }

      .favorite-btn i,
      .download-btn i {
        color: white;
        transition: color 0.3s ease;
      }

      .favorite-btn:hover i,
      .download-btn:hover i {
        color: black;
      }

      .favorite-btn:hover,
      .download-btn:hover {
        background-color: white;
      }

      .card.fixed-width-card.fixed-height-card:hover {
        background-color: rgb(0, 110, 255);
        transition: background-color 0.3s ease;
      }

      .card.fixed-width-card.fixed-height-card:hover .bold-link {
  color: white !important;
}


      .card.fixed-width-card.fixed-height-card:hover .card-body {
        color: white;
      }

      .bold-link {
  font-weight: bold;
  text-decoration: none; /* No underline by default */
  transition: text-decoration 0.3s ease; /* Smooth transition */
}

.bold-link:hover {
  text-decoration: underline; /* Underline when hovered */
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

    <div class="container mt-5">
      <!-- Centered Search Bar with Filter UI -->
      <div class="d-flex justify-content-between w-100 align-items-center mb-3">
        <div class="col-9 d-flex justify-content-start align-items-center">
          <input type="text" class="form-control" placeholder="Search...">
          <button class="btn btn-primary ms-2" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <div class="col-3 d-flex justify-content-end align-items-center ms-3">
          <select class="form-select">
            <option value="">Filter by</option>
            <option value="name">Name</option>
            <option value="email">Email</option>
            <option value="bio">Bio</option>
          </select>
        </div>
      </div>

      <!-- Upload Notes Button -->
      <div class="d-flex justify-content-center mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notesModal">
          <i class="fas fa-upload"></i> Upload Notes
        </button>
      </div>

      <!-- Notes Modal -->
      <div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Your Notes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="noteTitle" class="form-label">Title</label>
                  <input type="text" class="form-control" id="noteTitle" name="title" required>
                </div>
                <div class="mb-3">
                  <label for="noteDesc" class="form-label">Description</label>
                  <textarea class="form-control" id="noteDesc" name="desc" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="noteFile" class="form-label">Select PDF File</label>
                  <input type="file" class="form-control" id="noteFile" name="pdf_file" accept=".pdf" required>
                </div>
                <div class="mb-3">
                  <label for="noteThumbnail" class="form-label">Upload Thumbnail (Image)</label>
                  <input type="file" class="form-control" id="noteThumbnail" name="thumbnail_image" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Notes Display Section -->
      <div class="rectangle-box d-flex align-items-center">
        <div class="row justify-content-center">
          @foreach ($notes as $note)
          <div 
    class="col-md-6 mb-4 d-flex justify-content-center">
    <div 
        class="card fixed-width-card fixed-height-card d-flex flex-row position-relative hover-container" 
        data-href="{{ route('notes.show', $note->id) }}" 
        style="cursor: pointer;" 
        onclick="window.location.href=this.getAttribute('data-href');">
        <div class="thumbnail-container">
            @if ($note->thumbnail_path)
                <img src="{{ Storage::url($note->thumbnail_path) }}" class="img-fluid" alt="Thumbnail">
            @else
                <img src="{{ asset('images/default-thumbnail.jpg') }}" class="img-fluid" alt="Default Thumbnail">
            @endif
        </div>
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $note->title }}</h5>
            <p class="card-text truncate-text">
                uploaded by: <a href="{{ route('profile.show', $note->user->id) }}" class="bold-link">{{ $note->user->name }}</a>
            </p>
            <div class="mt-auto">
                <a href="{{ Storage::url($note->file_path) }}" 
                   class="btn btn-success download-btn position-absolute bottom-0 end-0 mb-2 me-2" 
                   target="_blank" 
                   onclick="event.stopPropagation();">
                    <i class="fas fa-download"></i>
                </a>
                <button 
                    class="btn btn-warning favorite-btn position-absolute top-0 end-0 mt-2 me-2" 
                    data-note-id="{{ $note->id }}" 
                    onclick="event.stopPropagation();">
                    <i class="fas fa-star"></i>
                </button>
            </div>
        </div>
    </div>
</div>


          @endforeach
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const favoriteButtons = document.querySelectorAll('.favorite-btn');

        favoriteButtons.forEach(button => {
          button.addEventListener('click', function () {
            const noteId = this.getAttribute('data-note-id');

            // Make the AJAX request to favorite the note
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
                this.classList.add('active');
                alert('Note added to favorites');
              } else if (data.message === 'Note already favorited') {
                alert('This note is already in your favorites');
              } else {
                alert('An error occurred while adding the note to favorites');
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
