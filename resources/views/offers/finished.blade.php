@extends('layouts.app')


@section('content')
{{$data['msg']}}




    @if ($data['employer'])
  
    <a href="/offers/review/{{$data['id']}}">
        <button>
            Tak
        </button>
        </a>
    <a href="/">
        <button>
            Nie
        </button>
        </a>

    @endif



@endsection