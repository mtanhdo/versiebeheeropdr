<pre>
    <?php
    $bestandsplek = 'img/content.txt';
    if (file_exists($bestandsplek) && is_readable($bestandsplek)) {
        $inhoud = file_get_contents($bestandsplek);
        echo "<textarea rows='10' cols='50'>$inhoud</textarea>"; }
    ?>
</pre>