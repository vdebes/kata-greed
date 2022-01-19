<?php

namespace Vdebes\KataGreed\Rule;

final class Straight
{
    public function getPoints(array $occurences): int
    {
        return count($occurences) === 6 ? 1200 : 0;
    }
}
