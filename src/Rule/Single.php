<?php

namespace Vdebes\KataGreed\Rule;

class Single
{
    /**
     * @param array<int, int> $occurences
     * @return int[]
     */
    public function getPoints(array $occurences): array
    {
        $singles = [];
        $search = [1, 5];
        foreach ($occurences as $value => $occurenceCount) {
            if (in_array($value, $search) === true) {
                $singles[$value] = $value === 1 ? $occurenceCount * 100 : $occurenceCount * 50;
            }
        }

        return $singles;
    }
}
