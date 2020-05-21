@extends('layouts.app')


@section('content')

    @php
        
    @endphp
    <div class="content">
    <div class="title m-b-md">
        Oferta {{$data['id']}} <br />
        
        'Offer Owner: '{{$data->user_id}}
    <h2>Miasto: {{$data['miasto']}}</h2>
    <h2>Adres: {{$data['adres']}}</h2>
    <h2>Data utworzenia: {{$data['created_at']}}</h2>
    <h2>Szacowany czas pracy: : {{$data['okres_czasu']}}</h2>
    <h2>Deadline: {{$data['do_kiedy']}}</h2>
    <h2>Powierzchnia: {{$data['powierzchnia']}}</h2>
    <h2>Wynagrodzenie: {{$data['cena']}}</h2>
    <fieldset style='border:1px solid #aaa; display:inline'>
    @php
        foreach ($data['jobs'] as $job) {
            switch ($job){
                case 1:
                    echo "<h2> Mycie Okien </h2>";
                break;
                case 2:
                    echo "<h2> Mycie Auta </h2>";
                break;
                case 3:
                    echo "<h2> Odkurzanie </h2>";
                break;
                case 4:
                    echo "<h2> Zcieranie kurzu </h2>";
                break;
                case 5:
                    echo "<h2> Mycie Podłóg </h2>";
                break;
                case 6:
                    echo "<h2> Sprzątanie Łazienki </h2>";
                break;
            }
        }
            
    @endphp
    </fieldset>
    
    @can('delete', $data)
        <form action="/offers/{{ $data->id }}" method="POST">
            
            @csrf
            @method('DELETE')
            <button>Delete Offer</button>
            
        </form>
    
    <a href="/offers/update/{{$data->id}}">
            <button>Edit Offer</button>
        </a>
    @endcan
    <br /><a href="/offers/accept/{{ $data->id }}"><button>Accept</button></a><br />
    
        <br />  

    </div>
    
@endsection
        
