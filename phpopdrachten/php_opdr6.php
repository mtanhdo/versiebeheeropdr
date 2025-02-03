<?php

$a = 0;
$b = 1;

while ($a < 1000) {
    echo $a . "\n";
    $temp = $a + $b;
    $a = $b;
    $b = $temp;
}
