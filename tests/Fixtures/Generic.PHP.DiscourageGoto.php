<?php

$a = 3;

start:

if (($a -= 1) > 0) {
    goto start;
}

echo $a;
