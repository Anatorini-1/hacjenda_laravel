@extends('layouts.app') @section('content')
<div class="content">
    <div class="title m-b-md">
        Historia
        <br />
    </div>
    <table class='dev-table'>
        <tr>
            <td>ID</td>
            <td>Created At</td>
            <td>Miasto</td>
            <td>Adres</td>
            <td>Powierzchnia</td>
        </tr>
        @foreach ($offers as $offer)
        <tr>
            <h5>
                <td>{{ $offer["id"] }}</td>
                <td>{{ $offer["created_at"] }}</td>
                <td>{{ $offer["miasto"] }}</td>
                <td>{{ $offer["adres"] }}</td>
                <td>{{ $offer["powierzchnia"] }}</td>
                @php
                   
                @endphp
            </h5>
        </tr>
        @endforeach
    </table>

    @endsection
</div>
