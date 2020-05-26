@extends('layouts.app')


@section('content')

@if ($allowed)
    Oferta Zatwierdzona
@endif

@unless ($allowed)
     U suck<br />
{{$msg}}
@endunless
@endsection
        
