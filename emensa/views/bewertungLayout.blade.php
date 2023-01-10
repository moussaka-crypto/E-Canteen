<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bewertungsseite @yield('title')</title>
</head>

<body>
<h1> Zu bewertendes Gericht </h1>
<div class="inhalt">
    <table>
        <tr>
            <td><h3>{{$gericht->name}}</h3></td>
            <td>
            @if($gericht->bildname == null)
                <td><img alt="gericht" src="img/gerichte/00_image_missing.jpg" height="150" width="150"></td>
            @else
                <td><img alt="gericht" src="img/gerichte/{{$gericht->bildname}}" height="150" width="150"></td>
            @endif
            </td>
        </tr>
        <tr>
            <td>
                <form method="post" action="/saveBewertung">
                    <input type="radio" id="sehr_schlecht" value="1" name="bewertung">
                    <label for="sehr_schlecht">sehr schlecht</label>

                    <input type="radio" id="schlecht" value="2" name="bewertung">
                    <label for="schlecht">schlecht</label>

                    <input type="radio" id="gut" value="3" name="bewertung">
                    <label for="gut">gut</label>

                    <input type="radio" id="sehr_gut" value="4" name="bewertung" checked>
                    <label for="sehr_gut">sehr gut</label>
                    <br>
                    <label for="bemerkung">Bemerkung</label>
                    <br>
                    <input type="text" name="bemerkung" id="bemerkung" value="Ihre Bemerkung">

                    @if($_SESSION['admin'])
                        <input type="checkbox" name="hervorgehoben" id="hervorgehoben">
                        <label for="hervorgehoben">hervorgehoben</label>
                    @endif
                    <br>
                    <input type="submit" name="savebewertung" id="savebewertung" value="speichern">
                </form>
            </td>
        </tr>
    </table>
    <table class="bewertungstabelle">
        <thead>
        <tr>
            <td>Bemerkung</td>
            <td>Sternebewertung</td>
            <td>Bewertungszeitpunkt</td>
            <td>Gericht</td>
        </tr>
        </thead>
        <tbody>
        @foreach($bewertungen as $bewertung)
            <tr @if($bewertung->hervorgehoben) class="hervorgehoben" @endif>
                <td> {{$bewertung->bemerkung}}</td>
                <td> {{$bewertung->sternebewertung}}</td>
                <td> {{$bewertung->bewertungszeitpunkt}}</td>
                <td> {{$bewertung->name}}</td>
                @if($_SESSION['admin'])
                    <td><a href="/gerichtHervorheben?bewertungsid={{$bewertung->id}}">Hervorheben</a> </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<form action="/" method="post">
    <input type="submit" name="zurueck" id="zurueck" value="Zurück zur Hauptseite">
</form>
</body>