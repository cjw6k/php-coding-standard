<?php

namespace Tests\Fixtures;

class A
{
    private function __construct()
    {
        echo $this->a;
    }

    protected string $a = 'a';
}
