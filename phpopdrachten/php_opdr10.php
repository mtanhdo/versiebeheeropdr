<pre>
<?php

$alles = scandir("img/back");
$alles = array_slice($alles, 2);

$files = glob("img/back/*");
foreach($files as $bestand) {
    echo '<a href="'. $bestand. '">'. $bestand. '</a><br>';
}
?>
</pre>