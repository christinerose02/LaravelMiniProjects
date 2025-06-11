<!DOCTYPE html>
<html>
<head>
    <title>Mini Dictionary System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            width: 150%;
        }
    </style>
</head>
<body>
<div class="container mt-5">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary bg-dark">Back to Mini Projects Page</a>
            <a class="navbar-brand ms-auto" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    {{-- Page Title --}}
    <h2 class="text-center mb-4">Mini Dictionary System</h2>

    {{-- Top Controls --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('words.create-word') }}" class="btn btn-dark">Add New Word</a>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('words.index-word') }}" class="d-flex" role="search">
            <input
                class="form-control me-2"
                type="search"
                name="search"
                placeholder="Search terms or definitions..."
                value="{{ request('search') }}"
            />
            <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Words Table --}}
    @if($words->count())
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>Term</th>
                <th>Definition</th>
                <th style="width: 130px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($words as $word)
            <tr>
                <td>{{ $word->term }}</td>
                <td>{{ $word->definition }}</td>
                <td class="text-center">
                    <a href="{{ route('words.edit-word', $word) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                    <form action="{{ route('words.destroy', $word) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this word?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $words->withQueryString()->links() }}
    </div>

    @else
    <p class="text-muted text-center">No words found.</p>
    @endif

</div>
</body>
</html>
