<?php
require("schritte.php");

$aktuelle_frage = 1;

if (isset($_REQUEST['schritt']) && isset($schritt[(int) $_REQUEST['schritt']])) {
    $aktuelle_frage = (int) $_REQUEST['schritt'];
}

if (isset($_REQUEST['antwort'])) {
    $antwort = htmlspecialchars($_REQUEST['antwort']);
    if (!richtige_antwort($antwort, $aktuelle_frage)) {
        header("Location: index.php?schritt=$aktuelle_frage&fehler");
        die();
    }
}

header("Location: index.php?schritt=".($aktuelle_frage+1)."&richtig");


?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="style.css">
   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <title><?php echo "$title";?></title>
  </head>
  <body>

<?php

echo '<form action="index.php?schritt='.($aktuelle_frage+1).'" method="post">';
$hinweis = null;
if (isset($schritt[$aktuelle_frage]["hinweis"])) {
    $hinweis = $schritt[$aktuelle_frage]["hinweis"];
} else {
    $hinweis = "Du bist am Ziel!";
}
if ($hinweis) {
    // Blende den Hinweis der vergangenen Frage ein
    echo '<h3>Das war richtig! Hier der nächste Hinweis:</h3>';
    echo '<div class="row hinweis">
    <div class="col"><p>'.nl2br($hinweis).'</p>';
    if (isset($schritt[$aktuelle_frage]["coord"])) {
        $c = $schritt[$aktuelle_frage]["coord"];
        echo '<p>GPS-Koordinaten: <a href="geo:'.$c[0].','.$c[1].'?q='.$c[0].','.$c[1].'">'.$c[0].' / '.$c[1].'</a></p>';
        echo '<a class="btn btn-primary" data-toggle="collapse" href="#karte" role="button" aria-expanded="false" aria-controls="karte">
    Karte anzeigen
  </a>
        <div class="collapse" id="karte">
        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox='.$c[1].','.$c[0].','.$c[1].','.$c[0].'&amp;marker='.$c[0].','.$c[1].'" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat='.$c[0].'&amp;mlon='.$c[1].'#map=17/'.$c[0].'/'.$c[1].'">Größere Karte anzeigen</a></small>
        </div>';
    }
    echo '</div></div>';
}
if (isset($schritt[$aktuelle_frage+1])) {
    echo '<div class="row">
<div class="col">
<button class="btn btn-primary">Okay, weiter geht\'s!</button>
</div>
</div>';
}
?>
</form>
  </body>
</html>

