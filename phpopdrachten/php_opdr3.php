<?php

$number = 6;
if (($number >= 0) && ($number <=10)) {
    if ($number > 5.5) {
        echo "Voldoende!";
    } else {
        echo "Onvoldoende";
    }
} else {
    echo "Foutieve Invoer.";
}