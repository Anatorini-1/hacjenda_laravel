@extends('layouts.app')


@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="review-form">
    <form action="/offers/review/{{$id}}" method='post'>
        @csrf
        Ocena<select name="ocena">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br />
        Opinia<textarea name="opinia"  cols="20" rows="3"></textarea>
        <input type="submit" value='Prześlij'>

    </form>
</div>



@endsection