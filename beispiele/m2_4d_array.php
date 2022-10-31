<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */

$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];
echo '<style>
*{
margin-bottom: 4px;
font-size: 20px;
font-family: Arial,sans-serif;
}

</style>';

function winners($famousMeals): void
{
    echo 'Winners as listed: '.'<br>';
    echo '<ol>';
    for($i = 1; $i <= count($famousMeals); $i++)
    {
        echo '<li>';
        echo $famousMeals[$i]['name'] . '<br>';
        if($i != count($famousMeals))
        {
            for($j = count($famousMeals[$i]['winner'])-1; $j>=0; $j--)
            {
                if($j==0)
                    echo $famousMeals[$i]['winner'][$j];
                else
                    echo $famousMeals[$i]['winner'][$j].', ';
            }
        }
        else
            echo $famousMeals[$i]['winner']; //Ende
        echo '</li>';
    }
    echo'</ol>';
}
function losers($famousMeals): void
{
    echo'<br>';
    echo 'No winners in: '.'<br>';
    $allLosers=[];
    for($jahr = 2000; $jahr<2023; $jahr++)
    {
        $loser = true;
        for($i = 1; $i<=count($famousMeals);$i++)
        {
            if($i != count($famousMeals)) // 4 Subarrays auf erster Ebene
            {
                for($j=count($famousMeals[$i]['winner'])-1; $j>=0; $j--){

                    if($famousMeals[$i]['winner'][$j] == $jahr)
                        $loser=false;
                }
            }
            else{
                if($famousMeals[$i]['winner']==$jahr)
                    $loser = false;
            }
        }
        if($loser)
            array_push($allLosers,$jahr);
    }
    for($i=0;$i<count($allLosers);$i++)
        if($i==count($allLosers)-1)
            echo $allLosers[$i].'.';
        else
            echo $allLosers[$i].', ';
}

winners($famousMeals);
losers($famousMeals);