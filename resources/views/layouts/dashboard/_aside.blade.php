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
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasRole('super_admin'))
                    <li class="nav-item">
                        <a href="http://tour.devel/laratrust" class=" nav-link">
                            <i class="fas fa-fingerprint"></i>
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
                                Destinations
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('destinations.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>ALL Destinations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('destinations.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add New Destination</p>
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
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>ALL Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add New Categories</p>
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
                                Packages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('packages.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>ALL Packages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('packages.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add New Packages</p>
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
                                Excursions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('excursions.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>ALL Excursions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('excursions.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add New Excursions</p>
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
                                Hotels
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('hotels.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>ALL Hotels</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('hotels.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add New Hotels</p>
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
                                Plans
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('plans.index')}}" class="nav-link ">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>ALL Plans</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('plans.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add New Plans</p>
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
