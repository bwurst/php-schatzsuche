<?php
require("schritte.php");

$aktuelle_frage = 1;

if (isset($_REQUEST['schritt']) && isset($schritt[(int) $_REQUEST['schritt']])) {
    $aktuelle_frage = (int) $_REQUEST['schritt'];
}

$fehler = false;
if (isset($_REQUEST['fehler'])) {
    $fehler = true;
}

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
    
    <title><?php echo $title;?></title>
  </head>
  <body>
    <h3><?php echo "$title: Schritt $aktuelle_frage"; ?></h3>

<?php
echo '<form action="hinweis.php?schritt='.$aktuelle_frage.'" method="post">';

$hinweis = null;
if (isset($schritt[$aktuelle_frage-1]["hinweis"])) {
    $hinweis = $schritt[$aktuelle_frage-1]["hinweis"];
}
if ($hinweis) {
    // Blende den Hinweis der vergangenen Frage ein
    echo '<div class="row hinweis">
    <div class="col"><p><em>Hinweis zur nächsten Station:</em></p>';
    echo '<p>'.nl2br($hinweis).'</p>';
    if (isset($schritt[$aktuelle_frage-1]["bildhinweis"])) {
        $imgfile = $schritt[$aktuelle_frage-1]["bildhinweis"];
        if (file_exists($imgfile)) {
            echo '<img src="'.$imgfile.'" style="max-width: 100%;">';
        }
    }
    if (isset($schritt[$aktuelle_frage-1]["coord"])) {
        $c = $schritt[$aktuelle_frage-1]["coord"];
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

if ($fehler) {
    echo '<div class="row error"><div class="col">Das war leider nicht die richtige Antwort!</div></div>';
}

if ($schritt[$aktuelle_frage]["frage"]) {

    echo '<div class="row frage"><div class="col">'.nl2br($schritt[$aktuelle_frage]["frage"]).'</div></div>
    <div class="eingabe row">
    <div class="col">
        <label for="antwort">Deine Antwort: </label>
    </div>
    <div class="col">
        ';
    if (is_int($schritt[$aktuelle_frage]['richtig'])) {
        echo '    <input type="number" id="antwort" name="antwort" size="15"></p>';
    } else {
        echo '    <input type="text" id="antwort" name="antwort" size="15"></p>';
    }
    echo '
    </div>
    </div>
    <div class="row">
    <div class="col">
    &nbsp;
    </div>
    <div class="col">
    <button type="submit" value="Antwort prüfen!" class="btn btn-primary">Antwort prüfen</button>
    </div>
    </div>';

} else {
    echo '
    <div class="row">
    <div class="col">
    &nbsp;
    </div>
    <div class="col">
    <button type="submit" value="'.$schritt[$aktuelle_frage]['richtig'].'" class="btn btn-primary">'.$schritt[$aktuelle_frage]['richtig'].'</button>
    </div>
    </div>';

}
?>
</form>
  </body>
</html>

