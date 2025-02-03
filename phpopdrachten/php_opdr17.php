<?php
if (isset($_POST['submit'])) {
    $content = $_POST['textarea'];
    $fp = fopen("opdracht17.txt", "w");
    fwrite($fp, $content);
    fclose($fp);
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <textarea name="textarea" rows="4" cols="50"></textarea><br>
    <input type="submit" name="submit" value="Verzenden">
</form>