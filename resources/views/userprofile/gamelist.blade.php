<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EduPlay • Game List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/css/coreui.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.9.0/dist/js/coreui.bundle.min.js"></script>
  <!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <style>
/* Ensure the body and html take up the full screen */
html, body {
  height: 100%;
  margin: 0;
}

/* Style for the body */
body {
  background-color: rgb(233, 233, 233) !important; /* Fallback background color */
  background-image: url('{{ asset('images/blue_bg.svg') }}');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  overflow-x: hidden;
}



/* Style for the main content container (table) */
.table-container {
    width: 90%; /* Increase the width to 90% (or adjust as needed) */
  max-width: 1500px; /* Optional: Set a maximum width for very large screens */
  background-color: rgba(255, 255, 255, 0.5);
  padding: 20px;
  border-radius: 15px; /* Rounded corners for the entire table container */
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
  margin-top: 80px; /* Space for the navbar */
  margin-left: auto;
  margin-right: auto; /* Center horizontally */
}

/* Table styling */
.table {
  border-collapse: separate; /* Ensure no border overlap */
  border-spacing: 0; /* Remove spacing between cells */
  border-radius: 15px; /* Rounded corners for the entire table */
  overflow: hidden; /* Prevent the table corners from being cut off */
}

.table tbody td,
.table tbody th {
  border: none;
}

/* Custom gradient styling for the table header */
.table thead th {
  background: linear-gradient(to bottom, rgb(77, 112, 255), rgb(133, 182, 255)); /* Gradient from blue to light blue */
  color: white;
  border: none; /* No border for header cells */
  border-radius: 0; /* Explicitly remove any rounding in the header */
}
/* New class for bigger buttons */
.large-btn {
  font-size: 1.25rem; /* Increase the font size */
  padding: 15px 50px; /* Increase padding for bigger buttons */
  min-width: 200px; /* Ensures buttons are bigger even with short text */
  height: auto; /* Let the height adjust automatically */
}

/* Style for the button group */
.btn-group .btn {
  border-radius: 0; /* Remove all border-radius initially */
}

.btn-group .rounded-left {
  border-radius: 30px 0 0 30px; /* Rounded corners on the left button */
}

.btn-group .rounded-right {
  border-radius: 0 30px 30px 0; /* Rounded corners on the right button */
}

.btn-group .btn:not(:last-child) {
  border-right: none; /* Remove the gap between buttons */
}


  </style>
</head>


<body>
  @include('mainpage.nav')

    <!-- 3 buttons container -->
    <div class="container text-center mt-4">
    <div class="btn-group">
      <a href="{{ route('notelist.index', ['id' => request()->route('id')]) }}" class="btn btn-primary rounded-left large-btn">Notes</a>
      <a href="#" class="btn btn-light text-primary rounded-right large-btn"><strong>Games</strong></a>
    </div>
  </div>

  <!-- Table Container with White Background -->
<div class="container">
    <div class="table-container">
    @if($games->isEmpty())
        <p class="text-center">No games available for this user.</p>
    @else
    <table id="gamesTable" class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col" class="text-sm-center">Title</th>
          <th scope="col" class="text-sm-center">Date Uploaded</th>
          <th scope="col" class="text-sm-center">Views</th>
          <th scope="col" class="text-sm-center">Avg. Rating</th>
          <th scope="col" class="text-sm-center">
          @if(Auth::id() === (int)$id)Delete
          @else
          Link
          @endif
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($games as $index => $game)
          <tr>
            <th scope="row">{{ $index + 1 }}</th>
            <td class="text-sm-center">{{ $game->title }}</td>
            <td class="text-sm-center">{{ $game->created_at->format('d-m-Y') }}</td>
            <td class="text-sm-center">{{ $game->views ?? 0 }}</td>
            <td class="text-sm-center">{{ number_format($game->avg_rating, 2) }}</td>
            <td class="text-sm-center">
            @if(Auth::id() === (int)$id)
              <form action="{{ route('games.destroy', $game->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this note?')">
                  Delete
                </button>
                @else
                <a href="{{ route('game.show', $game->id) }}" class="btn btn-primary btn-sm">
  Go
</a>
              </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif
</div>

</div>
<script>
    $(document).ready(function () {
      $('#gamesTable').DataTable({
        order: [[0, 'asc']], // Default sorting: First column
        columnDefs: [
          { orderable: false, targets: [5] }, // Disable sorting for the "Delete" column
        ],
      });
    });
  </script>
</body>
</html>
