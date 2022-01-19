<?php

namespace Vdebes\KataGreed\Rule;

final class Single implements Rule
{
    /**
     * @param array<int, int> $occurences
     */
    public function getPoints(array $occurences): int
    {
        $singles = [];
        $search = [1, 5];
        foreach ($occurences as $value => $occurenceCount) {
            if (in_array($value, $search) === true) {
                $singles[$value] = $value === 1 ? $occurenceCount * 100 : $occurenceCount * 50;
            }
        }

        return array_sum($singles);
    }
}
