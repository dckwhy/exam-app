<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ashyilla Course{{ isset($title) ? ' | ' . $title : '' }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo-new.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/logo-new.png') }}" type="image/png">

    {{-- CSS --}}
    @include('layouts.ext-css')
    @stack('css')
    {{-- End CSS --}}

</head>

<body>
    <div id="app">

        {{-- Sidebar --}}
        @include('layouts.sidebar')
        {{-- End Sidebar --}}

        <div id="main" class='layout-navbar'>

            {{-- Navbar --}}
            @include('layouts.navbar')
            {{-- End Navbar --}}

            <div id="main-content" style="min-height: 95vh">

                {{-- Content --}}
                @yield('content')
                {{-- End Content --}}

            </div>
            {{-- Footer --}}
            @include('layouts.footer')
            {{-- End Footer --}}
        </div>
    </div>

    {{-- JS --}}
    @include('layouts.ext-js')
    <script>
        $('#logout').click(function(){
            Swal.fire({
                title: 'Apakah kamu yakin akan keluar ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#FF0000',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#3085d6',
            }).then(function(result) {
                if (result.value) {
                    $('#logout-form').submit();
                }
            })
        })
    </script>
    @stack('js')
    {{-- End JS --}}

</body>

</html>