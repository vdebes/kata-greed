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
        $tripleOnes = $this->getTriples();

        $singleOnes = [];
        if (empty($tripleOnes) === true) {
            $singleOnes = $this->getSingles();
        }
        $singleFives = array_map(static fn (int $roll) => $roll === 5 ? 50 : 0, $this->rolls);

        return array_sum(array_merge($singleOnes, $singleFives, $tripleOnes));
    }

    /**
     * @return int[]
     */
    private function getTriples(): array
    {
        $triples = [];
        $search = [1];
        foreach ($this->occurences as $value => $occurenceCount) {
            if (in_array($value, $search) === true && $occurenceCount === 3) {
                $triples[$value] = 1000;
            }
        }

        return $triples;
    }

    /**
     * @return int[]
     */
    private function getSingles(): array
    {
        $singleOnes = array_filter(
            array_map(
                static fn (int $value, int $key) => $key === 1 && $value < 3 ? $value * 100 : null,
                $this->occurences,
                array_keys($this->occurences)
            )
        );

        return $singleOnes;
    }
}
