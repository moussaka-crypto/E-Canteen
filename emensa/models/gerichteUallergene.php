<?php
function gerichte_und_allergene()
{
    $link=connectdb();
    $data=[];

    $sql_gericht = "SELECT gericht.id,gericht.name,gericht.preis_intern,gericht.preis_extern,gericht.bildname,GROUP_CONCAT(allergen.code) AS code FROM gericht_hat_allergen
            INNER JOIN gericht ON gericht_hat_allergen.gericht_id = gericht.id
            INNER JOIN allergen ON gericht_hat_allergen.code = allergen.code
            GROUP BY gericht.name
            ORDER BY gericht.name
            LIMIT 5;";

    $result_gericht = mysqli_query($link, $sql_gericht);
    while($row = mysqli_fetch_assoc($result_gericht)){
        array_push($data, $row);
    }
    mysqli_close($link);
    return $data;
}
