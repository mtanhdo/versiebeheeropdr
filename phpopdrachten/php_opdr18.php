<?php
if (isset($_POST['submit'])) {
    $content = $_POST['textarea'];
    $fp = fopen("opdracht17.txt", "w");
    fwrite($fp, $content);
    fclose($fp);
} else {
    if (file_exists("opdracht17.txt")) {
        $fp = fopen("opdracht17.txt", "r");
        $content = fread($fp, filesize("opdracht17.txt"));
        fclose($fp);
    } else {
        $content = "";
    }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <textarea name="textarea" rows="4" cols="50"><?php echo $content;?></textarea><br>
    <input type="submit" name="submit" value="Verzenden">
</form>
