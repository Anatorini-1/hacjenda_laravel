@extends('layouts.app')

@section('content')

@php

@endphp
<div class="title m-b-md">

    Oferty <br />
    
</div>
@csrf
<input type="text" name="search" id='searchtxt' placeholder="Miasto" onkeypress="logkey()"><br />
<input type="button" onclick="OrderDesc()" value="Najnowsze">
<input type="button" onclick="OrderAsc()" value="Najstarsze">
<br />
<input type="button" onclick="Szukaj()" value="Szukaj">
<div class="cointainer-fluid">

  
    <main>
      <div class="szukanie">
        <input class="form-control mr-sm-2 searchs" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-mdb-color btn-rounded btn-sm my-0 waves-effect waves-light" type="submit">Search</button></div>
        <p class="zmiana"><a href="#"><<</a><a href="#"> <</a> 1 <a href="#">></a><a href="#"> >></a> </p>
 
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
      <p class="zmiana"><a href="#"><<</a><a href="#"> <</a> 1 <a href="#">></a><a href="#"> >></a> </p>
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

-->

    @endsection