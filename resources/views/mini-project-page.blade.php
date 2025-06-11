<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home - Parsers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-container {
            max-width: 800px;
            margin-top: 10%;
            margin: 40px auto;
            padding: 30px 25px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgb(0 0 0 / 0.1);
        }
        .btn-custom {
            min-width: 180px;
            margin: 10px 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: #fff;
            box-shadow: 0 5px 10px rgb(0 86 179 / 0.4);
        }
        @media (max-width: 576px) {
            .btn-custom {
                width: 100%;
                margin: 8px 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="/home" class="btn btn-primary bg-dark">Back to Home</a>
            <a class="navbar-brand ms-auto" href="#">CHRISTINE ROSE APOSTOL LLORANDO</a>
        </div>
    </nav>

    <div class="main-container text-center">
        <h1 class="display-4 mb-4">Christine's Laravel Mini Projects</h1>

        <div class="d-flex flex-wrap justify-content-center">


            <a href="/index" class="btn btn-primary btn-custom">Post with CRUD</a>
            <a href="/index-student" class="btn btn-primary btn-custom">Register a Student</a>
            <a href="/index-word" class="btn btn-primary btn-custom">Mini Dictionary</a>            
            <!-- <a href="/chat" class="btn btn-primary btn-custom">Join Chat</a>             -->
        
            <!-- <a href="/home" class="btn btn-primary btn-custom">Mini Calculator</a> -->
        </div>
    </div>
</body>
</html>
