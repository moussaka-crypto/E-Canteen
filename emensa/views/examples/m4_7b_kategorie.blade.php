@extends('layout')

@section("content")
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