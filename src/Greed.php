<?php

namespace Vdebes\KataGreed;

class Greed
{
    /**
     * @param int[] $dices
     */
    public function score(array $dices): int
    {
        if (count($dices) > 6) {
            throw new \Exception('too much dice');
        }

        $count = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
        ];

        foreach ($dices as $dice) {
            $count[$dice] = isset($count[$dice]) ? $count[$dice] + 1 : 1;
        }

        $score = 0;

        if ($count[1] === 1) {
            $score += 100;
        }

        if ($count[5] === 1) {
            $score += 50;
        }

        if ($count[1] === 3) {
            $score += 1000;
        }

        if ($count[2] === 3) {
            $score += 200;
        }

        if ($count[3] === 3) {
            $score += 300;
        }

        if ($count[4] === 3) {
            $score += 400;
        }

        if ($count[5] === 3) {
            $score += 500;
        }

        if ($count[6] === 3) {
            $score += 600;
        }

        if (
            $count[6] === 1 &&
            $count[5] === 1 &&
            $count[4] === 1 &&
            $count[3] === 1 &&
            $count[2] === 1 &&
            $count[1] === 1
        ) {
            $score += 1200;
        }

        return $score;
    }
}
