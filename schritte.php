<?php

$title = "GPS-Schnitzeljagd";

function richtige_antwort($antwort, $aktuelle_frage)
{
    global $schritt;
    $richtig = $schritt[$aktuelle_frage]["richtig"];
    $antwort = chop($antwort);
    // Wenn $richtig ein array ist, sind mehrere Antworten richtig.
    if (is_array($richtig)) {
        return (in_array(strtolower($antwort), array_map('strtolower', $richtig)));
    }
    //alphanumerisch
    return (strtolower((string) $antwort) === strtolower( (string) $richtig));
}

$schritt = array(
    0 => array("frage" => "",
               "richtig" => null,
               "hinweis" => "Gehe zum Insektenhotel",
               "bildhinweis" => "images/1.jpg"),
    1 => array("frage" => "Welcher Buchstabe steht auf dem Stein?",
               "richtig" => "T",
               "hinweis" => "",
               "coord" => [48.97162,9.58374]),
    2 => array("frage" => "Wie viele Stufen hat die obere Treppe?",
               "richtig" => 8,
               "hinweis" => "Du hast das letzte Rätsel gelöst!\n\nSchau mal in den Backofen!")
    );


