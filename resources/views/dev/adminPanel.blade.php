@extends('layouts.app')


@section('content')

        <div class="title m-b-md">
           Admin Panel 
        </div>
        <div class="container">
            <div class="admin-actions">
                <h3>Actions</h3>
                <ul type="none">
                    <form action="/offers/sample" method="POST">
                        @csrf
                        
                        <li>
                            <button>Sample Offer Data</button>
                        </li>
                    </form>
                    <li>Wipe Offers</li>
                    <li>Wipe Users</li>
                    <li>OfferHistory</li>
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
        