<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meine Bewertungen @yield('title')</title>
</head>
<body>
<div class="inhalt">
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
            <tr>
                <td> {{$bewertung->bemerkung}}</td>
                <td> {{$bewertung->sternebewertung}}</td>
                <td> {{$bewertung->bewertungszeitpunkt}}</td>
                <td> {{$bewertung->name}}</td>
                <td>
                    <form method="post" action="/deletebewertung">
                        <input type="hidden" value="{{$bewertung->id}}" name="bewertungsid" id="bewertungsid">
                        <input type="submit" id="deleteButton" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form action="/" method="post">
        <input type="submit" name="zurueck" id="zurueck" value="Zurück zur Hauptseite">
    </form>
</div>
</body>