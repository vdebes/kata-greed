<?php

namespace Vdebes\KataGreed;

use Vdebes\KataGreed\Rule\Straight;
use Vdebes\KataGreed\Rule\Triple;

class Greed
{
    /** @var int[] */
    private array $rolls;
    /** @var array<int, int>  */
    private array $occurences;

    /**
     * @param int[] $rolls
     */
    public function __construct(array $rolls)
    {
        $this->rolls = $rolls;
        $this->occurences = array_count_values($this->rolls);
    }

    public function getScore(): int
    {
        $straight = new Straight();
        $score = $straight->getPoints($this->occurences);
        if ($score !== 0) {
            return $score;
        }

        $multiplier = $this->getMultiplier();

        $triple = new Triple();
        $triples = $triple->getPoints($this->occurences);
        $this->occurences = $triple->getOccurencesRemainingToProcess();

        $singles = $this->getScoreFromSingles();
        $threePairs = $this->getScoreFromThreePairs();

        return array_sum(array_merge($singles, $triples, $threePairs)) * $multiplier;
    }

    /**
     * @return array<int>
     */
    private function getScoreFromThreePairs(): array
    {
        $pairs = array_filter($this->occurences, fn (int $count) => $count === 2);
        if (count($pairs) === 3) {
            return [800];
        }

        return [];
    }

    /**
     * @return int[]
     */
    private function getScoreFromSingles(): array
    {
        $singles = [];
        $search = [1, 5];
        foreach ($this->occurences as $value => $occurenceCount) {
            if (in_array($value, $search) === true) {
                $singles[$value] = $value === 1 ? $occurenceCount * 100 : $occurenceCount * 50;
            }
        }

        return $singles;
    }

    private function getMultiplier(): int
    {
        foreach ($this->occurences as $value) {
            if ($value === 4) {
                return 2;
            }
            if ($value === 5) {
                return 4;
            }
            if ($value === 6) {
                return 8;
            }
        }

        return 1;
    }
}
