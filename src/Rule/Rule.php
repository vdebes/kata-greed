<?php

namespace Vdebes\KataGreed\Rule;

interface Rule
{
    /**
     * @param array<int, int> $occurences
     */
    public function getPoints(array $occurences): int;
}
