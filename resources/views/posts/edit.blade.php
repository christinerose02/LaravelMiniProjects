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
            <a href="{{ route('posts.index') }}" class="btn btn-primary bg-dark">Back to Posts List</a>
            <a class="navbar-brand" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    {{-- Card --}}
    <div class="card shadow-sm rounded">
        <div class="card-header bg-dark text-white text-center">
            <h2 class="mb-0">{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST">
                @csrf
                @if(isset($post)) @method('PUT') @endif

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $post->title ?? '') }}"
                        required
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label fw-semibold">Content</label>
                    <textarea
                        name="content"
                        id="content"
                        class="form-control @error('content') is-invalid @enderror"
                        rows="5"
                        required
                    >{{ old('content', $post->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">{{ isset($post) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary px-5">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
