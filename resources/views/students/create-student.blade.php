<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
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
            width: 90%;
            max-width: 900px;
        }
        .student-photo {
            max-width: 150px;
            max-height: 150px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/mini-project-page" class="btn btn-primary  bg-dark">Back to Mini Projects Page</a>
            <a href="{{ route('students.index-student') }}" class="btn btn-primary  bg-dark">Back to Student's List</a>
            <a class="navbar-brand" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    {{-- Card --}}
    <div class="card shadow-sm rounded">
        <div class="card-header bg-dark text-white text-center">
            <h2 class="mb-0">{{ isset($student) ? 'Edit Student' : 'Register New Student' }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($student)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Course</label>
                    <input type="text" name="course" class="form-control" value="{{ old('course', $student->course ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Photo</label>
                    <input type="file" name="photo" class="form-control" {{ isset($student) ? '' : 'required' }}>
                    @if(isset($student) && $student->photo)
                        <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" class="student-photo">
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">
                        {{ isset($student) ? 'Update' : 'Register' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
