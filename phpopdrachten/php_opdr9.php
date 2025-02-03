<!DOCTYPE html>
<html>

<body>
<h2>Vul een getal in:</h2>
<form method="post">
    <input type="number" name="getal" placeholder="Getal">
    <input type="submit" value="Verstuur">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $getal = $_POST["getal"] ?? 0;

    if ($getal != "") {
        echo "<h3>Tafel van $getal:</h3>";
        for ($i = 1; $i <= 10; $i++) {
            echo "$getal x $i = " . ($getal * $i) . "<br>";
        }
    } else {
        echo "Voer een getal in.";
    }
}
?>
</body>
</html>
