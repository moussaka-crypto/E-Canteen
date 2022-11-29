@extends('layout')

@section('content')
    <h1>Der Wert von ?name lautet: {{$request->getGetData()['name']}}</h1>
@endsection