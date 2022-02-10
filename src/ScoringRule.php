<?php

namespace Vdebes\KataGreed;

use Vdebes\KataGreed\DiceValuesCounts;

interface ScoringRule
{
    public function getNumberOfDiceHandled(): int;

    /**
     * @param DiceValuesCounts $diceValuesCounts
     *
     * @return array{score: int, remainingDice: DiceValuesCounts}
     */
    public function score(DiceValuesCounts $diceValuesCounts): array;
}
