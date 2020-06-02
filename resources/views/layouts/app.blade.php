<!doctype html>
@php
    use Illuminate\Support\Facades\Auth;
    use App\User;
    use App\Offer;
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Home TaskForce</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="application/javascript" src="/js/script.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- CSS only -->

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   
</head>
<body>
      <div class="cointainer-fluid">
    
        <header>
          <nav class="navbar navbar-light  navbar-expand-md" style='background-color:#ffc107 !important'>
            <a class="navbar-brand" href="/"><img id="logo" src="/img/logo.png" class="d-inline-block mr-1 align-bottom"
                alt="">Hacjenda</a>
    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu"
              aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
              <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="mainmenu">
              <ul class="navbar-nav">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="/users/myProfile">Mój Profil</a>
                  </li>
                @endauth
                
    
                <li class="nav-item">
                  <a class="nav-link" href="/offers/create">Stwórz ofertę</a>
                </li>
    
                <li class="nav-item">
                  <a class="nav-link" href="/offers">Oferty</a>
                </li>
    
                <li class="nav-item">
                  <a class="nav-link" href="/offers/finished">Zakończone Oferty</a>
                </li>
    
                <li class="nav-item">
                  <a class="nav-link" href="uzytkownicy.html">Użytkownicy</a>
                </li>
                @guest
                <li class="nav-item login">
                    <a class="nav-link" href="/login">Zaloguj się</a>
                  </li>
                  
                  <li class="nav-item rejestracja">
                    <a class="nav-link" href="/register">Zarejestruj się</a>
                  </li>
                  
                @endguest
                </ul>
                @auth
                    
              
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/users/myProfile">
                            Mój Profil
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                
              </ul>
              @endauth
            </div>
          </nav>
        </header>
        @yield('content')
       
      </div>
    
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
      <div class="container text-center">
        <small>Copyright &copy; Hacjenda company</small>
      </div>
    </footer>
    
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
     
    
    </body>
    
    </html>
    
