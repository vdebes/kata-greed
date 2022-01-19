<?php

namespace Vdebes\KataGreed\Rule;

final class Straight
{
    /**
     * @param array<int, int> $occurences
     */
    public function getPoints(array $occurences): int
    {
        return count($occurences) === 6 ? 1200 : 0;
    }
}
