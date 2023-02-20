<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */

const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';

const GET_PARAM_SHOW_DES = 'show_description';
const GET_PARAM_LANG = 'sprache';
const GET_PARAM_TOP_OR_FLOP = 'top_or_flop';


$text_en = [
    "Gericht" => "Meal",
    "Bewertung" => "Rating",
    "Insgesamt" => "Total",
    "Name" => "Name",
    "Begründung" => "Reason",
    "Suchen" => "Search",
    "Sterne" => "Stars"
];

$text_de = [
    "Gericht" => "Gericht",
    "Bewertung" => "Bewertung",
    "Insgesamt" => "Insgesamt",
    "Name" => "Name",
    "Begründung" => "Begründung",
    "Suchen" => "Suchen",
    "Sterne" => "Sterne"
];

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch', // es fehlt ein Komma
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13], // eckige Klammern
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
$searchedItem = "";

if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) { // es fehlten schließende Klammern
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (str_contains(strtolower($rating['text']), strtolower($searchTerm))) {
            $showRatings[] = $rating;
        }
    }
    $searchedItem = $searchTerm;

} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float { // das Wort function
    $sum = 0; // Beginn mit 0
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: indigo;
            }
            td {
                padding-right: 20px;
            }
            .preis{
                line-height: 10px;
            }
        </style>
    </head>
    <body>
        <h1><?php
            if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "en")
            {
                echo $text_en["Gericht"];
            }
            else {
                echo $text_de["Gericht"];
            } ?> : <?php echo $meal['name']; ?></h1>
        <form method= "get" action = "meal.php">
        <select name = "sprache" onchange = "this.form.submit()">
            <option value = "de"<?php if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "de") {echo "selected";} ?>>de</option>
            <option value = "en"<?php if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "en") {echo "selected";} ?>>en</option>
        </select>
        </form>
        <p><?php
            if(!empty($_GET[GET_PARAM_SHOW_DES]) && $_GET[GET_PARAM_SHOW_DES] == 1){
                echo $meal['description'];
            }
            ?>
        </p>
        <ul>
            <?php
            foreach ($allergens as $key => $value){
                if($value != null){
                    echo "<li>$value ($key)</li>";
                }
            }
            ?>
        </ul>

        <p class = "preis">Interner Preis: <?php echo number_format($meal["price_intern"],2,',');?>&euro;</p>
        <p class = "preis">Externer Preis: <?php echo number_format($meal["price_extern"],2,',');?>&euro;</p>
        //numberFormater - formatCurrency

        <h1><?php
            if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "en")
            {
                echo $text_en["Bewertung"];
            }
            else {
                echo $text_de["Bewertung"];
            } ?> (<?php
            if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "en")
            {
                echo $text_en["Insgesamt"];
            }
            else {
                echo $text_de["Insgesamt"];
            } ?>: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get" action = "meal.php">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value = "<?php echo htmlentities($searchedItem); ?>">
            <input type="submit" value=<?php
            if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "en")
            {
                echo $text_en["Suchen"];
            }
            else {
                echo $text_de["Suchen"];
            } ?>>
        </form>

        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td><?php
                    if (!empty($_GET[GET_PARAM_LANG]) && $_GET[GET_PARAM_LANG] == "en")
                    {
                        echo $text_en["Sterne"];
                    }
                    else {
                        echo $text_de["Sterne"];
                    } ?></td>
                <td>Author</td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
         <br>
         <?php
        if (!empty($_GET[GET_PARAM_TOP_OR_FLOP]) && $_GET[GET_PARAM_TOP_OR_FLOP] == "TOP"){
            $max = 0;
            foreach ($ratings as $rating){
                if($rating['stars'] > $max)
                    $max = $rating['stars'];
            }

            echo "<strong>TOP</strong>";
            echo "<table>";
            foreach ($ratings as $rating) {

                if($rating['stars'] == $max) {
                    echo "
                    <tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
                }
            }
            echo "</table>";
        }
        if (!empty($_GET[GET_PARAM_TOP_OR_FLOP]) && $_GET[GET_PARAM_TOP_OR_FLOP] == "FLOP"){

            $min = PHP_INT_MAX;
            foreach ($ratings as $rating){
                if($rating['stars'] < $min)
                    $min = $rating['stars'];
            }

            echo "<strong>FLOP</strong>";
            echo "<table>";
            foreach ($ratings as $rating) {

                if($rating['stars'] == $min) {
                    echo "
                    <tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
                }
            }
            echo "</table>";
        }
        ?>
    </body>
</html>