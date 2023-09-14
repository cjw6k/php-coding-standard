<?php

namespace Tests\Fixtures;

final class A
{
    private static string $a;

    public function b(): void
    {
        echo static::$a;
    }
}
