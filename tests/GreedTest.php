<?php

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\Greed;

class GreedTest extends TestCase
{
    /**
     * @dataProvider singlesDataProvider
     * @dataProvider triplesDataProvider
     * @dataProvider forOfAKindDataProvider
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

        yield [
            [1, 1, 2],
            200
        ];

        yield [
            [5, 2],
            50
        ];

        yield [
            [5, 1, 5],
            200
        ];
    }

    public function triplesDataProvider(): \Generator
    {
        yield [
            [1, 1, 1, 2],
            1000
        ];

        yield [
            [1, 1, 1, 2, 2, 2],
            1200
        ];

        yield [
            [3, 3, 3],
            300
        ];

        yield [
            [4, 4, 4],
            400
        ];
    }

    public function forOfAKindDataProvider(): \Generator
    {
        yield [
            [1, 1, 1, 1],
            2200
        ];

        yield [
            [1, 1, 1, 1, 1],
            4800
        ];
    }
}
