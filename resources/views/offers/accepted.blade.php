@extends('layouts.app')


@section('content')

@if ($allowed)
    Brawo, przyjołeś oferte, chcesz medal?
@endif

@unless ($allowed)
     U suck<br />
{{$msg}}
@endunless
@endsection
        
