<!DOCTYPE html>
<html>

<body>
<h2>Vul je naam en leeftijd in:</h2>
<form method="post">
    <input type="text" name="naam" placeholder="Naam">
    <input type="number" name="leeftijd" placeholder="Leeftijd">
    <input type="submit" value="Verstuur">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = isset($_POST["naam"]) ? $_POST["naam"] : "";
    $leeftijd = isset($_POST["leeftijd"]) ? $_POST["leeftijd"] : 0;

    // Druk de naam af het aantal keer dat hij/zij oud is
    for ($i = 0; $i < $leeftijd; $i++) {
        echo $naam . "<br>";
    }
}
?>
</body>
</html>