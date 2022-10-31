<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */

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
            width: 90%
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
                <td></td>
                <td>Preis intern</td>
                <td>Preis extern</td>
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
                                echo '"width=450px height=250px alt=gerichte></td>'; // Parameter
                            }
                        }
                        echo '</tr>';
                    }
                }
                ?>
            </table>

        <h2 id="zahlen">E-Mensa in Zahlen</h2>
        <table class="TheNumbersMasonWhatDoTheyMean">
            <tr>
                <th>x</th> <th> Besuche</th>
                <th>y</th> <th> Anmeldungen</th>
                <th>z</th> <th> Speisen</th>
            </tr>
        </table>
        <br><br>
        <h2 id="kontakt">Interesse geweckt? Wir informieren Sie!</h2>
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