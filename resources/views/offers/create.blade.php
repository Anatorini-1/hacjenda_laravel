@extends('layouts.app')



@section('content')

    
    <div class="content">
    <div class="title m-b-md">
        Panel Tworzenia Oferty
        <h3>
        <form action="/offers" method="POST">
            @csrf
            <input type="text" name="miasto" placeholder="Miasto"><br />
            <input type="text" name="adres" placeholder="Adres"><br />
            <input type="text" name="czas" placeholder="Czas pracy"><br />
            <input type="text" name="deadline" placeholder="Deadline"><br />
            <input type="text" name="powierzchnia" placeholder="Powierzchnia"><br />
            <input type="number" name="cena" placeholder="Wynagrodzenia"><br />
          
           Uwagi: <textarea name="uwagi" id='offer_desc'></textarea><br /> 
            <fieldset class="prace_do_wykonania">
                <label>Prace do wykonania:</label> <br />
                <input type="checkbox" name="jobs[]" value = '1'>Mycie Okien  <br />
                <input type="checkbox" name="jobs[]" value = '2'>Mycie Auta <br />
                <input type="checkbox" name="jobs[]" value = '3'>Odkurzanie <br />
                <input type="checkbox" name="jobs[]" value = '4'>Zcieranie kurzu <br />
                <input type="checkbox" name="jobs[]" value = '5'>Mycie Podłóg <br />
                <input type="checkbox" name="jobs[]" value = '6'>Sprzątanie Łazienki <br />
            </fieldset>
            <br />
            <input type="submit">
        </form>
    </h3>
     <br />  
    </div>
@endsection
        