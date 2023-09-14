<?php

namespace Tests\Fixtures;

class A
{
    public function b(): void
    {
        $a = new self();
        echo $a->__invoke();
    }

    public function __invoke(): int
    {
        return 0;
    }
}
