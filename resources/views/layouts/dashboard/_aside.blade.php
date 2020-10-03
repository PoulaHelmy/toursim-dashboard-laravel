<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dashboard_files/img/images.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Poula Tours</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Poula Helmy</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('welcome')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('site.dashboard')
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasRole('super_admin'))
                    <li class="nav-item has-treeview">
                        <a href="http://tour.devel/laratrust" class=" nav-link">
                            <i class="fas fa-fingerprint"></i>
                            <p>
                                @lang('site.users_control')
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_users'))
                    <li class="nav-item has-treeview">
                        <a href="{{ route('users.index') }}" class=" nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                @lang('site.users_control')
                            </p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_destination'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-paper-plane"></i>
                            <p>
                                @lang('site.destinations')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('destinations.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p> @lang('site.alldestinations')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('destinations.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>@lang('site.adddestination')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_categories'))
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-network-wired"></i>
                            <p>
                                @lang('site.categories')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>@lang('site.allcategory')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>@lang('site.addcategory')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_packages'))
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-suitcase"></i>
                            <p>
                                @lang('site.packages')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('packages.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>@lang('site.allpackages')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('packages.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>@lang('site.addpackages')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_excursions'))
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-umbrella"></i>
                            <p>
                                @lang('site.excursions')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('excursions.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>@lang('site.allexcursions')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('excursions.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>@lang('site.addexcursions')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_hotels'))
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-hotel"></i>
                            <p>
                                @lang('site.hotels')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('hotels.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>@lang('site.allhotel')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('hotels.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>@lang('site.addhotel')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('read_plans'))
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-money-check-alt"></i>
                            <p>
                                @lang('site.plans')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('plans.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>@lang('site.allplans')</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('plans.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>@lang('site.addplans')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
