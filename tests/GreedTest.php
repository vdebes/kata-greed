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
        $rolls = [];
        $testedInstance = new Greed($rolls);

        self::assertEquals(array_sum($rolls), $testedInstance->getScore());
    }

    /**
     * @dataProvider singlesDataProvider
     */
    public function test it calculates scores from singles(array $rolls, int $expectedResult): void
    {
        $testedInstance = new Greed($rolls);

        self::assertEquals($expectedResult, $testedInstance->getScore());
    }

    public function singlesDataProvider(): \Generator
    {
        yield [
            [1, 2],
            100
        ];
    }
}
