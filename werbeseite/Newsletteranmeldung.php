<?php
/**
 * Praktikum DBWT. Autoren:
 * Muhammad Zulfahmi, bin Zaid, 3520750
 * Hristomir, Dimov, 3536320
 */

function checkName($vorname): ?string
{
    if(ctype_space($vorname) || !ctype_alpha($vorname))
    {
        echo "Ihr Name entspricht nicht den Vorgaben!\n";
    }
    else return htmlspecialchars($vorname);
    return null;
}
function checkMail($mail): ?string
{
    if(isset($_POST["email"])&& !filter_var($mail,FILTER_VALIDATE_EMAIL))
        echo "Ihre E-Mail entspricht nicht den Vorgaben!\n";

    elseif(stripos($mail,'rcpt.at')||
        stripos($mail,'damnthespam.at')||
        stripos($mail,'wegwerfmail.de')||
        stripos($mail,'trashmail'))
        echo "Trash mail!\n";

    else return htmlspecialchars($mail);
    return null;
}