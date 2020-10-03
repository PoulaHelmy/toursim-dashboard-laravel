<!-- MAIN NAV BAR-->
<header>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            {{--            <li class="nav-item d-none d-sm-inline-block">--}}
            {{--                <a href="index3.html" class="nav-link">Home</a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item d-none d-sm-inline-block">--}}
            {{--                <a href="#" class="nav-link">Contact</a>--}}
            {{--            </li>--}}
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Languages Dropdown Menu -->
        @if(count(config('translatable.locales'))>1)
            <!-- Language Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-globe"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                </li>
        @endif
        <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">

                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img src="{{ asset(auth()->user()->image_path) }}" class="elevation-2 img-circle"
                         alt="User Image" width="30px;" height="30px;">
                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset(auth()->user()->image_path) }}" class="img-size-50 mr-3 img-circle"
                                 alt="User Image">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ auth()->user()->name }}
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">@lang('site.logout')</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>
            {{--            <!-- Notifications Dropdown Menu -->--}}
            {{--            <li class="nav-item dropdown">--}}
            {{--                <a class="nav-link" data-toggle="dropdown" href="#">--}}
            {{--                    <i class="far fa-bell"></i>--}}
            {{--                    <span class="badge badge-warning navbar-badge">15</span>--}}
            {{--                </a>--}}
            {{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
            {{--                    <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
            {{--                    <div class="dropdown-divider"></div>--}}
            {{--                    <a href="#" class="dropdown-item">--}}
            {{--                        <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
            {{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
            {{--                    </a>--}}
            {{--                    <div class="dropdown-divider"></div>--}}
            {{--                    <a href="#" class="dropdown-item">--}}
            {{--                        <i class="fas fa-users mr-2"></i> 8 friend requests--}}
            {{--                        <span class="float-right text-muted text-sm">12 hours</span>--}}
            {{--                    </a>--}}
            {{--                    <div class="dropdown-divider"></div>--}}
            {{--                    <a href="#" class="dropdown-item">--}}
            {{--                        <i class="fas fa-file mr-2"></i> 3 new reports--}}
            {{--                        <span class="float-right text-muted text-sm">2 days</span>--}}
            {{--                    </a>--}}
            {{--                    <div class="dropdown-divider"></div>--}}
            {{--                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item">--}}
            {{--                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">--}}
            {{--                    <i class="fas fa-th-large"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
    </nav>
    <!-- /.navbar -->
</header>
<!-- END MAIN NAV BAR-->
