@extends('layouts.app')



@section('content')
<p>{{ session('msg') }}</p>

<main>
    <div class="container-fluid">


        <div class="row">
            <div id="info" class="col-md-6 col-lg-3">
                <img src="img/123.png" alt="" id='index-img'><br />
                Utrzymanie czystości w mieszkaniu czy biurze to podstawa – zarówno dla lepszego samopoczucia, jak i
                efektywności wykonywanych na co dzień zadań. Co jednak w sytuacji, gdy czasu jest niewiele, a o porządek
                niezwykle trudno? Najlepiej skorzystać z usług specjalistów, takich jak my, którzy oferują profesjonalne
                sprzątanie – w miejscu i terminie wskazanym przez Państwa.<br>



            </div>

            <div class=" col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/oferta_1.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Sprzątanie domów, mieszkań</h5>
                        <p class="card-text">Nie masz czasu albo ochoty dbać o porządek w swoim domu? W takim razie
                            skorzystaj z usług specjalistów, którzy zajmą się tym za Ciebie. Oferujemy sprzątanie
                            mieszkań oraz sprzątanie domów – od początku do końca, dbając o wyeliminowanie nawet
                            najmniejszego zabrudzenia!</p>
                        <a href="oferta.html" class="btn btn-primary">Oferta</a>
                    </div>
                </div>
            </div>
            <div class=" col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/oferta_1.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Sprzątanie domów, mieszkań</h5>
                        <p class="card-text">Nie masz czasu albo ochoty dbać o porządek w swoim domu? W takim razie
                            skorzystaj z usług specjalistów, którzy zajmą się tym za Ciebie. Oferujemy sprzątanie
                            mieszkań oraz sprzątanie domów – od początku do końca, dbając o wyeliminowanie nawet
                            najmniejszego zabrudzenia!</p>
                        <a href="oferta.html" class="btn btn-primary">Oferta</a>
                    </div>
                </div>
            </div>
            <div class=" col-md-6 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/oferta_1.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Sprzątanie domów, mieszkań</h5>
                        <p class="card-text">Nie masz czasu albo ochoty dbać o porządek w swoim domu? W takim razie
                            skorzystaj z usług specjalistów, którzy zajmą się tym za Ciebie. Oferujemy sprzątanie
                            mieszkań oraz sprzątanie domów – od początku do końca, dbając o wyeliminowanie nawet
                            najmniejszego zabrudzenia!</p>
                        <a href="oferta.html" class="btn btn-primary">Oferta</a>
                    </div>
                </div>
            </div>


        </div>

    </div>



    </div>
</main>

@endsection