<?php

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\Greed;

class GreedTest extends TestCase
{
    public function testGreed(): void
    {
        $testedInstance = new Greed([]);
        self::assertIsObject($testedInstance);
        self::assertIsInt($testedInstance->getScore());
    }

    public function test greed is constructed from dice rolls results(): void
    {
        $rolls = [1, 2, 4];
        $testedInstance = new Greed($rolls);

        self::assertEquals(array_sum($rolls), $testedInstance->getScore());
    }
}
