<!DOCTYPE html>
<html>
<head>
    <title>Add New Word</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        html, body {
            height: 110%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            margin: 0;
        }
        .form-container {
            width: 80%;
           
        }
    </style>
</head>
<body>

<div class="form-container">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary bg-dark">Back to Mini Projects Page</a>
            <a href="{{ route('words.index-word') }}" class="btn btn-primary bg-dark">Back to Word List</a>
            <a class="navbar-brand ms-auto" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    {{-- Card --}}
    <div class="card shadow-sm rounded">
        <div class="card-header bg-dark text-white text-center">
            <h2 class="mb-0">Add New Word</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('words.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="term" class="form-label fw-semibold">Term</label>
                    <input
                        type="text"
                        class="form-control @error('term') is-invalid @enderror"
                        id="term"
                        name="term"
                        value="{{ old('term') }}"
                        required
                    />
                    @error('term')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="definition" class="form-label fw-semibold">Definition</label>
                    <textarea
                        class="form-control @error('definition') is-invalid @enderror"
                        id="definition"
                        name="definition"
                        rows="4"
                        required
                    >{{ old('definition') }}</textarea>
                    @error('definition')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-success px-4">Save</button>
                    <a href="{{ route('words.index-word') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>
