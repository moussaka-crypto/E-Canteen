<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */
include ("m2_4a_standardparameter.php");

if(isset($_GET["A"]) && isset($_GET["B"]))
{
    $a= $_GET["A"]; $b= $_GET["B"];
    if(isset($_GET["Add"]))
        echo "Addition: " . addieren($_GET["A"], $_GET["B"]);
    elseif(isset($_GET["Mul"]))
        echo "Multiplikation: ". mult($_GET["A"], $_GET["B"]);
}
?>
<html lang="en">
<!DOCTYPE html>

<head>
    <title>Addition/Multiplikation</title>
    <meta charset="UTF-8">
</head>
<body>
    <form method="get" action="m2_4c_addform.php">
    <input type="number" name="A" value="<?php echo $a; ?>">
        <input type="number" name="B" value="<?php echo $b; ?>">
    <br>
    <input type="submit" name="Add" value="ADD">
    <br>
    <input type="submit" name="Mul" value="MUL">
    </form>
</body>
</html>


