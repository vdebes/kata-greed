<?php

namespace Vdebes\KataGreed\Scoring;

use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\ScoringRule;

class MultipleSameValueDiceRule implements ScoringRule
{
    public function getNumberOfDiceHandled(): int
    {
        return 3;
    }

    public function score(DiceValuesCounts $diceValuesCounts): array
    {
        $score = 0;

        foreach ([1, 2, 3, 4, 5, 6] as $diceValue) {
            $functionName = "getNumberOf$diceValue";
            $diceNumber = $diceValuesCounts->$functionName();
            if ($diceNumber < 3) {
                continue;
            }

            $score += self::getBaseScore($diceValue) * self::getDiceNumberBonus($diceNumber);
            $diceValuesCounts = $diceValuesCounts->removeDice(...array_fill(0, $diceNumber, $diceValue));
        }

        return [
            'score' => $score,
            'remainingDice' => $diceValuesCounts,
        ];
    }

    private static function getBaseScore(int $diceValue): int
    {
        if ($diceValue === 1) {
            return 1000;
        }

        return 100 * $diceValue;
    }

    private static function getDiceNumberBonus(int $diceNumber): int
    {
        if ($diceNumber === 3) {
            return 1;
        }

        if ($diceNumber === 4) {
            return 2;
        }

        if ($diceNumber === 5) {
            return 4;
        }

        if ($diceNumber === 6) {
            return 10;
        }

        return 0;
    }
}
