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
    
    <title>Schatzsuche!</title>
  </head>
  <body>
    <h3>Schatzsuche: Schritt <?php echo $aktuelle_frage; ?></h3>

<?php
echo '<form action="hinweis.php?schritt='.$aktuelle_frage.'" method="post">';

$hinweis = null;
if ($aktuelle_frage > 1 && isset($schritt[$aktuelle_frage-1]["hinweis"])) {
    $hinweis = $schritt[$aktuelle_frage-1]["hinweis"];
}
if ($hinweis) {
    // Blende den Hinweis der vergangenen Frage ein
    echo '<div class="row hinweis">
    <div class="col"><em>Zur Erinnerung, der vergangene Hinweis:</em><br>
    '.nl2br($hinweis).'</div>
    </div>';
}

if ($fehler) {
    echo '<div class="row error"><div class="col">Das war leider nicht die richtige Antwort!</div></div>';
}

echo '<div class="row frage"><div class="col">'.nl2br($schritt[$aktuelle_frage]["frage"]).'</div></div>
<div class="eingabe row">
<div class="col">
    <label for="antwort">Deine Antwort: </label>
</div>
<div class="col">
    ';
if (is_numeric($schritt[$aktuelle_frage]['richtig'])) {
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

?>
</form>
  </body>
</html>

