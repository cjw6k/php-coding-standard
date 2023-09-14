<?php

namespace Tests\Fixtures;

class A
{
    public function b(): void
    {
        echo 0;
    }

    private static function c(): int
    {
        return $this->b();
    }
}
