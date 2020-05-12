@extends('layouts.app')


@section('content')

    @php
        
    @endphp
    <div class="content">
    <div class="title m-b-md">
        Oferta {{$data['id']}} <br />
        'User ID: ' {{Auth::user()->id}}
        'Offer Owner: '{{$data->user_id}}
    <h2>Miasto: {{$data['miasto']}}</h2>
    <h2>Adres: {{$data['adres']}}</h2>
    <h2>Data utworzenia: {{$data['created_at']}}</h2>
    <h2>Szacowany czas pracy: : {{$data['okres_czasu']}}</h2>
    <h2>Deadline: {{$data['do_kiedy']}}</h2>
    <h2>Powierzchnia: {{$data['powierzchnia']}}</h2>
    @foreach ($data['jobs'] as $job)
        <h2>{{ $job }}</h2>
    
    @can('delete', $data)
        <form action="/offers/{{ $data->id }}" method="POST">
            
            @csrf
            @method('DELETE')
            <button>Delete Offer</button>
            <button>Edit Offer</button>
            <button>Complete</button>
        </form>
    @endcan
    @endforeach
    
        <br />  

    </div>
    
@endsection
        
