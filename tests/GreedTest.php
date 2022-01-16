<?php

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\Greed;

class GreedTest extends TestCase
{
    public function testGreed(): void
    {
        $testedInstance = new Greed();
        self::assertIsObject($testedInstance);
        self::assertIsInt($testedInstance->getScore());
    }
}
