<?php

namespace Tests\Fixtures;

use DateTime;

class Foo extends DateTime
{
    public function __construct(string $datetime, string $timezone)
    {
        parent::__construct($datetime, $timezone);
    }
}
