@vite(['resources/css/app.scss', 'resources/js/app.js'])
@if (Auth::check())
    <script>
        window.Laravel = {!! json_encode([
            'isLoggedin' => true,
            'user' => Auth::user(),
        ]) !!}
    </script>
@else
    <script>
        window.Laravel = {!! json_encode([
            'isLoggedin' => false,
        ]) !!}
    </script>
@endif
{{-- @vite(['resources/css/app.scss', 'resources/js/app.js','resources/css/app.css']) --}}

{{-- <section>
    <div class="shap"></div>

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
</section> --}}
<style scoped>
    section {
        position: relative;
    }

    .res {
        border-radius: 25px;
        font-size: 15px !important;
        color: #054a68 !important;
        border: none !important;
    }

    .shap {
        top: -150px;
        left: 0;
        position: absolute;
        width: 338px;
        height: 394px;
        transform: rotate(90deg);
        flex-shrink: 0;

        background: #65c5b9;
        opacity: 0.3;
        filter: blur(60px);
    }

    .ress {
        background-color: #054a68 !important;
        color: white !important;
        border-radius: 10px;
        width: 90px;
        text-align: center;
    }

    @media only screen and (max-width: 991px) {
        .botto {
            width: 150px;
            margin: 10px;
        }

        .res {
            margin-left: 20px;
            margin-bottom: 6px;
            border: none !important;
            font-size: 20px !important;
        }

        .ress {
            margin-bottom: 10px;
        }
    }
</style>
<div id="app">

    <router-view>
    </router-view>

</div>
