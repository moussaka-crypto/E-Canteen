<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa Eupenerstraße</title>
    <link rel="stylesheet" href="/css/hauptseite_styles.css">
</head>
<body>
<div class="webseite">

    @yield('Kopfbereich & Navigation')
    <div class="Empty">
    </div>

    <div class="PageSetup">
        @yield('Begrüßungstext')
        <h2 id="speisen">K&ouml;stlichkeiten, die Sie erwarten</h2>
        @yield('Gerichte Uebersicht')
        <h2 class="meinungen">Meinungen unserer Gäste</h2>
        @yield('Meinungen')
        <footer>
            @yield('Fußbereich & Copyright')
        </footer>
    </div>
    <div class="Empty1"></div>
</div>
</body>
</html>

