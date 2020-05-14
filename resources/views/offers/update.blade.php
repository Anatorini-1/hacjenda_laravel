@extends('layouts.app')


@section('content')

@php

@endphp
<div class="content">
    <div class="title m-b-md">
       
            Oferta {{$data['id']}} <br />
    </div>
    <form action="/offers/update/{{ $data['id'] }}" method="post">
        @csrf
        <table style='font-size:28px; margin:0 auto;'>
        <td> <br />
            <tr>
                <td> <span>Miasto </span></td>
                <td> <input value='{{ $data['miasto'] }}' type="text" name='miasto'></td>
            
            <tr>
                <td> <span>Adres </span> </td>
                <td><input value='{{ $data['adres'] }}' type="text" name='adres'></td>
               
            <tr>
                <td> <span>Powierzchnia </span> </td>
                <td><input value='{{ $data['powierzchnia'] }}' type="text" name='powierzchnia'></td> 
              
            <tr>
                <td> <span>Deadline </span> </td>
                <td><input value='{{ $data['do_kiedy'] }}' type="text" name='do_kiedy'></td>
                
            <tr>
                <td> <span>Zadania (to jeszcze nie działa) </span> </td>
                <td><input value='["2","3"]' type="text" name='jobs'></td>
                 
            <tr>
                <td> <span>Czas pracy </span> </td>
                <td><input value='{{ $data['okres_czasu'] }}' type="text" name='okres_czasu'></td>
                 
            
            </table>
            <input style='font-size:28px;' type='submit' value="Aktualizuj dane">
    </form>
 
    

    <br />

</div>

@endsection