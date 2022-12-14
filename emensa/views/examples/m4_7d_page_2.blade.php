@extends('examples.m4_7d_layout',['title'=> 'Kategorie Name'])

@section('header')
    <h1>Kategorie Name</h1>
@endsection

@section('main')
    <ul>
        @foreach($data as $value)
            @if($loop->odd)
                <li><b>{{$value['name']}}</b></li>
            @else
                <li>{{$value['name']}}</li>
            @endif
        @endforeach
    </ul>
@endsection

@section('footer')
    <p>Hier ist footer</p>
@endsection






