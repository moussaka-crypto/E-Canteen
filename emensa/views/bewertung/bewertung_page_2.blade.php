@extends("bewertung.bewertung_layout")


@section("benutzer")
    <!--
    <form method="post" action="/bewertung_to_delete">
    -->
<table>
    @foreach($bewertungen as $value)
        <tr>
           <!--
            <td><input type="checkbox" name="toDelete[]" value="$value["bewertung_id"]"></td>
            -->
            <td>{{$value['user']}}</td>
            <td>{{$value['gerichtname']}}</td>
            <td>{{$value['description']}}</td>
            <td>{{$value['stern']}}</td>
            <td><a href="/bewertung_to_delete?bewertungID={{$value["bewertung_id"]}}">Löschen</a></td>
        </tr>
    @endforeach
</table>

    <!--
    <input type="submit" value="Submit">
    </form>
    -->
    <button style="margin-top: 10px"><a href="/hauptseite_Emensa">Zurück zur Hauptseite</a></button>
@endsection