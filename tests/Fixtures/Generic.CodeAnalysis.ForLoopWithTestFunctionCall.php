<?php

namespace Tests\Fixtures;

use function count;

$a = [1, 2, 3, 4];

for ($i = 0; $i < count($a); $i++) {
    $a[$i] *= $i;
}
