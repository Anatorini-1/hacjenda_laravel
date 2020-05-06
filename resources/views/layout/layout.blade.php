<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet"  href="/css/main.css" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @yield('content')
            
            <div class="links">
                <a href="./home">Home</a>
                <a href="./login">Login</a>
                <a href="./myProfile">Profile</a>
                <a href="./postOffer">Post Offer</a>
                <a href="./recovery">Password Recovery</a>
                <a href="./adminPanel">Admin Panel</a>
                <a href="./test">TEST</a>
            </div>         
          
        </div>
    </body>
</html>
