@extends('layouts.app')



@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main>
    <div id="stworz_oferte" class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-xs-12">
        <form action="/offers" method="POST">
            @csrf
            <div class="form-group">
            <label for="miasto">Podaj miasto</label>
            <input type="text" class="form-control" @error('miasto') is-invalid @enderror name="miasto" id="miasto" placeholder="Miasto">
            @error('miasto')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
            </div>
            <div class="form-group">
                <label for="adres">Podaj adres</label>
                <input type="text" class="form-control" @error('adres') is-invalid @enderror name="adres" id="adres" placeholder="Adres">
                @error('adres')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
              <label for="okres">Czas Pracy</label>
              <input type="text" class="form-control" @error('okres_czasu') is-invalid @enderror name="okres_czasu" id="okres" placeholder="Okres pracy">
              @error('okres_czasu')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
            <div class="form-group">
              <label for="do_kiedy">Termin</label>
              <input type="date"  class="form-control" @error('do_kiedy') is-invalid @enderror name="do_kiedy" id="do_kiedy" placeholder="Do kiedy">
              @error('do_kiedy')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="powierzchnia">Podaj powierzchnię</label>
                <input type="number" class="form-control" @error('powierzchnia') is-invalid @enderror name="powierzchnia" id="powierzchnia" placeholder="Powierzchnia m²"">
                @error('powierzchnia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="wynagrodzenie">Podaj wynagrodzenie</label>
                <input type="number" class="form-control" @error('cena') is-invalid @enderror name="cena" id="wynagrodzenie" placeholder="Wynagrodzenie">
                @error('cena')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            
            <label>Usługi</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jobs[]" id="check1" value="1">
                    <label class="form-check-label" for="check1">
                    Mycie okien
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jobs[]" id="check2" value="2">
                    <label class="form-check-label" for="check2">
                    Mycie Auta
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jobs[]" id="check3" value="3">
                    <label class="form-check-label" for="check3">
                    Odkarzanie
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jobs[]" id="check4" value="4">
                    <label class="form-check-label" for="check4">
                    Zcieranie kurzu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jobs[]" id="check5" value="5">
                    <label class="form-check-label" for="check5">
                    Mycie Podłóg
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="jobs[]" id="check6" value="6">
                    <label class="form-check-label" for="check6">
                    Sprzątanie Łazienki
                    </label>
                </div>
            </div>
            <div class="form-group">
            <label for="uwagi">Uwagi</label>
            <textarea class="form-control" id="uwagi" rows="10" placeholder="Wpisz swoje uwagi dotyczące oferty.."></textarea>
            </div>
            <div class="col-sm-12">
            <input class="btn btn-info" type="submit" value="Wyślij ofertę">
            </div>
        </form>
    </div>
</main>
@endsection
        