@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Note</h1>
    <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="pdf_file" class="form-label">PDF File</label>
            <input class="form-control" type="file" id="pdf_file" name="pdf_file" accept="application/pdf" required>
        </div>
        <div class="mb-3">
            <label for="thumbnail_image" class="form-label">Thumbnail (optional)</label>
            <input class="form-control" type="file" id="thumbnail_image" name="thumbnail_image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection