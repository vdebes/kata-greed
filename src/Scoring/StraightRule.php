<?php

namespace Vdebes\KataGreed\Scoring;

use Vdebes\KataGreed\DiceValuesCounts;
use Vdebes\KataGreed\ScoringRule;

class StraightRule implements ScoringRule
{
    public function getNumberOfDiceHandled(): int
    {
        return 6;
    }

    public function score(DiceValuesCounts $diceValuesCounts): array
    {
        if ($diceValuesCounts->getNumberOfUniqueDiceValue() === 6) {
            return [
                'score' => 1200,
                'remainingDice' => DiceValuesCounts::buildFromDice(),
            ];
        }

        return [
            'score' => 0,
            'remainingDice' => $diceValuesCounts,
        ];
    }
}
