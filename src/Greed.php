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
        return array_sum($this->rolls);
    }
}
