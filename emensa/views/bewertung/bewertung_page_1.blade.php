@extends("bewertung.bewertung_layout")

@section("backfromBewertung")
    <button class="returnHome"><a href="/hauptseite_Emensa">Zurück zur Haupseite</a></button>
@endsection
@section("gericht")
    <h3>{{$gerichtData[0]["name"]}}</h3>
    <img src="/img/gerichte/{{$gerichtData[0]["bildname"]}}" alt ="Image hier">
    <div class="bewertungsEingabe centerBody">
    <button class="meineBewertungen"><a href="/meinebewertungen">Meine Bewertungen</a></button>
    <form method="post" action="/bewertung_verifizieren">
        <textarea name="kommentare" id="kommentare" minlength="5" rows="5">Bemerkungen</textarea>
        <div class="SterneUndSubmit">
            <label for="sterne">Sterne: </label>
        <select name="sterne" id="sterne">
            <option>sehr gut</option>
            <option>gut</option>
            <option>schlecht</option>
            <option>sehr schlecht</option>
        </select>
        <input type="submit" value="Submit">
            </div>
    </form>
    </div>
@endsection
@section("last30")
    <div class="bewertungsInfo centerBody">
       <h4>Reviews</h4>
  @if($_SESSION['admin'])
     <!--
      <form class="centerBody" method="post" action="/bewertung_to_highlight">
      -->
          <div class="scrollTable">
    <table>
        <tbody>
    @foreach($last30 as $value)
        @if($value['hervorgehoben'])
        <tr style="color: #3388aa">
            <td>{{$value['user']}}</td>
            <td>{{$value['description']}}</td>
            <td>{{$value['stern']}}</td>
            <td><a href="/bewertung_to_unhighlight?bewertungID={{$value['bewertung_id']}}">Hervorhebung abwählen</a></td>
            <!--
            <td><input type="checkbox" name="toHighlight[]" value="$value['bewertung_id']" checked></td>
            -->
        </tr>
        @else
            <tr>
                <td>{{$value['user']}}</td>
                <td>{{$value['description']}}</td>
                <td>{{$value['stern']}}</td>
                <td><a href="/bewertung_to_highlight?bewertungID={{$value['bewertung_id']}}">Hervorheben</a></td>
                <!--
                <td><input type="checkbox" name="toHighlight[]" value="$value['bewertung_id']"></td>
                -->
            </tr>
        @endif
    @endforeach
        </tbody>
    </table>
    </div>
        <!--
          <input type="submit" value="Hervorheben">
      </form>
      -->
  @else
            <table>
          <tbody>
      @foreach($last30 as $value)
          @if($value['hervorgehoben'])
              <tr style="color: #3388aa">
          @else
              <tr>
          @endif
              <td>{{$value['user']}}</td>
              <td>{{$value['description']}}</td>
              <td>{{$value['stern']}}</td>
              </tr>
      @endforeach
          </tbody>
     </table>
  @endif
    </div>
@endsection