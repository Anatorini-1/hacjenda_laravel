@extends('layouts.app')

@section('content')
   

    <table class='profile-table'>
        <tr>
            <td colspan="2" style='text-align:center'> 
                <img src="/img/profile_pictures/{{$data['profile_picture']}}"/><br />
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
        
       <tr>
           <td>Opinie</td>
            <td>AUUUUUUUUUUUUUU</td>
        </tr>
    </table>
@endsection