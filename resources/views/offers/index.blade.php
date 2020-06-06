@extends('layouts.app')

@section('content')

@php

@endphp
<div class="title m-b-md">

    Oferty <br />
    
</div>
@csrf
<div class="cointainer-fluid">
    <p class='msg'>{{ session('msg') }}</p>
    
    <main>
        <div class="szukanie">
            <input class="form-control mr-sm-2 searchs" type="text" value='{{$_GET['search'] ?? ''}}' placeholder="Miasto" aria-label="Search" onkeypress="logkey()" id='searchs'>
            <input list="praca" id="praca-list" >
        <datalist id="praca" >
                    <option value="Mycie Okien">
                    <option value="Mycie Auta">
                    <option value="Odkurzanie">
                    <option value="Zcieranie kurzu">
                    <option value="Mycie Podłóg">
                    <option value="Sprzątanie Łazienki">
                </datalist><br/>
            <input type="number" class="cena-search" value='{{$_GET['cenaod'] ?? ''}}' placeholder="Cena od (pln)" id="cena_od"><input type="number" value='{{$_GET['cenado'] ?? ''}}' class="cena-search" placeholder="Cena do (pln)" id="cena_do"><br/>
            <button class="btn btn-mdb-color btn-rounded btn-sm my-0 waves-effect waves-light" type="button" onclick="Szukaj()">Search</button><br/>
            <input class="btn btn-mdb-color btn-rounded btn-sm my-0 waves-effect waves-light" type="button" onclick="OrderDesc()" value="Najnowsze">
            <input class="btn btn-mdb-color btn-rounded btn-sm my-0 waves-effect waves-light" type="button" onclick="OrderAsc()" value="Najstarsze">
        </div>
        <div class="row">
            <div class="col-md-12 page_button">
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
 
      <div class="row">
          @foreach ($data as $item)
              
         
        <div class="col-xs-12  col-md-6 col-lg-4">
          <div class="card" style='width:90%; margin-bottom:20px'>
            <img class="card-img-top" src="/img/offer_pictures/default.png" alt="Card image cap">
            <div class="card-body">
             
             
                <table class="offer_table">
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
                    <tr>
                        <td colspan="2"><a href="/offers/show/{{$item['id']}}" class="btn btn-primary">Oferta</a></td>
                    </tr>
                </table>      
            
            </div>
          </div>
        </div>
        @endforeach
      
      </div>
      <div class="row">
        <div class="col-md-12 page_button">
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
  </main>
  </div>
<!--
<div class="content">
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
                    <a href="http://127.0.0.1:8000/offers/show/{{$item['id']}}" class="btn btn-primary">Szczegóły</a>
                </div>
            </div>

        </div>
        @endforeach
    </div>
    
    <br />

-->

    @endsection