<?php

function richtige_antwort($antwort, $aktuelle_frage)
{
    global $schritt;
    $richtig = $schritt[$aktuelle_frage]["richtig"];
    //alphanumerisch
    return (strtolower((string) $antwort) === strtolower( (string) $richtig));
}

$schritt = array(
    1 => array("frage" => "Wie heißt der Begründer der Relativitätstheorie mit Nachnamen?",
               "richtig" => "Einstein",
               "hinweis" => "Gehe zur Terrasse!",
               "coord" => [48.97162,9.58374]),
    2 => array("frage" => "Wie viele Stufen hat die obere Treppe?",
               "richtig" => 8,
               "hinweis" => "Du hast das letzte Rätsel gelöst!\n\nSchau mal in den Backofen!")
    );


