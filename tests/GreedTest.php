<?php

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\Greed;

class GreedTest extends TestCase
{
    public function testGreed(): void
    {
        self::assertIsObject(new Greed());
    }

    /**
     * @dataProvider diceProvider
     */
    public function testInput(array $input, int $expectedResult): void
    {
        $greed = new Greed();
        $score = $greed->score($input);

        $this->assertEquals($expectedResult, $score);
    }

    public function diceProvider(): \Generator
    {
        
        yield 'single one' => [
            [1, 3, 6], 100
        ];

        yield 'single five' => [
            [2, 5, 6], 50
        ];

        yield 'triple ones' => [
            [1, 1, 1], 1000
        ];

        yield 'triple twos' => [
            [2, 2, 2], 200
        ];

        yield 'triple threes' => [
            [3, 3, 3], 300
        ];

        yield 'triple fours' => [
            [4, 4, 4], 400
        ];

        yield 'triple fives' => [
            [5, 5, 5], 500
        ];

        yield 'triple sixes' => [
            [6, 6, 6], 600
        ];

        yield 'Straight' => [
            [1, 2, 3, 4, 5, 6], 1200
        ];

        yield 'Three Pairs [2,2,3,3,4,4] (800)' => [
            [2, 2, 3, 3, 4, 4], 800
        ];
    }
}
