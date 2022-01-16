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
        $singleOnes = array_map(static fn (int $roll) => $roll === 1 ? 100 : 0, $this->rolls);

        return array_sum($singleOnes);
    }
}
