@extends("anmeldung.anmeldung_layout")

@section("formElements")
<input id="benutzer_name" name="benutzer_name" type="text" value="" placeholder="username">
<input id="email" name="email" type="email" value="" placeholder="email">
<input id="passwort" name="passwort" type="password" value="" placeholder="password">
    <input type="submit" value="Submit">
    @if(!is_null($fehler))
        <p>{{$fehler}}</p>
    @endif
@endsection