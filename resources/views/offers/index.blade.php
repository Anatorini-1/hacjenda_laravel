@extends('layouts.app')

@section('content')

@php

@endphp
<div class="title m-b-md">

    Oferty <br />
    
</div>

<div class="content">
    <form action="/offers/search/1" method="POST">
        @csrf
        <textarea name="search" id='searchtxt' placeholder="Miasto"></textarea><br />
        <br />
        <input type="button" onclick="Szukaj()">
    </form>
    <div class="row">
        <div class="col-md-12">
            <fieldset id="offer_buttons_fieldset">
                <a href="/offers/{{$beforesearch}}1{{$activesearch}}"> &lt;&lt; </a>

                @if ($activePage > 1)
            <a href="/offers/{{$beforesearch}}{{$activePage-1}}{{$activesearch}}">&lt;</a>
                @endif
                {{ $activePage }}
                @if ($activePage < $pageCount) <a href="/offers/{{$beforesearch}}{{$activePage+1}}{{$activesearch}}">&gt;</a>
                    @endif
                    <a href="/offers/{{$beforesearch}}{{$pageCount}}{{$activesearch}}"> &gt;&gt; </a>
            </fieldset>
        </div>
    </div>
    <div class='row'>
       
        @foreach ($data as $item)

        <div class="col-md-4">
            <div class="card offer-card" style="width: 18rem;">
                <img class="card-img-top" src="/img/offer_pictures/{{ $item['clickbait'] }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Oferta {{ $loop->index+1 }}</h5>
                    <p class="card-text">Opis: {{ $item['uwagi'] }}</p>
                    <table id="offer_table">
                        <tr>
                            <td>Gdzie?</td>
                            <td> {{$item['miasto']}}</td>
                        </tr>
                        <tr>
                            <td>Powierzchnia?</td>
                            <td> {{$item['powierzchnia']}}&nbsp;m2</td>
                        </tr>
                        <tr>
                            <td>Wynagrodzenie?</td>
                            <td>{{$item['cena']}} zł</td>
                        </tr>
                    </table>
                    <br />
                    <a href="./offers/show/{{$item['id']}}" class="btn btn-primary">Szczegóły</a>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <fieldset id="offer_buttons_fieldset">
                <a href="/offers/{{$beforesearch}}1{{$activesearch}}"> &lt;&lt; </a>

                @if ($activePage > 1)
                <a href="/offers/{{$beforesearch}}{{$activePage-1}}{{$activesearch}}">&lt;</a>
                @endif
                {{ $activePage }}
                @if ($activePage < $pageCount) <a href="/offers/{{$activePage+1}}{{$activesearch}}">&gt;</a>
                    @endif
            <a href="/offers/{{$beforesearch}}{{$pageCount}}{{$activesearch}}"> &gt;&gt; </a>
            </fieldset>
        </div>
    </div>
    <br />



    @endsection