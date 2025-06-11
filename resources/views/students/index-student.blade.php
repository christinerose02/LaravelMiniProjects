<!DOCTYPE html>
<html>
<head>
    <title>Student Registration System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .student-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .container{
            width: 150%;
        }
    </style>
</head>
<body>
<div class="container mt-5">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary  bg-dark"  >Back to Mini Projects Page</a>
            <a class="navbar-brand ms-auto" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    {{-- Page Title --}}
    <h2 class="text-center mb-4">Student Registration System</h2>

    {{-- Register Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('students.create-student') }}" class="btn btn-dark">Register New Student</a>

        {{-- Search Form --}}
        <form action="{{ route('students.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search student..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-dark">Search</button>
        </form>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Students Table --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>Photo</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Course</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
            <tr>
                <td class="text-center">
                    @if($student->photo)
                        <img src="{{ asset('storage/' . $student->photo) }}" class="student-img" alt="Photo">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->course }}</td>
                <td class="text-center">
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No students registered.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
