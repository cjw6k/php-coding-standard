<?php

namespace Tests\Fixtures;

use Throwable;
use DateTime;

try {
    $dt = new DateTime();
    echo $dt->format('c');
} catch (Throwable $e) {
    echo $e->getMessage();
}
