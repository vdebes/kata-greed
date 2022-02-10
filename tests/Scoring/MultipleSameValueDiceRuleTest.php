<?php

namespace Scoring;

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\Scoring\MultipleSameValueDiceRule;

class MultipleSameValueDiceRuleTest extends TestCase
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
        $scoringRule = new MultipleSameValueDiceRule();

        $scoring = $scoringRule->score($diceCounts);

        self::assertSame($expectedScoring, $scoring['score']);
        self::assertSame($expectedRemainingDice, $scoring['remainingDice']->getDice());
    }

    /**
     * @return \Generator<string, array{0: DiceValuesCounts, 1: int, 2: int[]}, void, void>
     */
    public function getScoringTestCaseDataProvider(): \Generator
    {
        foreach (range(1, 6) as $diceValue) {
            yield "one $diceValue" => [
                DiceValuesCounts::buildFromDice($diceValue),
                0,
                [$diceValue],
            ];

            yield "two $diceValue" => [
                DiceValuesCounts::buildFromDice($diceValue, $diceValue),
                0,
                [$diceValue, $diceValue],
            ];
        }

        yield 'three 1' => [
            DiceValuesCounts::buildFromDice(1, 1, 1),
            1000,
            [],
        ];

        yield 'three 2' => [
            DiceValuesCounts::buildFromDice(2, 2, 2),
            200,
            [],
        ];

        yield 'three 3' => [
            DiceValuesCounts::buildFromDice(3, 3, 3),
            300,
            [],
        ];

        yield 'three 4' => [
            DiceValuesCounts::buildFromDice(4, 4, 4),
            400,
            [],
        ];

        yield 'three 5' => [
            DiceValuesCounts::buildFromDice(5, 5, 5),
            500,
            [],
        ];

        yield 'three 6' => [
            DiceValuesCounts::buildFromDice(6, 6, 6),
            600,
            [],
        ];

        yield 'four 1' => [
            DiceValuesCounts::buildFromDice(1, 1, 1, 1),
            2000,
            [],
        ];

        yield 'four 2' => [
            DiceValuesCounts::buildFromDice(2, 2, 2, 2),
            400,
            [],
        ];

        yield 'four 3' => [
            DiceValuesCounts::buildFromDice(3, 3, 3, 3),
            600,
            [],
        ];

        yield 'four 4' => [
            DiceValuesCounts::buildFromDice(4, 4, 4, 4),
            800,
            [],
        ];

        yield 'four 5' => [
            DiceValuesCounts::buildFromDice(5, 5, 5, 5),
            1000,
            [],
        ];

        yield 'four 6' => [
            DiceValuesCounts::buildFromDice(6, 6, 6, 6),
            1200,
            [],
        ];

        yield 'five 1' => [
            DiceValuesCounts::buildFromDice(1, 1, 1, 1, 1),
            4000,
            [],
        ];

        yield 'five 2' => [
            DiceValuesCounts::buildFromDice(2, 2, 2, 2, 2),
            800,
            [],
        ];

        yield 'five 3' => [
            DiceValuesCounts::buildFromDice(3, 3, 3, 3, 3),
            1200,
            [],
        ];

        yield 'five 4' => [
            DiceValuesCounts::buildFromDice(4, 4, 4, 4, 4),
            1600,
            [],
        ];

        yield 'five 5' => [
            DiceValuesCounts::buildFromDice(5, 5, 5, 5, 5),
            2000,
            [],
        ];

        yield 'five 6' => [
            DiceValuesCounts::buildFromDice(6, 6, 6, 6, 6),
            2400,
            [],
        ];

        yield 'six 1' => [
            DiceValuesCounts::buildFromDice(1, 1, 1, 1, 1, 1),
            10000,
            [],
        ];

        yield 'six 2' => [
            DiceValuesCounts::buildFromDice(2, 2, 2, 2, 2, 2),
            2000,
            [],
        ];

        yield 'six 3' => [
            DiceValuesCounts::buildFromDice(3, 3, 3, 3, 3, 3),
            3000,
            [],
        ];

        yield 'six 4' => [
            DiceValuesCounts::buildFromDice(4, 4, 4, 4, 4, 4),
            4000,
            [],
        ];

        yield 'six 5' => [
            DiceValuesCounts::buildFromDice(5, 5, 5, 5, 5, 5),
            5000,
            [],
        ];

        yield 'six 6' => [
            DiceValuesCounts::buildFromDice(6, 6, 6, 6, 6, 6),
            6000,
            [],
        ];

        yield 'three with remaining' => [
            DiceValuesCounts::buildFromDice(2, 2, 3, 4, 5, 2),
            200,
            [3, 4, 5],
        ];

        yield 'four with remaining' => [
            DiceValuesCounts::buildFromDice(2, 2, 3, 4, 2, 2),
            400,
            [3, 4],
        ];

        yield 'five with remaining' => [
            DiceValuesCounts::buildFromDice(2, 2, 3, 2, 2, 2),
            800,
            [3],
        ];
    }
}