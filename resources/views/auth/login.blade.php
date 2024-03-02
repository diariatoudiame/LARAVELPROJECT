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
    <title>Best Admin Templates - Login</title>

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

    <form action="{{ route('auth.store') }}" method="POST">
        @csrf
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="#" class="login-logo">
                            <img src="{{asset('frontend/assets/img/logo.svg')}}" alt="Admin Dashboards" />
                        </a>
                        <h5>Welcome back,<br />Please Login to your Account.</h5>
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                        </div>
                        <div class="actions mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember_pwd">
                                <label class="custom-control-label" for="remember_pwd">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="forgot-pwd">
                            <a class="link" href="forgot-pwd.html">Forgot password?</a>
                        </div>
                        <hr>
                        <div class="actions align-left">
                            <span class="additional-link">New here?</span>
                            <a href="signup.html" class="btn btn-secondary">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Container end -->

</body>

</html>
