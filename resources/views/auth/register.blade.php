<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{asset('frontend/assets/img/logo.svg')}}" />

    <!-- Title -->
    <title>Best Admin Templates - Register</title>

    <!-- *************
        ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}" />

    <!-- Master CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}" />

</head>

<body class="authentication">

<!-- Container start -->
<div class="container">

    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="#" class="login-logo">
                            <img src="{{asset('frontend/assets/img/logo.svg')}}" alt="Admin Dashboards" />
                        </a>
                        <h5>Welcome, <br />Create your Account.</h5>
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" />
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" />
                            @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="file" name="photo" id="photo" class="form-control"  />
                            @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="role_id" value="2">
                        <div class="actions mb-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Container end -->

</body>

</html>
