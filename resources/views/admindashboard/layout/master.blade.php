<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Med-verse</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="hold-transition sidebar-mini">

    @if (Auth::check())
        <script>
            window.Laravel = {!! json_encode([
                'isLoggedin' => true,
                'user' => Auth::user(),
                'format' => $allsetting[2]->value,
            ]) !!}
        </script>
    @else
        <script>
            window.Laravel = {!! json_encode([
                'isLoggedin' => false,
            ]) !!}
        </script>
    @endif
    <div class="wrapper" id="app">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                    {{-- </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar  elevation-4" style="background-color:#283342;">

            <a href="/profile" class="brand-link text-center">
                <img src="/img/Logo.png" alt="Med-Verse" width='40' class="elevation-0 mb-2" style="">
                <span class="brand-text  " style="color: white; font-weight:bold; font-size:160%"> med-verse</span>
            </a>

            <div class="sidebar">
                @if (Auth::user()->Package_id != 3 && Auth::user()->Package_id != 1)
                    <router-link :to={name:'admin.profile'} active-class='active' class="nav-link" style="color: white">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                            @if (auth()->user()->image)
                                <div class="image">
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                        class="img elevation-2 rounded" alt="User Image">
                                </div>
                            @endif
                            <div class="info">
                                <a href="#" class="d-block" style="color: white"> {{ auth()->user()->name }}</a>
                                <a href="#" class="d-block" style="color: #FED600; font-size:12px">
                                    {{ auth()->user()->role }}</a>
                            </div>
                        </div>
                    </router-link>
                @else
                    <div active-class='active' class="nav-link" style="color: white">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                            @if (auth()->user()->image)
                                <div class="image">
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                        class="img elevation-2 rounded" alt="User Image">
                                </div>
                            @endif
                            <div class="info">
                                <a href="#" class="d-block" style="color: white"> {{ auth()->user()->name }}</a>
                                <a href="#" class="d-block" style="color: #FED600; font-size:12px">
                                    {{ auth()->user()->role }}</a>
                            </div>
                        </div>
                    </div>

                @endif

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (auth()->user()->role == 'USER')
                            <li class="nav-item">
                                <router-link :to={name:'admin.dashboard'} active-class='active' class="nav-link"
                                    style="color: white">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Home
                                    </p>
                                </router-link>
                            </li>
                        @endif

                        @if (auth()->user()->role == 'ADMIN')
                            <li class="nav-item">
                                <router-link :to={name:'admin.users'} active-class='active' class="nav-link"
                                    style="color: white">

                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Users
                                    </p>
                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'USER')
                            <li class="nav-item">
                                <router-link :to={name:'admin.inventory'} active-class='active' class="nav-link"
                                    style="color: white">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Inventory
                                    </p>

                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'USER' || auth()->user()->role == 'SUPPLIER')
                            <li class="nav-item">
                                <router-link :to={name:'admin.myrequest'} active-class='active' class="nav-link"
                                    style="color: white">
                                    <i class="nav-icon  fas fa-keyboard"></i>
                                    <p>
                                        My Request
                                        <span class="float-right badge badge-danger "
                                            style="border-radius:50%;color:#dc3545 ">..</span>
                                    </p>

                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'USER')
                            <li class="nav-item">
                                <router-link :to={name:'admin.customerervice'} active-class='active' class="nav-link"
                                    style="color: white">
                                    <i class="nav-icon fas fa-user"></i>

                                    <p>
                                        Customer Service
                                    </p>

                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'ADMIN')
                            <li class="nav-item">
                                <router-link :to={name:'admin.orders'} active-class='active' class="nav-link"
                                    style="color: white">

                                    <i class="nav-icon fas fa-border-all"></i>
                                    <p>
                                        Orders
                                    </p>
                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'ADMIN')
                            <li class="nav-item">
                                <router-link :to={name:'admin.comments'} active-class='active' class="nav-link"
                                    style="color: white">

                                    <i class="nav-icon fas fa-water"></i>
                                    <p>
                                        All coments
                                    </p>
                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'USER')
                            <li class="nav-item">
                                <router-link :to={name:'admin.reports'} active-class='active' class="nav-link"
                                    style="color: white">
                                    <i class="nav-icon fas fa-chart-line"></i>

                                    <p>
                                        Reports </p>

                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'USER' || auth()->user()->role == 'ADMIN')
                            <li class="nav-item">
                                <router-link :to={name:'admin.newrequest'} active-class='active' class="nav-link"
                                    style="color: white">
                                    <i class="nav-icon fas fa-flag"></i>
                                    <p>
                                        New Request </p>

                                </router-link>
                            </li>
                        @endif
                        @if (auth()->user()->role == 'ADMIN')
                            <li class="nav-item">
                                <router-link :to={name:'admin.setting'} active-class='active' class="nav-link"
                                    style="color: white">

                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Setting
                                    </p>
                                </router-link>
                            </li>
                        @endif
                        <li class="nav-item">
                            <router-link :to={name:'admin.events'} active-class='active' class="nav-link"
                                style="color: white">

                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Upcoming Events </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to={name:'admin.sessions'} active-class='active' class="nav-link"
                                style="color: white">

                                <i class="nav-icon fas fa-fire"></i>
                                <p>
                                    Book Consultant
                                    Session </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to={name:'admin.appointment'} active-class='active' class="nav-link"
                                style="color: white">

                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    My Appointment
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="nav-link">

                                @csrf
                                <a href="#" onclick="event.preventDefault();  this.closest('form').submit();"
                                    style="color: white">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout </p>
                                </a>
                            </form>

                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <router-view></router-view>
        </div>


        <aside class="control-sidebar control-sidebar-dark">

            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; 2023-2024 <a
                    href="https://www.linkedin.com/in/omar-a-mahran/">Omar_A_Mahran</a>.</strong> All rights
            reserved.
        </footer>
    </div>




    <style>
        .nav-item .active {
            background-color: #009099 !important;
        }
    </style>
</body>

</html>
