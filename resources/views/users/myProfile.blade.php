@extends('layouts.app')


@section('content')

    <div class="content">
    <div class="title m-b-md">
        Profil Użytkownika
     <br /> 
     <table class="profile-table">
         <tr>
             <td><img src="/img/profile_pictures/default.png" /></td>
             <td>Typ Konta: {{ Auth::user()->access }} </td>
         </tr>
         <tr>
             <td>Nazwa</td>
             <td>{{ Auth::user()->name }}</td>
         </tr>
         <tr>
             <td>Pełna Nazwa</td>
             <td>{{ Auth::user()->full_name }}</td>
         </tr>
         <tr>
             <td>Email</td>
             <td>{{ Auth::user()->email }}</td>
         </tr>
         <tr>
             <td>Miasto</td>
             <td>{{ Auth::user()->city }}</td>
         </tr>
         <tr>
             <td>Opis</td>
             <td>{{ Auth::user()->desc }}</td>
         </tr>
     </table>

 
    </div>
    
@endsection
        