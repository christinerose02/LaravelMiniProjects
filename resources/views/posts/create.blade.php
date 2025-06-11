<!DOCTYPE html>
<html>
<head>
    <title>Mini CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
  html, body {
    height: 100%;
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

<div class="form-container">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary  bg-dark"  >Back to Mini Projects Page</a>
            <a href="/index" class="btn btn-primary  bg-dark"  >Back to Post with CRUD PAGE</a>
            <a class="navbar-brand" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

  <div class="card shadow-sm rounded">
    <div class="card-header bg-dark text-white text-center">
      <h2 class="mb-0">{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h2>
    </div>
    <div class="card-body">
      <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST" style="width: 100%;">
        @csrf
        @if(isset($post)) @method('PUT') @endif

        <div class="mb-3">
          <label for="title" class="form-label fw-semibold">Title</label>
          <input
            type="text"
            name="title"
            id="title"
            value="{{ $post->title ?? '' }}"
            class="form-control"
            placeholder="Enter post title"
            required
          >
        </div>

        <div class="mb-3">
          <label for="content" class="form-label fw-semibold">Content</label>
          <textarea
            name="content"
            id="content"
            class="form-control"
            rows="5"
            placeholder="Write your post here..."
            required
          >{{ $post->content ?? '' }}</textarea>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-5">
            {{ isset($post) ? 'Update' : 'Save' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>