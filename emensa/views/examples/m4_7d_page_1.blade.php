@extends('examples.m4_7d_layout',['title'=> 'Gericht Name'])

@section('header')
    <h1>Gericht Name</h1>
@endsection

@section('main')
    <ul>
        @if(!empty($data))
            @foreach($data as $value)
                <li>NAME: {{$value['name']}}, PREIS: {{$value['preis_intern']}}</li>
            @endforeach
        @else
            <li>Kein Gericht Vorhanden</li>
        @endif
    </ul>
@endsection

@section('footer')
   <p>Hier ist footer</p>
@endsection