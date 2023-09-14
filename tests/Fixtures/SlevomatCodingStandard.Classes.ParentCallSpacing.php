<?php

namespace Tests\Fixtures;

use DateTime;

class A extends DateTime
{
    public function __construct()
    {
        echo 0;
        parent::__construct();
        echo 0;
    }
}
