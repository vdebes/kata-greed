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

        return $score;
    }
}
