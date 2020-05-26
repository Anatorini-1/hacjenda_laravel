@extends('layouts.app')


@section('content')

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
                        <div class="flex-1 scrolled">
                            Stałe
                            @foreach ($accepted_standing_offers as $offer)
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
                                    <td colspan="2"><a href='/offers/show/{{$offer->id}}'>Szczegóły</a></td>
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
                        <div class="flex-1 scrolled">
                            Zlecenia stałe <br />
                            @foreach ($posted_standing_offers as $offer)
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
                        <div class="flex-1 scrolled">
                            Stałe
                            @foreach ($employed_standing_offers as $offer)
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
</div>
@endsection
        