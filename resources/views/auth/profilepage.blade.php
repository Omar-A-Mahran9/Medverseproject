@vite(['resources/css/appfront.css', 'resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>;
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
