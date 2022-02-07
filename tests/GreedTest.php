<?php

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\Greed;

class GreedTest extends TestCase
{
    public function testGreed(): void
    {
        self::assertIsObject(new Greed());
    }

    public function testInput(): void
    {
        $someValue = 42;
        $greed = new Greed();
        $greed->score($someValue);
        self::expectException(\Exception::class);
    }
}
