@extends('layouts.app')


@section('content')
<div class="content">
    <div class="title m-b-md">
        STRONA 
        @php
            use App\Offer;
            $offer = Offer::first();
            file_put_contents('tak.json', json_encode($offer->jobs));
            
        @endphp
     <br />  
    </div>
@endsection