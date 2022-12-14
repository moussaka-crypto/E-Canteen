@extends("anmeldung.anmeldung_layout")

@section("formElements")
    <p class="input">
        <label for ="benutzer_name">Username</label>
        <input id="benutzer_name" name="benutzer_name" required type="text" value="">
    </p>

    <p class="input">
        <label for = "email">E-Mail</label>
        <input id="email" name="email" required type="email" value="" >
    </p>
    <p class="input">
        <label for ="passwort">Password</label>
        <input id="passwort" name="passwort" type="password" value="" >
    </p>

    <input type="submit" value="Anmeldung">
    @if(!is_null($fehler))
        <p>{{$fehler}}</p>
    @endif
@endsection