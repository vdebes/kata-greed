<?php

namespace Vdebes\KataGreed;

class Greed
{
    /**
     * @var array<int, ScoringRule>
     */
    private array $scoringRules;

    public function __construct(ScoringRule ...$scoringRules)
    {
        usort(
            $scoringRules,
            function (ScoringRule $scoringRule1, ScoringRule $scoringRule2): int {
                return $scoringRule2->getNumberOfDiceHandled() <=> $scoringRule1->getNumberOfDiceHandled();
            }
        );

        $this->scoringRules = $scoringRules;
    }

    /**
     * @param array{0: int, 1: int, 2: int, 3: int, 4: int, 5: int} $dice
     */
    public function score(array $dice): int
    {
        $diceValuesCount = DiceValuesCounts::buildFromDice(...$dice);

        $score = 0;

        foreach ($this->scoringRules as $scoringRule) {
            $scoring = $scoringRule->score($diceValuesCount);

            $score += $scoring['score'];
            /** @var DiceValuesCounts $diceValuesCount */
            $diceValuesCount = $scoring['remainingDice'];

            if (count($diceValuesCount->getDice()) === 0) {
                return $score;
            }
        }

        $score += self::scoreDiceValue(1, $diceValuesCount->getNumberOf1());
        $score += self::scoreDiceValue(2, $diceValuesCount->getNumberOf2());
        $score += self::scoreDiceValue(3, $diceValuesCount->getNumberOf3());
        $score += self::scoreDiceValue(4, $diceValuesCount->getNumberOf4());
        $score += self::scoreDiceValue(5, $diceValuesCount->getNumberOf5());
        $score += self::scoreDiceValue(6, $diceValuesCount->getNumberOf6());

        return $score;
    }

    private static function scoreDiceValue(int $diceValue, int $diceNumber): int
    {
        switch ($diceValue) {
        case 1:
            if ($diceNumber === 1) {
                return 100;
            }
            if ($diceNumber === 2) {
                return 200;
            }
            if ($diceNumber >= 3) {
                return 1000 * self::getDiceNumberBonus($diceNumber);
            }
            break;
        case 5:
            if ($diceNumber === 1) {
                return 50;
            }
            if ($diceNumber === 2) {
                return 100;
            }
            // Except for when there's only one die 5, 5 dice scores the same as 2, 3, 4 and 6.
        case 2:
        case 3:
        case 4:
        case 6:
            if ($diceNumber >= 3) {
                return 100 * $diceValue * self::getDiceNumberBonus($diceNumber);
            }
            break;
        }

        return 0;
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
