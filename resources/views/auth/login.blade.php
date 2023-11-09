@vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
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
<div id="app">
    <router-view>
    </router-view>
</div>
