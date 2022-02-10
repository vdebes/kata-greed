<?php

namespace Vdebes\KataGreed\Scoring;

use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\ScoringRule;

class SmallStraightRule implements ScoringRule
{
    public function getNumberOfDiceHandled(): int
    {
        return 5;
    }

    public function score(DiceValuesCounts $diceValuesCounts): array
    {
        $nbOfUnique = $diceValuesCounts->getNumberOfUniqueDiceValue();
        $nbOf1 = $diceValuesCounts->getNumberOf1();
        $nbOf6 = $diceValuesCounts->getNumberOf6();

        if ($nbOfUnique === 4 && ($nbOf1 === 0 || $nbOf6 === 0)) {
            $remainingDice = array_merge(
                $diceValuesCounts->getNumberOf1() === 2 ? [1] : [],
                $diceValuesCounts->getNumberOf2() === 2 ? [2] : [],
                $diceValuesCounts->getNumberOf3() === 2 ? [3] : [],
                $diceValuesCounts->getNumberOf4() === 2 ? [4] : [],
                $diceValuesCounts->getNumberOf5() === 2 ? [5] : [],
                $diceValuesCounts->getNumberOf6() === 2 ? [6] : [],
            );

            return [
                'score' => 600,
                'remainingDice' => DiceValuesCounts::buildFromDice(...$remainingDice),
            ];
        }

        return [
            'score' => 0,
            'remainingDice' => $diceValuesCounts,
        ];
    }
}
