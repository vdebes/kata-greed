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
        $occurences = array_count_values($this->rolls);
        $tripleOnes = array_filter(
            array_map(
                static fn (int $value, int $key) => $key === 1 && $value === 3 ? 1000 : null,
                $occurences,
                array_keys($occurences)
            )
        );

        $singleOnes = [];
        if (empty($tripleOnes) === true) {
            $singleOnes = array_map(static fn (int $roll) => $roll === 1 ? 100 : 0, $this->rolls);
        }
        $singleFives = array_map(static fn (int $roll) => $roll === 5 ? 50 : 0, $this->rolls);

        return array_sum(array_merge($singleOnes, $singleFives, $tripleOnes));
    }
}
