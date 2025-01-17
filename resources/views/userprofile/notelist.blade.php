<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EduPlay • Game List</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- jQuery and DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <style>
    /* Ensure the body and html take up the full screen */
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      background-color: rgb(233, 233, 233) !important;
      background-image: url('{{ asset('images/blue_bg.svg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      overflow-x: hidden;
    }

    /* Main content container */
    .table-container {
      width: 90%;
      max-width: 1500px;
      background-color: rgba(255, 255, 255, 0.5);
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
      margin-top: 80px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Table styles */
    .table {
      border-collapse: separate;
      border-spacing: 0;
      border-radius: 15px;
      overflow: hidden;
    }

    .table thead th {
      background: linear-gradient(to bottom, rgb(77, 112, 255), rgb(133, 182, 255));
      color: white;
      border: none;
    }

    /* Button group */
    .large-btn {
      font-size: 1.25rem;
      padding: 15px 50px;
      min-width: 200px;
    }

    .btn-group .btn {
      border-radius: 0;
    }

    .btn-group .rounded-left {
      border-radius: 30px 0 0 30px;
    }

    .btn-group .rounded-right {
      border-radius: 0 30px 30px 0;
    }

    .btn-group .btn:not(:last-child) {
      border-right: none;
    }

  </style>
</head>

<body>
  @include('mainpage.nav')

  <!-- Button Group -->
  <div class="container text-center mt-4">
    <div class="btn-group">
      <a href="{{ route('notelist.index', ['id' => request()->route('id')]) }}" class="btn btn-light text-primary rounded-left large-btn">
        <strong>Notes</strong>
      </a>
      <a href="{{ route('gamelist.index', ['id' => request()->route('id')]) }}" class="btn btn-primary rounded-right large-btn">
        Games
      </a>
    </div>
  </div>

  <!-- Table Container -->
  <div class="container">
    <div class="table-container">
      @if($notes->isEmpty())
        <p class="text-center">No notes available for this user.</p>
      @else
        <table id="notesTable" class="table table-striped">
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
            @foreach ($notes as $index => $note)
              <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td class="text-sm-center">{{ $note->title }}</td>
                <td class="text-sm-center">{{ $note->created_at->format('d-m-Y') }}</td>
                <td class="text-sm-center">{{ $note->views ?? 0 }}</td>
                <td class="text-sm-center">{{ number_format($note->average_rating ?? 0, 2) }}</td>
                <td class="text-sm-center">
                  @if(Auth::id() === (int)$id)
                    <!-- Delete button -->
                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this note?')">
                        Delete
                      </button>
                    </form>
                  @else
                    <!-- Link to the note -->
                    <a href="{{ route('notes.show', $note->id) }}" class="btn btn-primary btn-sm">
                      Go
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>

  <!-- DataTable Initialization -->
  <script>
    $(document).ready(function () {
      $('#notesTable').DataTable({
        order: [[0, 'asc']], // Default sorting by the first column
        columnDefs: [
          { orderable: false, targets: [5] }, // Disable sorting for the "Delete" column
        ],
      });
    });
  </script>
</body>

</html>
