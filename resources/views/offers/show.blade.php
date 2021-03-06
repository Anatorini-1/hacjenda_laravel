@extends('layouts.app')


@section('content')
<p class='msg'>{{ session('msg') }}</p>
    @php
        
    @endphp
    <div class="content">
        <div class="flex-container">
            <div class="flex-1">
                <h1>Oferta {{$data['id']}} </h1><br />
            
                <h1>'Offer Owner: '{{$data->user_id}} </h1><br />
            
                Stan : {{$data->stan}}
                <h2>Miasto: {{$data['miasto']}}</h2>
                <h2>Adres: {{$data['adres']}}</h2>
                <h2>Data utworzenia: {{$data['created_at']}}</h2>
                <h2>Szacowany czas pracy: : {{$data['okres_czasu']}}</h2>
                <h2>Deadline: {{$data['do_kiedy']}}</h2>
                <h2>Powierzchnia: {{$data['powierzchnia']}}</h2>
                <h2>Wynagrodzenie: {{$data['cena']}}</h2>
                @if ($data->zlecenie_stale)
                <h2>Wykonane prace: {{$data['jobs_done']}}</h2>
                @endif
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
            </div>
            <div class="flex-1 offer-actions">
                Actions <br />
                <table id='offer_table'>
                    <tr>
                        <td>Stan:</td>
                        <td>
                            @can('apply', $data)
                            @php
                                $res = Gate::inspect('apply',$data);
                                echo $res->message();
                            @endphp
                        @endcan
                        @cannot('apply', $data)
                            @php
                                $res = Gate::inspect('apply',$data);
                                echo $res->message();
                            @endphp
                        @endcannot
                        </td>
                    </tr>
                    @if ($data->stan != 'zakonczona')
                        
                   
                    <tr>
                        <td>Akcje</td>
                        <td>
                            @can('delete', $data)
                            <form action="/offers/{{ $data->id }}" method="POST">
                                
                                @csrf
                                @method('DELETE')
                                <button>Delete Offer</button>
                                
                            </form>
                        
                            <a href="/offers/update/{{$data->id}}">
                                <button>Edit Offer</button><br />
                            </a>
                        @endcan
                    @can('apply', $data)   
                        <form action="/offers/pending/{{ $data->id }}" method='post'>
                            @csrf;
                            <button type='submit'>Accept</button>
                        </form>
                    @endcan
                    @if ($data->stan == 'w_realizacji')
                    @can('finish', $data)
                    <form action="/offers/finish/{{ $data->id }}" method='post'>
                        @csrf;
                        <button type='submit'>Oznacz jako wykonane</button>
                    </form>
                    @endcan
                    @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Chętni do realizacji</td>
                        <td>
                            @foreach ($pending as $user)
                        <a href='/users/show/{{$user->id}}'>{{$user->name}}</a>
                            @can('delete',$data)
                        <form action="/offers/accept/{{$data->id}}&{{$user->id}}" method="post">
                                    @csrf
                                <button type='submit'>Akceptuj Wykonawcę</button>
                                </form>
                            @endcan
                        <br />
                            @endforeach
                        </td>
                    </tr>
                   @endif
                </table>
               
            </div>
        </div>
    
    </div>

@endsection
        
