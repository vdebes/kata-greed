<?php

namespace Vdebes\KataGreed;

class Greed
{
    /** @var int[] */
    private array $rolls;

    /**
     * @param int[] $rolls
     */
    public function __construct(array $rolls)
    {
        $this->rolls = $rolls;
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
        $occurences = array_count_values($this->rolls);
        $tripleOnes = array_filter(
            array_map(
                static fn (int $value, int $key) => $key === 1 && $value === 3 ? 1000 : null,
                $occurences,
                array_keys($occurences)
            )
        );

        return $tripleOnes;
    }

    /**
     * @return int[]
     */
    private function getSingles(): array
    {
        $occurences = array_count_values($this->rolls);
        $singleOnes = array_filter(
            array_map(
                static fn (int $value, int $key) => $key === 1 && $value < 3 ? $value * 100 : null,
                $occurences,
                array_keys($occurences)
            )
        );

        return $singleOnes;
    }
}
