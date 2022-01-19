<?php

namespace Vdebes\KataGreed\Rule;

class ThreePairs
{
    /**
     * @param array<int, int> $occurences
     */
    public function getPoints(array $occurences): int
    {
        $pairs = array_filter($occurences, fn (int $count) => $count === 2);
        if (count($pairs) === 3) {
            return 800;
        }

        return 0;
    }
}
