@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 110%;
    }
    body {
        background: #f8f9fa;
    }
    .form-container {
        width: 90%;
        max-width: 900px;
        margin: auto;
        padding-top: 20px;
    }
</style>

<div class="form-container">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary bg-dark">Back to Mini Projects Page</a>
            <a href="{{ route('words.index-word') }}" class="btn btn-primary bg-dark">Back to Words List</a>
            <a class="navbar-brand" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    {{-- Card --}}
    <div class="card shadow-sm rounded">
        <div class="card-header bg-dark text-white text-center">
            <h2 class="mb-0">Edit Word</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('words.update', $word) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="term" class="form-label fw-semibold">Term</label>
                    <input
                        type="text"
                        class="form-control @error('term') is-invalid @enderror"
                        id="term"
                        name="term"
                        value="{{ old('term', $word->term) }}"
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
                    >{{ old('definition', $word->definition) }}</textarea>
                    @error('definition')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">Update</button>
                    <a href="{{ route('words.index-word') }}" class="btn btn-secondary px-5">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
