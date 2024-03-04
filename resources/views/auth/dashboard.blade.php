@extends('layout')

@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-user"></i>
                </div>
                <div class="sale-num">
                    <h2>{{ $totalCustomers }}</h2>
                    <p>Customers</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-male"></i>
                </div>
                <div class="sale-num">
                    <h2>{{ $maleCustomersCount }}</h2>
                    <p>Male Customers</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-user-female"></i>
                </div>
                <div class="sale-num">
                    <h2>{{ $femaleCustomersCount }}</h2>
                    <p>Female Customers</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-box"></i>
                </div>
                <div class="sale-num">
                    <h2>{{ $totalProducts }}</h2>
                    <p>Products</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Revenue</div>
                </div>
                <div class="card-body">
                    <div class="graph-status-right">
                        <div class="graph-status primary">
                            <div class="status-icon">
                                <i class="icon-arrow-down"></i>
                            </div>
                            <div class="status-info">
                                <div class="status-title">Today's Income</div>
                                <div class="percentage">$4575.00</div>
                            </div>
                        </div>
                        <div class="graph-status secondary">
                            <div class="status-icon">
                                <i class="icon-arrow-up"></i>
                            </div>
                            <div class="status-info">
                                <div class="status-title">Last Week Income</div>
                                <div class="percentage">+20.50%</div>
                            </div>
                        </div>
                    </div>
                    <div id="lineRevenueGraph"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection
