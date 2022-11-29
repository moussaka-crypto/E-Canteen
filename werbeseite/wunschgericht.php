<?php

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

$name_ersteller = $_POST['ersteller'] ?? 'anonym';
$email = $_POST['email'] ?? null;

$gericht = $_POST['gericht_name'] ?? null;
$beschreibung = $_POST['beschreibung'] ?? null;

if($name_ersteller && $email && $gericht && $beschreibung){
 $query_1 = "SELECT id FROM ersteller WHERE name = "."'".$name_ersteller."'"."AND "."email =".
     "'".$email."'";
 $ask_table = mysqli_query($database_connect,$query_1);

 $id = '';
foreach($ask_table as $p){
    $id = $p['id'];
}

 if(isset($id)){
     $query_2 = "INSERT INTO wunschgericht (name, beschreibung,erstellungsdatum,ersteller_id) 
                    VALUES (".
                     "'".$gericht."'".",".
                     "'".$beschreibung."'".",".
                     "'".date('Y-m-d')."'".",".
                     "'".$id."'".")";
     mysqli_query($database_connect,$query_2);
 }
 else{
     $query_3 = "INSERT INTO ersteller (name, email) 
                    VALUES (".
                     "'".$name_ersteller."'".",".
                     "'".$email."'". ")";
     mysqli_query($database_connect,$query_3);

     $query_4 = "SELECT id FROM ersteller WHERE name = "."'".$name_ersteller."'"."AND "."email =".
         "'".$email."'";
     $collect_new = mysqli_query($database_connect,$query_4);

     $new_id = '';
     foreach($collect_new as $p){
         $new_id = $p['id'];
     }

     $query_5 = "INSERT INTO wunschgericht (name, beschreibung,erstellungsdatum,ersteller_id) 
                    VALUES (".
         "'".$gericht."'".",".
         "'".$beschreibung."'".",".
         "'".date('Y-m-d')."'".",".
         "'".$new_id."'".")";
     mysqli_query($database_connect,$query_5);
 }

 header('location:wunschgericht.php');
}

?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="form_wunschgericht_styles.css">
</head>
<body>
<fieldset>
    <legend>Ihr Wunschgericht!</legend>
<form method="post">
    <div>
    <label for="gericht_name">
        Wunschgericht :<input id="gericht_name" name="gericht_name"  type="text" placeholder="Geben Sie ihr Wunschgericht ein">
    </label>
    </div>
    <div>
    <label for="email">
        Email :<input id="email" name="email" type="email"  placeholder="Geben Sie ihre Email ein" required>
    </label>
    </div>
    <div>
    <label for ="beschreibung">
        Beschreibung :<textarea id="beschreibung" name="beschreibung" rows="7">"beschreiben Sie das Gericht"</textarea>
    </label>
    </div>
    <div>
    <label for="ersteller">
        Ersteller : <input id="ersteller"  name="ersteller"  type="text" placeholder="Geben Sie ihren Namen ein">
    </label>
    </div>
    <input type="submit" value="Wunsch abschicken">
</form>
</fieldset>
</body>
</html>
