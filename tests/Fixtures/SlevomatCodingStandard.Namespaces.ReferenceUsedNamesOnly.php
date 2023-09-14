<?php

namespace Tests\Fixtures;

function a(\PHPUnit\Framework\MockObject\MockBuilder $mock): bool
{
    return class_exists($mock);
}
