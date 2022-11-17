<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */
$database_connect = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "dbwt",    // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    3306 // optional port der Datenbank
);

if (!$database_connect) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql_update_besuch = "UPDATE zahlen SET besuche = besuche + 1";
mysqli_query($database_connect,$sql_update_besuch);



$sql_abfrage_0 = "SELECT id,name,preis_intern,preis_extern FROM gericht g ORDER BY RAND() LIMIT 5";
$gericht_details = mysqli_query($database_connect, $sql_abfrage_0);

$sql_abfrage_1 = "SELECT gericht_id, GROUP_CONCAT(code) as allergens
                  FROM gericht_hat_allergen
                  GROUP BY gericht_id;";

$sql_abfrage_2 = "SELECT code, name FROM allergen";
$allergen_details = mysqli_query($database_connect,$sql_abfrage_2);

include("Newsletteranmeldung.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa Eupenerstraße</title>

    <style>
        * {
            font-family: "Baskerville  Face", serif;
            font-size: 18px;
        }
        td{
            padding-bottom: 10px;
        }
        .webseite{
            width: 69vw;
            background-color: lavender;

            border-style: solid;
            border-color: indigo;
            border-spacing: 5px;
            display: grid;
            grid-template-columns: 15% 70% 15%;
            margin-left: 15%;
        }
        .Header1{
            border: 1px solid indigo;
            margin-right: 2px;
            margin-left: 3px;
            text-align: center;
            font-size: 20px;
        }
        .Header2 > a{
           margin-right: 30px;
            font-size: 22px;
            text-decoration: none;
        }
        .Header2{
            border: 1px solid indigo;
            margin-left: 3px;
            margin-right: 3px;
            padding-bottom: 2px;
            text-align: center;
        }
        .Empty{
            grid-column-start: 1;
            grid-column-end: 2;

        }
        .PageSetup{
            grid-column-start: 2;
            grid-column-end: 3;
        }
        .Empty1{
            grid-column-start: 3;
            grid-column-end: 4;
        }
        .Food, .TheNumbersMasonWhatDoTheyMean{
            width: 90%;
            margin: auto;
        }
        .end{
            text-align: center;
            font-size: 30px;
            font-style: italic;
        }
        footer {
            border-top: 3px solid indigo;
            text-align: center;
            padding-top: 5px;
        }
        #speisen
        {
            display: table;
            margin-top: 8px;
            text-align: left;
        }
        #speisen,#zahlen,#kontakt,#wichtiges{
            font-size: 30px;
            font-style: italic;
        }
        footer > ul {
            list-style: none;
            text-align: center;
        }
        footer ul li {
            display: inline-block;
            padding-right: 5px;
            padding-left: 5px;
            border-left: 1px solid indianred;
        }
        ul li:first-child {
            border-left: none;
        }
        .pic{
            width: 100%;
            padding-top: 20px;
        }
        .succ{
            font-family: "Baskerville  Face", serif;
            font-size: 22px;
            color: green;
        }
        .vibeCheck{
            font-family: "Baskerville  Face", serif;
            font-size: 22px;
            color:darkred;
        }
        td {
            border: 1px solid black;
        }
        th{
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div class="webseite">

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

    <div class="Empty">
    </div>

    <div class="PageSetup">
        <img src="Spinat-Risotto-mit-Knoblauch-und-Zitrone-1200x675.jpg" alt="Spinatrisotto" class="pic">

        <h2 id="ank">
            <i>Bald gibt's Essen auch online ;)</i>
        </h2>
        <fieldset>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
            <br><br>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        </fieldset>

        <h2 id="speisen">K&ouml;stlichkeiten, die Sie erwarten</h2>

        <table class="Food">
            <tr>
                <th>Gericht</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Bild</th>
            </tr>

                <?php //here i guess
                include ('gerichte.php');
                if(isset($gerichte))
                {
                    for($i = 0; $i < count($gerichte); $i++){
                        echo '<tr>';
                        for($j = 0; $j < count($gerichte[$i]); $j++)
                        {
                            if($j!=count($gerichte[$i])-1)
                                echo '<td>'.$gerichte[$i][$j].'</td>';
                            else
                            {   //letztes Element ist das Bild
                                $p = "img/".$gerichte[$i][$j];
                                echo '<td><img src="'; //source des Bilds
                                echo $p; //Pfad zum Bild
                                echo '"width=260px height=160px alt=gerichte></td>'; // Parameter
                            }
                        }
                        echo '</tr>';
                    }
                }

                while($row = mysqli_fetch_assoc($gericht_details)){
                    echo '<tr>'.
                        '<td>',$row['name'];
                    $ga_details = mysqli_query($database_connect, $sql_abfrage_1);
                    while ($check_allergen = mysqli_fetch_assoc($ga_details)){
                        if($check_allergen['gericht_id'] == $row['id']){
                            echo '<p>Allergene: ',$check_allergen['allergens'],'</p>';
                        }
                    }
                    echo '</td>';
                 echo '<td>',$row['preis_intern'],'</td>',
                      '<td>',$row['preis_extern'],'</td>',
                      '</tr>';
                }
                ?>
            </table>

        <?php
            echo "<ul>";
            while($row = mysqli_fetch_assoc($allergen_details)) {
            echo '<li>' . $row['code'] . "--" . $row['name'] . '</li>';
            }
        echo "</ul>";
        ?>
        <h2 id="zahlen">E-Mensa in Zahlen</h2>
        <table class="TheNumbersMasonWhatDoTheyMean">
            <tr>
                <th><?php
                    $sql_abfrage_3 = "SELECT * FROM zahlen";
                    $collect_anzahl = mysqli_query($database_connect, $sql_abfrage_3);
                    $anzahl = mysqli_fetch_assoc($collect_anzahl);
                    echo $anzahl['besuche'];
                    ?>
                </th> <th> Besuche</th>
                <p class = "vibeCheck">
                    <?php
                    $rName = "";
                    $rMail = "";
                    $sprache = "";

                    if(isset($_POST["vorname"], $_POST["email"],$_POST["newsletterSprache"]))
                    {
                        $rName = checkName($_POST["vorname"]);
                        $rMail = checkMail($_POST["email"]);
                        $sprache = $_POST["newsletterSprache"];
                    }
                    ?>
                </p>
                <?php

                $exist = false;
                $userdata  = $rName.';'.$rMail.';'.$sprache."\n";
                $filecheck = fopen("Benutzerdaten.txt", 'r');
                while(!feof($filecheck))
                {
                    if($userdata == fgets($filecheck)) {
                        $exist = true;
                        echo "Wurde schon gespeichert!";
                        break;
                    }
                }
                fclose($filecheck);
                ?>
                <p class = "succ">
                    <?php
                    if(!$exist)
                    {
                        $file = fopen('Benutzerdaten.txt','a');

                        if(isset($rName, $rMail,$sprache) && $userdata != ";;"."\n")
                        {
                            fwrite($file,$rName.';'.$rMail.';'.$sprache."\n");
                            echo "Anmeldung erfolgreich!";
                        }
                        fclose($file);
                    }
                    ?>
                </p>
                <th><?php $anmeldungCounnter = 0;
                    $data = file_get_contents('Benutzerdaten.txt');
                    foreach (preg_split("/((\r?\n)|(\r\n?))/", $data, PHP_INT_MAX ,PREG_SPLIT_NO_EMPTY) as $ignored){
                        $anmeldungCounnter++;
                    }
                    echo $anmeldungCounnter; ?></th> <th> Anmeldungen</th>
                <th><?php
                    $sql_abfrage_4 = "SELECT COUNT(name) as total FROM gericht";
                    $collect_anzahl_g = mysqli_query($database_connect,$sql_abfrage_4);
                    $anzahl_gericht = mysqli_fetch_assoc($collect_anzahl_g);
                    echo $anzahl_gericht['total'];
                    ?>
                </th> <th> Speisen</th>
            </tr>
        </table>
        <br><br>
        <h2 id="kontakt">Interesse geweckt? Wir informieren Sie!</h2>

        <form method="post" action="">
            <fieldset>
                <p>
                    <label for="vorname">Ihr Name:</label>
                    <input name = "vorname" type="text" size="10" placeholder="Vorname" id="vorname" required>
                </p>

                <p>
                    <label for="email">Ihre E-mail:</label>
                    <input name = "email" type="email" size="10" id="email" required>
                </p>
                
                <label for="newsletterLang">Newsletter bitte in:</label>
                <select name="newsletterSprache" id="newsletterLang">
                    <option value="de">Deutsch</option>
                    <option value="en">Englisch</option>
                </select> <br><br>
                <div>
                    <label>
                        <input name = "datenschutz" type="checkbox" required>
                    </label>
                    Den Datenschutzbedingungen stimme ich zu<br><br>
                    <input type="submit" name = "submitForm" value="Zum Newsletter anmelden">
                </div>
            </fieldset>
        </form>
        <h2 id="wichtiges">Das ist uns wichtig...</h2>
        <ul id="endList">
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
        <h2  class="end">Wir freuen uns auf Ihren Besuch!</h2>

        <footer>
            <ul>
                <li>&copy; E-Mensa GmbH</li>
                <li>Hris, Vammy</li>
                <li><a href="javascript:" id="Impressum">Impressum</a><li>
            </ul>
        </footer>
    </div>
    <div class="Empty1"></div>
</div>
</body>
</html>

