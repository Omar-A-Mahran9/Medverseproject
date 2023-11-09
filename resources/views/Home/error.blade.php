@vite(['resources/css/app.scss', 'resources/js/app.js'])

<nav class="navbar navbar-expand-lg mt-xl-5">
    <div class="container-fluid">
        <button style="float: right !important" class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 justify-content-center align-items-center">

                <li class="nav-item">
                    <a class="nav-link seccolor me-4 res" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link seccolor me-4 res" href="#">About Us</a>
                </li>
                <li class="">
                    <a class="nav-link seccolor me-4 res" href="#">Services</a>
                </li>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/home') }}" class="nav-link me-4 seccolor ">Dashboard</a>
                        @else
                            <div class="d-flex">
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link me-4 ress">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link me-4 ress">Register</a>
                                    </li>
                            </div>
                    @endif
                @endauth
        </div>
        @endif


        </ul>
    </div>
    </div>
</nav>
<div style="margin: auto; padding-top:150px; padding-bottom:100px; background-color:#1D617A">
    <h2 class="text-center text-white">This Page Not Found</h2>
</div>
