<?php

function richtige_antwort($antwort, $aktuelle_frage)
{
    global $schritt;
    $richtig = $schritt[$aktuelle_frage]["richtig"];
    // numerisch
    //return ($antwort == $richtig);

    //alphanumerisch
    return (strtolower((string) $antwort) === strtolower( (string) $richtig));
}

$schritt = array(
    1 => array("frage" => "Löse das Rätsel.\nGib das Ergebnis hier ein.",
               "richtig" => "134",
               "hinweis" => "Gehe zur Terrasse!"),
    2 => array("frage" => "Wie viele Stufen hat die obere Treppe?",
               "richtig" => "8",
               "hinweis" => "Du hast das letzte Rätsel gelöst!\n\nSchau mal in den Backofen!")
    );


