@extends('layouts.dashboard.app')

@section('content')
    <!-- Main content -->
    <section class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@lang('site.maindashboard')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('welcome')}}">@lang('site.home')</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content my-4">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- /.col ALL Packages -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                 <a href="{{ route('packages.index') }}">
                                <i
                                    class="nav-icon fas fa-suitcase"></i></a></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allpackages')</span>
                                <span class="info-box-number">
                                    {{$all_pkgs}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col ALL Categories -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1">
                             <a href="{{ route('excursions.index') }}">
                            <i
                                class="nav-icon fas fa-umbrella"></i></a>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allexcursions') </span>
                                <span class="info-box-number">{{$all_excursions}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                    <!-- ALL Categories -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                 <a href="{{ route('categories.index') }}">
                                <i
                                    class="nav-icon fas fa-network-wired"></i></a>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allcategory')</span>
                                <span class="info-box-number">{{$all_cats}} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col  ALL Destinations-->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">
                                  <a href="{{ route('destinations.index') }}">
                                <i
                                    class="nav-icon fas fa-paper-plane"></i></a></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.alldestinations')</span>
                                <span class="info-box-number">{{$all_destinations}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Info boxes -->
                <div class="row">
                    <!-- /.col ALL EXCURIONS -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                  <a href="#">
                                      <i class="fas fa-cog"></i></a>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allpages')</span>
                                <span class="info-box-number">
                                    10
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col ALL Hotels -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1">  <a
                                    href="{{ route('hotels.index') }}"> <i
                                        class="nav-icon fas fa-hotel"></i></a></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allhotel')</span>
                                <span class="info-box-number">{{$all_hotels}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                    <!-- ALL Destinations -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                <a href="{{ route('plans.index') }}">  <i class="fas fa-money-check-alt"></i></a>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allplans')</span>
                                <span class="info-box-number">{{$all_plans}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col  ALL USERS-->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">

                                  <a href="http://tour.devel/laratrust">
                                      <i class="fas fa-users"></i></a></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.allusers')</span>
                                <span class="info-box-number">{{$all_users}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- CHARTS -->
                {{--                <div class="row">--}}
                {{--                    <div class="col-md-6">--}}
                {{--                        <!-- USERS CHART -->--}}
                {{--                        <div class="card card-warning">--}}
                {{--                            <div class="card-header">--}}
                {{--                                <h3 class="card-title">USERS Chart</h3>--}}
                {{--                                <div class="card-tools">--}}
                {{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i--}}
                {{--                                            class="fas fa-minus"></i>--}}
                {{--                                    </button>--}}
                {{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i--}}
                {{--                                            class="fas fa-times"></i></button>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="card-body">--}}
                {{--                                <canvas id="usersChart"--}}
                {{--                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.card-body -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.card -->--}}
                {{--                    </div>--}}
                {{--                    <div class="col-md-6">--}}


                {{--                        <!-- PIE CHART -->--}}
                {{--                        <div class="card card-danger">--}}
                {{--                            <div class="card-header">--}}
                {{--                                <h3 class="card-title">Pie Chart</h3>--}}

                {{--                                <div class="card-tools">--}}
                {{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i--}}
                {{--                                            class="fas fa-minus"></i>--}}
                {{--                                    </button>--}}
                {{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i--}}
                {{--                                            class="fas fa-times"></i></button>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="card-body">--}}
                {{--                                <canvas id="pieChart"--}}
                {{--                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.card-body -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.card -->--}}

                {{--                    </div>--}}

                {{--                </div>--}}


            </div>
        </div>
    </section>

@endsection
@push('scripts')
    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            /* ChartJS--}}
    {{--             * ---------}}
    {{--             * Here we will create a few charts using ChartJS--}}
    {{--             */--}}


    {{--            //---------------}}
    {{--            //- DONUT CHART ---}}
    {{--            //---------------}}
    {{--            // Get context with jQuery - using jQuery's .get() method.--}}
    {{--            var usersChartCanvas = $('#usersChart').get(0).getContext('2d')--}}
    {{--            var usersData = {--}}
    {{--                labels: [--}}
    {{--                    'AllUsers',--}}
    {{--                    'Role',--}}
    {{--                    'Permission',--}}
    {{--                    'Admins',--}}
    {{--                ],--}}
    {{--                datasets: [--}}
    {{--                    {--}}
    {{--                        data: [{{$all_users}},{{$all_roles}}, 400, 600],--}}
    {{--                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],--}}
    {{--                    }--}}
    {{--                ]--}}
    {{--            }--}}
    {{--            var usersOptions = {--}}
    {{--                maintainAspectRatio: false,--}}
    {{--                responsive: true,--}}
    {{--            }--}}
    {{--            //Create pie or douhnut chart--}}
    {{--            // You can switch between pie and douhnut using the method below.--}}
    {{--            var donutChart = new Chart(usersChartCanvas, {--}}
    {{--                type: 'doughnut',--}}
    {{--                data: usersData,--}}
    {{--                options: usersOptions--}}
    {{--            })--}}

    {{--            //---------------}}
    {{--            //- PIE CHART ---}}
    {{--            //---------------}}
    {{--            // Get context with jQuery - using jQuery's .get() method.--}}
    {{--            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')--}}
    {{--            var pieData = donutData;--}}
    {{--            var pieOptions = {--}}
    {{--                maintainAspectRatio: false,--}}
    {{--                responsive: true,--}}
    {{--            }--}}
    {{--            //Create pie or douhnut chart--}}
    {{--            // You can switch between pie and douhnut using the method below.--}}
    {{--            var pieChart = new Chart(pieChartCanvas, {--}}
    {{--                type: 'pie',--}}
    {{--                data: pieData,--}}
    {{--                options: pieOptions--}}
    {{--            })--}}

    {{--            //---------------}}
    {{--            //- BAR CHART ---}}
    {{--            //---------------}}
    {{--            var barChartCanvas = $('#barChart').get(0).getContext('2d')--}}
    {{--            var barChartData = jQuery.extend(true, {}, areaChartData)--}}
    {{--            var temp0 = areaChartData.datasets[0]--}}
    {{--            var temp1 = areaChartData.datasets[1]--}}
    {{--            barChartData.datasets[0] = temp1--}}
    {{--            barChartData.datasets[1] = temp0--}}

    {{--            var barChartOptions = {--}}
    {{--                responsive: true,--}}
    {{--                maintainAspectRatio: false,--}}
    {{--                datasetFill: false--}}
    {{--            }--}}

    {{--            var barChart = new Chart(barChartCanvas, {--}}
    {{--                type: 'bar',--}}
    {{--                data: barChartData,--}}
    {{--                options: barChartOptions--}}
    {{--            })--}}


    {{--        })--}}
    {{--    </script>--}}
@endpush
{{--<div class="row">--}}
{{--    <div class="col-md-6">--}}


{{--        <!-- DONUT CHART -->--}}
{{--        <div class="card card-danger">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">Donut Chart</h3>--}}

{{--                <div class="card-tools">--}}
{{--                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i--}}
{{--                            class="fas fa-minus"></i>--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i--}}
{{--                            class="fas fa-times"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <canvas id="donutChart"--}}
{{--                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}

{{--    </div>--}}
{{--    <div class="col-md-6">--}}


{{--        <!-- PIE CHART -->--}}
{{--        <div class="card card-danger">--}}
{{--            <div class="card-header">--}}
{{--                <h3 class="card-title">Pie Chart</h3>--}}

{{--                <div class="card-tools">--}}
{{--                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i--}}
{{--                            class="fas fa-minus"></i>--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i--}}
{{--                            class="fas fa-times"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <canvas id="pieChart"--}}
{{--                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--        </div>--}}
{{--        <!-- /.card -->--}}

{{--    </div>--}}

{{--</div>--}}
