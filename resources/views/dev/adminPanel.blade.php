@extends('layouts.app')


@section('content')

        <div class="title m-b-md">
           Admin Panel 
           @php
              
               print_r(Auth::user()->name);
           @endphp
        </div>
        <div class="container">
            <div class="admin-actions">
                <h3>Actions</h3>
                <ul type="none">
                    <li>
                        <form action="/dev/sample" method="POST">
                            @csrf
                            <button>Sample Offer Data</button>
                        </form>
                    </li>
                    <li>
                        <form action="/dev/wipeOffers" method="POST">
                            @method('DELETE')
                            @csrf
                            <button>Wipe Offers</button>
                        </form>
                    </li>
                    <li>
                        <form action="/dev/wipeUsers" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Wipe Users</button>
                        </form>
                    </li>
                    <li>
                        <form action="/dev/history" method="POST">
                            @csrf
                            <button>Offer History</button>
                        </form>
                    </li>
                    
                </ul>
            </div>
            <div class="flex-box">
                <div class="flex_1">
                    Użytkownicy
                    @foreach ($users as $user)
                        <div class="admin-item">
                           {{ $user['id'] }}. &nbsp;{{ $user['name'] }}&nbsp; {{ $user['email'] }}
                        </div>
                    @endforeach
                </div>
                <div class="flex_1">
                    Oferty
                    @foreach ($offers as $offer)
                    <div class="admin-item">
                    {{ $offer['id'] }}. &nbsp;{{ $offer['miasto'] }}&nbsp; {{ $offer['adres'] }} <a href="/offers/{{ $offer['id'] }}">Details</a>
                     </div>
                    @endforeach
                </div>
        </div>
        </div>
@endsection
        