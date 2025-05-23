
@if(Auth::check())
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="img/favicon.svg" />

    <!-- Title -->
    <title>Best Admin Templates - Admin Dashboard</title>


    <!-- *************
        ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{asset('frontend/assets/fonts/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap/bootstrap-icons.css')}}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/OverlayScroll.min.css')}}">


    <!-- *************
        ************ Vendor Css Files *************
    ************ -->

</head>

<body>

<!-- Loading starts -->

<!-- Loading ends -->

<!-- Page wrapper start -->
<div class="page-wrapper">

    <!-- Sidebar wrapper start -->
    <nav id="sidebar" class="sidebar-wrapper">

        <!-- Sidebar brand start  -->
        <div class="sidebar-brand">
            <a href="index.html" class="logo">
                <img src="{{asset('frontend/assets/img/logo.svg')}}" alt="Admin Dashboards" />
            </a>
        </div>
        <!-- Sidebar brand end  -->

        <!-- User profile start -->
        <div class="sidebar-user-details">
            <div class="user-profile">
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="profile-thumb" alt="Admin Dashboards">
                <h6 class="profile-name">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h6>
                <ul class="profile-actions">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="icon-gitlab"></i>
                            <span class="count-label green"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="icon-twitter1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="login.html">
                            <i class="icon-exit_to_app"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- User profile end -->

        <!-- Sidebar content start -->
        <div class="sidebar-content">

            <!-- sidebar menu start -->
            <div class="sidebar-menu">
                <ul>
                    <li class="active">
                        <a href="{{ route('dashboard') }}" class="current-page">
                            <i class="bi bi-house"></i>
                            <span class="menu-text">Admin Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i> <!-- Changed icon class -->
                            <span class="menu-text">Users</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('customers.index') }}">
                            <i class="bi bi-person"></i>
                            <span class="menu-text">Customers</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('categories.index') }}">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            <span class="menu-text">Categories</span>
                        </a>

                    </li>
                    <li class="">
                        <a href="{{ route('products.index') }}">
                            <i class="bi bi-cart3"></i>
                            <span class="menu-text">Products</span>
                        </a>

                    </li>
                    <li class="">
                        <a href="{{ route('orders.index') }}">
                            <i class="bi bi-file-earmark-text"></i>
                            <span class="menu-text">Orders</span>
                        </a>

                    </li>

                </ul>
            </div>
            <!-- sidebar menu end -->

        </div>
        <!-- Sidebar content end -->

    </nav>
    <!-- Sidebar wrapper end -->

    <!-- Page content start  -->
    <div class="page-content">

        <!-- Main container start -->
        <div class="main-container">

            <!-- Header start -->
            <header class="header">
                <div class="toggle-btns">
                    <a id="toggle-sidebar" href="#">
                        <i class="icon-list"></i>
                    </a>
                    <a id="pin-sidebar" href="#">
                        <i class="icon-list"></i>
                    </a>
                </div>
                <div class="header-items">
                    <!-- Custom search start -->
                    <div class="custom-search">
                        <input type="text" class="search-query" placeholder="Search here ...">
                        <i class="icon-search1"></i>
                    </div>
                    <!-- Custom search end -->

                    <!-- Header actions start -->
                    <ul class="header-actions">
                        <li class="dropdown">
                            <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                                <i class="icon-bell"></i>
                                <span class="count-label">8</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                                <div class="dropdown-menu-header">
                                    Notifications (40)
                                </div>
                                <ul class="header-notifications">
                                    <li>
                                        <a href="#">
                                            <div class="user-img away">
                                                <img src="img/user10.png" alt="Bootstrap Admin Panel">
                                            </div>
                                            <div class="details">
                                                <div class="user-title">Abbott</div>
                                                <div class="noti-details">Membership has been ended.</div>
                                                <div class="noti-date">Today, 07:30 pm</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-img busy">
                                                <img src="img/user10.png" alt="Admin Panel">
                                            </div>
                                            <div class="details">
                                                <div class="user-title">Braxten</div>
                                                <div class="noti-details">Approved new design.</div>
                                                <div class="noti-date">Today, 12:00 am</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user-img online">
                                                <img src="img/user6.png" alt="Admin Template">
                                            </div>
                                            <div class="details">
                                                <div class="user-title">Larkyn</div>
                                                <div class="noti-details">Check out every table in detail.</div>
                                                <div class="noti-date">Today, 04:00 pm</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown selected">
                            <a href="#" id="userSettings" data-toggle="dropdown" aria-haspopup="true">
                                <i class="icon-user1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                                <div class="header-profile-actions">
                                    <div class="header-user-profile">
                                        <div class="header-user">
                                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Admin Template">
                                        </div>
                                        <h5>{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h5>
                                        <p>
                                            @foreach(Auth::user()->roles as $role)
                                                {{ $role->name }}
                                                @if(!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>

                                    <a href="user-profile.html" ><i class="icon-user1"></i> My Profile</a>
                                    <a href="account-settings.html"><i class="icon-settings1"></i> Account Settings</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" style="border: none; background: none;">
                                            <i class="icon-log-out1"></i> Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li class="balance">
                            <h6>Balance</h6>
                            <h3>$25,700</h3>
                        </li>
                    </ul>
                    <!-- Header actions end -->
                </div>
            </header>
            <!-- Header end -->

            <!-- Page header start -->
            <div class="page-header">

                <!-- Breadcrumb start
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Admin Dashboard</li>
                </ol> -->
                <!-- Breadcrumb end -->

                <!-- App actions start
                <ul class="app-actions">
                    <li>
                        <a href="#">
                            <i class="icon-export"></i> Export
                        </a>
                    </li>
                </ul>
                -->
                <!-- App actions end -->

            </div>
            <!-- Page header end -->

            @yield('content')
        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<!--**************************
    **************************
        **************************
                    Required JavaScript Files
        **************************
    **************************
**************************-->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/moment.js')}}"></script>


<!-- *************
    ************ Vendor Js Files *************
************* -->
<!-- Slimscroll JS -->
<script src="{{asset('frontend/assets/vendor/slimscroll/slimscroll.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/slimscroll/custom-scrollbar.js')}}"></script>

<!-- Polyfill JS -->
<script src="{{asset('frontend/assets/vendor/polyfill/polyfill.min.js')}}"></script>

<!-- Apex Charts -->
<script src="{{asset('frontend/assets/vendor/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/apex/custom/home/lineRevenueGradientGraph.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/apex/custom/home/radialTasks.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/apex/custom/home/line-graph1.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/apex/custom/home/line-graph2.js')}}"></script>

<!-- Peity Charts -->
<script src="{{asset('frontend/assets/vendor/peity/peity.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/peity/custom-peity.js')}}"></script>


<!-- Main JS -->
<script src="{{asset('frontend/assets/js/main.js')}}"></script>
<script src="{{asset('frontend/assets/js/product.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.overlayScrolls.min.js')}}"></script>

</body>

</html>
@endif
