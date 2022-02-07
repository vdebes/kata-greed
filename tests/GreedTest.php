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

    public function diceProvider(): array
    {
        return [
            [
                [1, 3, 6], 100
            ],
            [
                [2, 5, 6], 50
            ],
            [
                [1, 1, 1], 1000
            ],
            [
                [5, 5, 5], 500
            ],
        ];
    }
}
