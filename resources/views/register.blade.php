<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
<form method="POST" action="{{ url('register') }}" enctype="multipart/form-data" class="p-3">
    @csrf
    <div class="form-group mb-3">
        <label for="nama" class="form-label">Name</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter your name" required>
    </div>
    <div class="form-group mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
    </div>
    <div class="form-group mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
    </div>
    <div class="form-group mb-3">
        <label for="level_id" class="form-label">Level</label>
        <select name="level_id" id="level_id" class="form-control">
            @foreach ($level_id as $data)
            <option value="{{$data->level_id}}">{{$data->level_nama}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="picture" class="form-label">Profile Picture</label>
        <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>

<!-- Include Bootstrap JS and its dependencies (Optional, for dynamic components) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



{{-- <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nama" placeholder="Name" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="password" required>
    <strong>Level :</strong>
    <select name="level_id" class="form-control">
    @foreach ($level_id as $data)   
    <option value="{{$data->level_id}}">{{$data->level_nama}}</option>
    @endforeach
    </select>
    <input type="file" name="picture" accept="image/*"> 
    
    <button type="submit">Register</button>
</form> --}}
