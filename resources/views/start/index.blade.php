@extends('layouts.app')



@section('content')
<p class='msg'>{{ session('msg') }}</p>

<main>
    <div class="container-fluid">


        <div class="row">
            <div id="info" class="col-lg-6 col-xl-3">
                <img src="/img/123.png" alt="" id='index-img' ><br />
                Utrzymanie czystości w mieszkaniu czy biurze to podstawa – zarówno dla lepszego samopoczucia, jak i
                efektywności wykonywanych na co dzień zadań. Co jednak w sytuacji, gdy czasu jest niewiele, a o porządek
                niezwykle trudno? Najlepiej skorzystać z usług specjalistów, takich jak my, którzy oferują profesjonalne
                sprzątanie – w miejscu i terminie wskazanym przez Państwa.<br>



            </div>
            @foreach ($offers as $offer)
            <div class=" col-lg-6 col-xl-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" style='width:70% !important; height:auto' src="/img/offer_pictures/default.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title uwagi">{{$offer->uwagi}}</h5>
                        <p class="card-text main-card">
                            Do kiedy? &nbsp;&nbsp; {{$offer->do_kiedy}} <br />
                            Miasto: &nbsp;&nbsp; {{$offer->miasto}} <br />
                            Wynagrodzenie: &nbsp;&nbsp; {{$offer->cena}}zł <br />
                            Adres: &nbsp;&nbsp; {{$offer->adres}} <br />
                            Prace do wykonania: <br />
                            @php
                                foreach ($offer->jobs as $job){
                                    switch ($job){
                            case 1:
                                echo "Mycie Okien <br />";
                            break;
                            case 2:
                                echo "Mycie Auta <br />";
                            break;
                            case 3:
                                echo "Odkurzanie <br />";
                            break;
                            case 4:
                                echo "Zcieranie kurzu <br />";
                            break;
                            case 5:
                                echo "Mycie Podłóg <br />";
                            break;
                            case 6:
                                echo "Sprzątanie Łazienki <br />";
                            break;
                        }
                                }
                            @endphp
                            
                        </p>
                        <p style='text-align:center'>
                        <a href="/offers/show/{{$offer->id}}" class="btn btn-primary">Oferta</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
          
          


        </div>

    </div>



    </div>
</main>

@endsection