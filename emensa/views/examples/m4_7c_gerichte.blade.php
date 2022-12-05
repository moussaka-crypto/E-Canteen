@extends('layout')

@section("content")
    <ol>
        @if(!empty($data))
        @foreach($data as $value)
                <li><i>{{$value['name']}}</i> | <b>{{$value['preis_intern']}}&euro;</b></li>
        @endforeach
        @else
            <li>Keine Gerichte vorhanden.</li>
        @endif
    </ol>
@endsection