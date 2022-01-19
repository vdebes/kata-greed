<?php

namespace Vdebes\KataGreed\Rule;

class ThreePairs
{
    /**
     * @param array<int, int> $occurences
     * @return array<int>
     */
    public function getPoints(array $occurences): array
    {
        $pairs = array_filter($occurences, fn (int $count) => $count === 2);
        if (count($pairs) === 3) {
            return [800];
        }

        return [];
    }
}
