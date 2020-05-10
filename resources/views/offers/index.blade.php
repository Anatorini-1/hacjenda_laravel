@extends('layouts.app')




@section('content')

    @php
        
    @endphp
    <div class="content">
    <div class="title m-b-md">
       {{ session('msg') }} <br />
       
        Oferty <br />
        <table id="offer_table">
        @foreach ($data as $item)
       
           <tr>
         
            <td> <a href="./offers/{{$item['id']}}">{{$item['id']}}</a></td>
                <td>{{$item['miasto']}}</td>
                <td>{{$item['powierzchnia']}}&nbsp;m2</td>
            </tr>
       
        @endforeach
        </table>
        <br />  

    </div>
    
@endsection
        
