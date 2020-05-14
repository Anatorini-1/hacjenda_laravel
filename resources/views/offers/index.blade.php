@extends('layouts.app')

@section('content')

    @php
        
    @endphp
    <div class="content">
    <div class="title m-b-md">
       
       
        Oferty <br />
        <!--
        <table id="offer_table">
            @foreach ($data as $item)
            <tr>
                <td> <a href="./offers/{{$item['id']}}">{{ $loop->index+1 }}</a></td>
                    <td>{{$item['miasto']}}</td>
                    <td>{{$item['powierzchnia']}}&nbsp;m2</td>
                </tr>
                @endforeach
        </table>
    -->
</div>
    <div class='row'>
    @foreach ($data as $item)
        <div class="col-md-4">
            <div class="card offer-card" style="width: 18rem;">
                <img class="card-img-top" src="/img/offer.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Oferta {{ $loop->index+1 }}</h5>
                  <p class="card-text">Tu będzie opis oferty jak mi się będzie chciało zrobić do tego backend</p>
                  <table id="offer_table">
                        <tr>
                            <td>Gdzie?</td><td> {{$item['miasto']}}</td>
                        </tr>
                        <tr>
                            <td>Powierzchnia?</td><td> {{$item['powierzchnia']}}&nbsp;m2</td>
                        </tr>
                        <tr>
                            <td>Wynagrodzenie?</td><td>Dowiemy sie jak to dodam do formularza</td>
                        </tr>
                </table>
                <br />
                  <a href="./offers/{{$item['id']}}" class="btn btn-primary">Szczegóły</a>
                </div>
              </div>

        </div>
    @endforeach
    </div>
        <br />  

   
    
@endsection
        
