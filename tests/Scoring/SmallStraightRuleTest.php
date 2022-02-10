<?php

namespace Scoring;

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\Scoring\SmallStraightRule;

class SmallStraightRuleTest extends TestCase
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
        $scoringRule = new SmallStraightRule();

        $scoring = $scoringRule->score($diceCounts);

        self::assertSame($expectedScoring, $scoring['score']);
        self::assertSame($expectedRemainingDice, $scoring['remainingDice']->getDice());
    }

    /**
     * @return \Generator<string, array{0: DiceValuesCounts, 1: int, 2: int[]}, void, void>
     */
    public function getScoringTestCaseDataProvider(): \Generator
    {
        yield 'straight' => [
            DiceValuesCounts::buildFromDice(1, 2, 3, 4, 5, 6),
            0,
            [1, 2, 3, 4, 5, 6],
        ];

        yield 'three pairs' => [
            DiceValuesCounts::buildFromDice(2, 2, 3, 3, 6, 6),
            0,
            [2, 2, 3, 3, 6, 6],
        ];

        yield 'mixed results' => [
            DiceValuesCounts::buildFromDice(1, 2, 2, 3, 3, 6),
            0,
            [1, 2, 2, 3, 3, 6],
        ];

        yield 'small straight 1' => [
            DiceValuesCounts::buildFromDice(1, 2, 3, 3, 4, 5),
            600,
            [3],
        ];

        yield 'small straight 6' => [
            DiceValuesCounts::buildFromDice( 2, 3, 3, 4, 5, 6),
            600,
            [3],
        ];
    }
}