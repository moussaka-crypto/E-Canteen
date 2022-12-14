@extends('layout')

@section("content")
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