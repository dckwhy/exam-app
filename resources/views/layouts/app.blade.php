<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashyilla Course | Login</title>
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/auth.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo-new.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/logo-new.png')}}" type="image/png">
    <style>
        .btn-primary {
            background-color: #435ebe !important;
        }

        .btn-primary:hover {
            background-color: #40549d !important
        }

        .bg-primary {
            background-color: #435ebe !important;
        }
    </style>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                @yield('content')
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>