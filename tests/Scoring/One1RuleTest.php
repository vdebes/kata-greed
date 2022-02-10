<?php

namespace Scoring;

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\Scoring\One1Rule;

class One1RuleTest extends TestCase
{
    /**
     * @param int[] $expectedRemainingDice
     *
     * @dataProvider getScoringTestCaseDataProvider
     */
    public function testScoring(
        DiceValuesCounts $diceCounts,
        int $expectedScoring,
        array $expectedRemainingDice
    ): void {
        $scoringRule = new One1Rule();

        $scoring = $scoringRule->score($diceCounts);

        self::assertSame($expectedScoring, $scoring['score']);
        self::assertSame($expectedRemainingDice, $scoring['remainingDice']->getDice());
    }

    /**
     * @return \Generator<string, array{0: DiceValuesCounts, 1: int, 2: int[]}, void, void>
     */
    public function getScoringTestCaseDataProvider(): \Generator
    {
        yield 'one 1' => [
            DiceValuesCounts::buildFromDice(1),
            100,
            []
        ];

        yield 'one 2' => [
            DiceValuesCounts::buildFromDice(2),
            0,
            [2]
        ];

        yield 'one 3' => [
            DiceValuesCounts::buildFromDice(3),
            0,
            [3]
        ];

        yield 'one 4' => [
            DiceValuesCounts::buildFromDice(4),
            0,
            [4]
        ];

        yield 'one 5' => [
            DiceValuesCounts::buildFromDice(5),
            0,
            [5]
        ];

        yield 'one 6' => [
            DiceValuesCounts::buildFromDice(6),
            0,
            [6]
        ];

        yield 'two 1' => [
            DiceValuesCounts::buildFromDice(1, 1),
            0,
            [1, 1]
        ];

        yield 'two 5' => [
            DiceValuesCounts::buildFromDice(5, 5),
            0,
            [5, 5]
        ];

        yield 'three 1' => [
            DiceValuesCounts::buildFromDice(1, 1, 1),
            0,
            [1, 1, 1]
        ];

        yield 'three 5' => [
            DiceValuesCounts::buildFromDice(5, 5, 5),
            0,
            [5, 5, 5]
        ];
    }
}