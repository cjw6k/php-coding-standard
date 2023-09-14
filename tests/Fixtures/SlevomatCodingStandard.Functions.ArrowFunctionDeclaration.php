<?php

namespace Tests\Fixtures;

class A
{
    public string $one = '1';

    public function b(): string
    {
        $a = fn()=>$this->one;

        return $a();
    }
}
