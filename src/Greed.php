<?php

namespace Vdebes\KataGreed;

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
        $multiplier = $this->getMultiplier();
        $triples = $this->getScoreFromTriples();
        $singles = $this->getScoreFromSingles();

        return array_sum(array_merge($singles, $triples)) * $multiplier;
    }

    /**
     * @return int[]
     */
    private function getScoreFromTriples(): array
    {
        $triples = [];
        $search = [1, 2, 3, 4];
        foreach ($this->occurences as $value => $occurenceCount) {
            if ($occurenceCount >= 3 && in_array($value, $search) === true) {
                $triples[$value] = $value * 100;
                if ($value === 1) {
                    $triples[$value] = 1000;
                }
                $this->occurences[$value] -= 3;
            }
        }

        return $triples;
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
        }

        return 1;
    }
}
