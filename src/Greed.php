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
        $triples = $this->getScoreFromTriples();
        $singles = $this->getScoreFromSingles();

        return array_sum(array_merge($singles, $triples));
    }

    /**
     * @return int[]
     */
    private function getScoreFromTriples(): array
    {
        $triples = [];
        $search = [1, 2, 3];
        foreach ($this->occurences as $value => $occurenceCount) {
            if (in_array($value, $search) === true && $occurenceCount === 3) {
                if ($value === 3) {
                    $triples[$value] = 300;
                    continue;
                }
                $triples[$value] = $value === 1 ? 1000 : 200;
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
            if (in_array($value, $search) === true && $occurenceCount < 3) {
                $singles[$value] = $value === 1 ? $occurenceCount * 100 : $occurenceCount * 50;
            }
        }

        return $singles;
    }
}
