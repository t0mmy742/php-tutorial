<?php

declare(strict_types=1);

namespace T0mmy742\PHPTutorial\Tests;

use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    public function test1(): void
    {
        $this->assertSame(2, 1 + 1);
    }
}
