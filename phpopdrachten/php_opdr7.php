<!DOCTYPE html>
<html>

<body>
<h2>Vul een HTML-kleurcode in:</h2>
<form method="post">
    <input type="text" name="kleur" placeholder="bijv. #ff0000">
    <input type="submit" value="Verstuur">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kleur = isset($_POST["kleur"]) ? $_POST["kleur"] : "";

    // controleert of het een geldige html-kleur is
    if (preg_match('/^#[a-f0-9]{6}$/i', $kleur)) {
        echo '<script>document.body.style.backgroundColor = "' . $kleur . '";</script>';
    } else {
        echo "Ongeldige kleurcode. Voer een geldige HTML-kleurcode in.";
    }
}
?>
</body>
</html>
