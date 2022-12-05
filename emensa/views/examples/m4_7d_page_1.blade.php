@extends('examples.m4_7d_layout',['title'=> 'Gericht Name'])

@section('header')
    <h1>Menü</h1>
@endsection

@section('main')
    <ul>
        @if(!empty($data))
            @foreach($data as $value)
                <li><i>{{$value['name']}}</i> | <b>{{$value['preis_intern']}}&euro;</b></li>
            @endforeach
        @else
            <li>Keine Gerichte vorhanden.</li>
        @endif
    </ul>
@endsection

@section('footer')
   <p>Footer 1</p>
@endsection