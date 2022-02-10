<?php

namespace Vdebes\KataGreed\Scoring;

use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\ScoringRule;

class Two1Rule implements ScoringRule
{
    public function getNumberOfDiceHandled(): int
    {
        return 2;
    }

    public function score(DiceValuesCounts $diceValuesCounts): array
    {
        if ($diceValuesCounts->getNumberOf1() === 2) {
            return [
                'score' => 200,
                'remainingDice' => $diceValuesCounts->removeDice(1, 1),
            ];
        }

        return [
            'score' => 0,
            'remainingDice' => $diceValuesCounts,
        ];
    }
}
