<?php
/**
 * Praktikum DBWT. Autoren:
 * Muhammad Zulfahmi, bin Zaid, 3520750
 * Hristomir, Dimov, 3536320
 */

$gerichte = [
    0 => ['Rindfleisch mit Bambus, Kaiserschotten und rotem Paprika, dazu Nudeln','3.50','6.20','rindf.jpg'],
    1 => ['Spinatrisotto mit kleinem Samosateigecken und gemischter Salat','2.90','5.30','spinat.jpg'],
    2 => ['Nasi Lemak','4.50','9.20','nasi_lemak.jpg'],
    3 => ['Moussaka','4.50','9.20','moussaka.jpg']
];

//https://stackoverflow.com/questions/2002710/php-how-to-perform-htmlspecialchar-on-an-array-of-arrays
array_walk_recursive($gerichte, "htmlspecialchars");