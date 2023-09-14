<?php

$b = 0;
$a = static function () use ($b) {
    $c = 0;
    $c += 1;

    return $c;
};

echo $a();
