<!DOCTYPE html>
<html>
<head>
    <title>Mini CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary  bg-dark"  >Back to Mini Projects Page</a>
            <a class="navbar-brand" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>
    <h2>Posts with CRUD</h2>
    <a href="{{ url('/posts/create') }}" class="btn btn-dark mb-3">Create New Post</a>
    <table class="table table-bordered">
        <tr><th>Title</th><th>Content</th><th>Actions</th></tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->content }}</td>
            <td>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
