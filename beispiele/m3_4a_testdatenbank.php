<?php
$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "dbwt",    // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    3306 // optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql_abfrage_0 = "SELECT DISTINCT typ FROM allergen";

$result = mysqli_query($link, $sql_abfrage_0);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

echo "<table>";
echo'<th>'.'typ'.'</th>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>'.'<td>'.$row['typ'].'</td>'.'</tr>';
}
echo "</table>"."<br>";



mysqli_free_result($result);
mysqli_close($link);
