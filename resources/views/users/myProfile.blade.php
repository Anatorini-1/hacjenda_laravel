@extends('layouts.app')


@section('content')
<p>{{ session('msg') }}</p>
<main>
    <div class="row">
      <div id="edycja"class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 profile-data">
       
        <div id="settings">
          <fieldset>
           <table class='profile-table'>
            <tr>
                <td>Nazwa</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <td>Pełna Nazwa</td>
                <td>{{ Auth::user()->full_name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ Auth::user()->email }}</td>
            </tr>
            <tr>
                <td>Miasto</td>
                <td>{{ Auth::user()->city }}</td>
            </tr>
            <tr>
                <td>Opis</td>
                <td>{{ Auth::user()->desc }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="/users/update">
                        <button>Aktualizuj dane</button>
                    </a>
                </td>
            </tr>
           </table>
           
          </fieldset>
        </div>
      </div>
      

      <div id="opinie" class="col-md-12 col-lg-6 profile-x">
        <h5>Oferty wykonywane przez Ciebie<h5>
            @foreach ($accepted_single_offers as $item)
            <div class="profile-card">
                <div class="card-header profile-offer-header">
                  <h5>Miasto : {{$item['offer']->miasto}}</h5>
                  <h5>Adres : {{$item['offer']->adres}}</h5>
                  <h5>Termin : {{$item['offer']->do_kiedy}}</h5>
                  <h5>Wynagrodzenie : {{$item['offer']->cena}}</h5>
                  <h5>Pracodawca :<a href='/users/show/{{$item['employer']['id']}}'> {{$item['employer']['name']}}</a></h5>
                  <h5><a href='/offers/show/{{$item['offer']->id}}'> Szczegóły</a></h5>
                
                </div>
                
              </div>
            @endforeach
      
        
      </div>

    
     
    </div>
    <div class="row">
      <div id="opinie" class="col-md-12 col-lg-6 profile-x">
        <h5>Oferty Stworzone przez Ciebie<h5>
            <div class="flex-container">
                <div class="flex-1">Oczekujące <br />
                    @foreach ($posted_single_offers as $item)
                    <div class="profile-card">
                        <div class="card-header profile-offer-header">
                          <h5>Miasto : {{$item->miasto}}</h5>
                          <h5>Adres : {{$item->adres}}</h5>
                          <h5>Termin : {{$item->do_kiedy}}</h5>
                          <h5>Wynagrodzenie : {{$item->cena}}</h5>
                          <h5>&nbsp;</h5>
                           <h5><a href='/offers/show/{{$item->id}}'> Szczegóły</a></h5>
                        
                        </div>
                        
                      </div>
                    @endforeach
                 </div>
                <div class="flex-1">W realizacji <br /> 
                    @foreach ($employed_single_offers as $item)
                    <div class="profile-card">
                        <div class="card-header profile-offer-header">
                          <h5>Miasto : {{$item['offer']->miasto}}</h5>
                          <h5>Adres : {{$item['offer']->adres}}</h5>
                          <h5>Termin : {{$item['offer']->do_kiedy}}</h5>
                          <h5>Wynagrodzenie : {{$item['offer']->cena}}</h5>
                          <h5>Pracodawca :<a href='/users/show/{{$item['employee']['id']}}'> {{$item['employee']['name']}}</a></h5>
                          <h5><a href='/offers/show/{{$item['offer']->id}}'> Szczegóły</a></h5>
                        
                        </div>
                        
                      </div>
                    @endforeach
                </div>
            </div>
        
       
      </div>
      <div id="opinie" class="col-md-12 col-lg-6 profile-x">
        <h5>Opinie o Tobie<h5>
            @foreach ($jobs_done as $item)
                
           
        <div class="profile-card">
          <div class="card-header  profile-offer-header">
            <h5>Oferta:<a href='/offers/show/{{$item['offer']->id}}'> {{$item['offer']->id}}</a></h5>
            <h5>Ocena: {{$item['opinion']->opinia ?? '-'}}</h5>
            <h5>Opinia: {{$item['opinion']->ocena ?? '-'}}</h5>
               
          </div>
         
        </div>
        @endforeach
      </div>
    </div>
  </main>
<!--
    <div class="content">
        <div class='flex-container'>
        
            <div class="title m-b-md flex-1 profile-label">
                Profil Użytkownika
            <br /> 
            <table class="profile-table">
                <tr>
                    <td><img src="/img/profile_pictures/default.png" /></td>
                    <td>Typ Konta: {{ Auth::user()->access }} </td>
                </tr>
                <tr>
                    <td>Nazwa</td>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <td>Pełna Nazwa</td>
                    <td>{{ Auth::user()->full_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <td>Miasto</td>
                    <td>{{ Auth::user()->city }}</td>
                </tr>
                <tr>
                    <td>Opis</td>
                    <td>{{ Auth::user()->desc }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="/users/update">
                            <button>Aktualizuj dane</button>
                        </a>
                    </td>
                </tr>
            </table>
            </div>
            <div class="flex-1">
                <fieldset class='profile-fieldset'>
                    <label>Oferty realizowane przez Ciebie</label>
                    <div class="flex-container">
                        <div class="flex-1 scrolled">
                            Pojedyncze
                            @foreach ($accepted_single_offers as $offer)
                            <div class='profile-item'>
                                <table>
                                    <tr>
                                        <td>Przyjęte</td>
                                        <td>{{$offer['accept_data']->accepted_at}}<br /></td>
                                    </tr>
                                <tr>
                                    <td>Pracodawca</td>
                                <td><a href='/users/show/{{$offer['employer']['id']}}'>{{$offer['employer']['name']}}</a></td>
                                </tr>
                                <tr>
                                    <td>Miasto</td>
                                <td>{{ $offer['offer']->miasto }}</td>
                                </tr>
                                <tr>
                                    <td>Adres</td>
                                    <td>{{ $offer['offer']->adres }}</td>
                                </tr>
                                <tr>
                                    <td>Deadline</td>
                                    <td>{{ $offer['offer']->do_kiedy }}</td>
                                </tr>
                                <tr>
                                    <td>Wynagrodzenie</td>
                                    <td>{{ $offer['offer']->cena }}</td>
                                </tr>
                                    <tr>
                                    <td colspan="2"><a href="/offers/show/{{$offer['offer']->id}}">Szczegóły</a></td>
                                    </tr>
                                </table>      
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="title m-b-md">
            Oferty Stworzone przez Ciebie
        </div>
        <div class="flex-container">
            <div class='flex-1'>
                <fieldset class='profile-fieldset'>
                    <label>Oczekujące na wykonawcę</label>
                    <div class="flex-container ">
                        <div class="flex-1 scrolled">
                            Jednorazowe <br />
                            @foreach ($posted_single_offers as $offer)
                            <div class='profile-item'>
                                <table>
                                    <tr>
                                        <td>ID</td>
                                        <td> {{$offer->id}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Miasto</td>
                                        <td>{{$offer->miasto}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Adres</td>
                                        <td> {{$offer->adres}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Cena</td>
                                        <td> {{$offer->cena}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Data utworzenia</td>
                                        <td> {{$offer->created_at}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Deadline</td>
                                        <td> {{$offer->do_kiedy}}<br /></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2"><a href='/offers/show/{{$offer->id}}'>Szczegóły</a></td>
                                    </tr>
                                </table>      
                            </div>
                                @endforeach
                        </div>
                       
                    </div>
                </fieldset>
            </div>
            <div class="flex-1">
                <fieldset class="profile-fieldset">
                    <label>W realizacji</label>
                    <div class="flex-container">
                        <div class="flex-1 scrolled">
                            Pojedyncze
                            @foreach ($employed_single_offers as $offer)
                            <div class='profile-item'>
                                <table>
                                    <tr>
                                        <td>Przyjęte</td>
                                        <td>{{$offer['accept_data']->accepted_at}}<br /></td>
                                    </tr>
                                <tr>
                                    <td>Wykonawca</td>
                                <td><a href='/users/show/{{$offer['employee']['id']}}'>{{$offer['employee']['name']}}</a></td>
                                </tr>
                                <tr>
                                    <td>Miasto</td>
                                <td>{{ $offer['offer']->miasto }}</td>
                                </tr>
                                <tr>
                                    <td>Adres</td>
                                    <td>{{ $offer['offer']->adres }}</td>
                                </tr>
                                <tr>
                                    <td>Deadline</td>
                                    <td>{{ $offer['offer']->do_kiedy }}</td>
                                </tr>
                                <tr>
                                    <td>Wynagrodzenie</td>
                                    <td>{{ $offer['offer']->cena }}</td>
                                </tr>
                                    <tr>
                                    <td colspan="2"><a href="/offers/show/{{$offer['offer']->id}}">Szczegóły</a></td>
                                    </tr>
                                </table>      
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                </fieldset>
            </div>
    </div>
    <div class="title m-b-md">
        Twoja Historia
    </div>
        <div class="flex-container">
            <div class="flex-1">
                <fieldset class="profile-fieldset">
                    <label>Wykonane przez Ciebie</label>
                    <div class="flex-container">
                        <div class="flex-1 scrolled">
                            @foreach ($jobs_done as $offer)
                                <div class='profile-item'>
                                <table>
                                    <tr>
                                        <td>ID</td>
                                        <td> {{$offer['offer']->id}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Przyjęte</td>
                                        <td>{{$offer['offer']->accepted_at}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Zrealizowane</td>
                                        <td> {{$offer['offer']->finished_at}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Pracodawca</td>
                                        <td><a href='/users/show/{{ $offer['employer']->id }}'>{{ $offer['employer']->full_name }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Opinia</td>
                                        <td> {{$offer['opinion']}}<br /></td>
                                    </tr>
                                   
                                    
                                    <tr>
                                    <td colspan="2"><a href='/offers/show/{{$offer['offer']->offer_id}}'>Szczegóły</a></td>
                                    </tr>
                                </table>      
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                </fieldset>
            </div>
            <div class="flex-1">
                <fieldset class="profile-fieldset">
                    <label>Zlecone przez Ciebie</label>
                    <div class="flex-container">
                        <div class="flex-1 scrolled">
                            @foreach ($jobs_ordered as $offer)
                                <div class='profile-item'>
                                <table>
                                    <tr>
                                        <td>ID</td>
                                        <td> {{$offer['offer']->id}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Przyjęte</td>
                                        <td>{{$offer['offer']->accepted_at}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Zrealizowane</td>
                                        <td> {{$offer['offer']->finished_at}}<br /></td>
                                    </tr>
                                    <tr>
                                        <td>Wykonawca</td>
                                        <td><a href='/users/show/{{ $offer['employee']->id }}'>{{ $offer['employee']->full_name }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Opinia</td>
                                        <td> {{$offer['opinion']}}<br /></td>
                                    </tr>
                                   
                                    
                                    <tr>
                                    <td colspan="2"><a href='/offers/show/{{$offer['offer']->offer_id}}'>Szczegóły</a></td>
                                    </tr>
                                </table>      
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                </fieldset>
            </div>-->
        </div>
</div>
@endsection
        