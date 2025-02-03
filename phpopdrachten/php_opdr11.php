<pre>
<?php

$alles = scandir("img/back");
$alles = array_slice($alles, 2);

$files = glob("img/back/*");
foreach($files as $bestand) {
    $filename = basename($bestand);
    echo '<a href="?file='. urlencode($filename). '">'. $filename. '</a><br>';
}

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filepath = "img/back/back_". $file. ".png";
    if (file_exists($filepath)) {
        echo '<img src="'. $filepath. '" alt="'. $file. '">';
    } else {
        echo 'Bestand niet gevonden.';
    }
}

?>
</pre>
