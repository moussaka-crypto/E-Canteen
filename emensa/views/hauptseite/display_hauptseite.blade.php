@extends('hauptseite.hauptseite_layout')

@section('Kopfbereich & Navigation')
    <div class="Header1">
        E-Mensa Logo
    </div>

    <div class="Header2">
        <a href="#ank">Ank&uuml;ndigung</a>
        <a href="#speisen">Speisen</a>
        <a href="#zahlen">Zahlen</a>
        <a href="#kontakt">Kontakt</a>
        <a href="#wichtiges">Wichtig f&uuml;r uns</a>
    </div>

@endsection

@section('Begrüßungstext')
    <img src="/img/Spinat_Risotto.jpg" alt="Spinatrisotto" class="pic">
    @if(isset($angemeldet))
        <div class="Benutzer">
        <p>Angemeldet als {{$angemeldet}}</p>
            <button><a href="/abmeldung">Abmelden</a></button>
        </div>
    @else
        <div class="Benutzer">
            <button><a href="/anmeldung">Jetzt anmelden</a></button>
        </div>
    @endif
    <h2 id="ank">
        <i>Bald gibt's Essen auch online ;)</i>
    </h2>
    <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
        <br><br>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
    </p>
@endsection

@section('Gerichte Uebersicht')
<table class="Food">
    <tr>
        <th>Gericht</th>
        <th>Preis intern</th>
        <th>Preis extern</th>
        <th>Bild</th>
    </tr>
    @foreach ($erste_5 as $value)
        <tr>
            @foreach($value as $element)
                @if($loop->last)
                    <td class = "GerichteM3"><img src="{{$element}}" width=260px height=160px alt=gerichte></td>
                @else
                    <td>{{$element}}</td>
                @endif
            @endforeach
        </tr>
    @endforeach

    @foreach($gericht_details as $value)
        <tr>
            <td>
                {{$value['name']}}
                @foreach($ga_details as $allergens_list)
                    @if($allergens_list['gericht_id'] == $value['id'])
                    <p>Allergene: {{$allergens_list['allergens']}}</p>
                    @endif
                @endforeach
            </td>
            <td>{{$value['preis_intern']}}</td>
            <td>{{$value['preis_extern']}}</td>
            <td class = "Gerichtebilder"><img src="../img/gerichte/{{$value['bildname']}}" alt="food"></td>
        </tr>
    @endforeach
</table>
<ul>
    @foreach($allergen_details as $value)
        <li>{{$value['code']}} -- {{$value['name']}}</li>
    @endforeach
</ul>
@endsection

@section('Meinungen')
    <table class="bewertungsTable" >
        <tr>
            <td>Name des Gerichts</td>
            <td>Bemerkung</td>
            <td>Bewertung</td>
        </tr>

        <tbody>
        @foreach($meinungen as $meinung)
            <tr>
                <td> {{$meinung->name}}</td>
                <td> {{$meinung->bemerkung}}</td>
                <td> {{$meinung->sternebewertung}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('Fußbereich & Copyright')
    <ul>
        <li>&copy; E-Mensa GmbH</li>
        <li>Muhammad Zulfahmi bin Zaid</li>
        <li>Hristomir Dimov</li>
        <li><a href="javascript:" id="Impressum">Impressum</a><li>
    </ul>
@endsection
