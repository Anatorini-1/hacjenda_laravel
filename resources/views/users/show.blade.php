@extends('layouts.app')

@section('content')
   
<div class="row">
    <div class="col-md-6 users-show">
        <table class='profile-table'>
            <tr>
                <td colspan="2" style='text-align:center'> 
                    <img src="/img/profile_pictures/{{$data['profile_picture']}}" class='idk_klasa'/><br />
                </td>
            </tr>
            <tr>
                <td>Nazwa</td>
            <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td>Imię i Nazwisko</td>
                <td>{{ $data['full_name'] }}</td>
            </tr>
            <tr>
                <td>Miasto</td>
                <td>{{ $data['city'] }}</td>
            </tr>
            <tr>
                <td>Opis</td>
                <td>{{ $data['desc'] }}</td>
            </tr>
            <tr>
                <td>Ukończone oferty</td>
                <td>{{ $data['finished_offers'] }}</td>
            </tr>
            <tr>
                <td>Obecnie wykonywane oferty</td>
                <td>{{ $data['active_offers'] }}</td>
            </tr>
            
           
        </table>
    </div>

    <div class="col-md-6 users-show">Ostatnie oferty
        @foreach ($offers as $offer)
        <div class="latest-offer">
            <table>
                <tr>
                    <td>Pracodawca</td>
                    <td><a href='/users/show/{{$offer['employer']->id}}'> {{$offer['employer']->name}}</a></td>
                </tr>
                <tr>
                    <td>Data Ukończenia</td>
                    <td>{{$offer['finished']->finished_at}}</td>
                </tr>
                <tr>
                    <td>Ocena</td>

                    <td>@php
                        $x = $offer['opinion']->all();
                           if(sizeof($x)){
                            foreach ($x as $value) {
                               echo($value->ocena);
                            }
                           }
                           else{
                               echo '-';
                           } ;
                           
                        @endphp</td>
                </tr>
            </table>
           
        </div>
        @endforeach
      
        
    </div>
</div>

   
@endsection