<?php

namespace Vdebes\KataGreed;

class Sequence
{
    /**
     * @param int[] $rolls
     */
    public function __construct(array $rolls)
    {
        $count = count($rolls);
        $invalidDie = array_filter($rolls, static fn (int $score) => $score < 1 || $score > 6);
        if ($count < 3 || $count > 6 || empty($invalidDie) === false) {
            throw new \InvalidArgumentException('Invalid die roll sequence');
        }
    }
}