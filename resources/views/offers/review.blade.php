@extends('layouts.app')


@section('content')
<div class="review-form">
    <form action="/offers/review/{{$id}}" method='post'>
        @csrf
        <select name="ocena">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="text" name='opinia'>
        <input type="submit">

    </form>
</div>



@endsection