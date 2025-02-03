<?php

$inhoud = file_get_contents('img/content.txt');
file_put_contents("kopie.txt", $inhoud);