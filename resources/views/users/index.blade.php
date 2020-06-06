@extends('layouts.app')

@section('content')
<main>

     <p style='text-align:center; font-size:4rem'>
        Najlepsi Wykonawcy
    </p>
    <div class="row">
        @foreach ($users as $user)
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 uzytkownik">
            <img src="/img/profile_pictures/default.png" class="uzytkownik2">
        <p>Nazwa:&nbsp;{{$user['user']->name}}<p>
        <p>Ilość wykonanych ofert:&nbsp;{{$user['finished']}}<p>
        <p>Średnia ocena:&nbsp;{{$user['avg']}}<p>
            
            
            
          </div>
        @endforeach
      
    </div>

    

    
    
    
  </main>
@endsection