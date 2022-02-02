<?php

namespace Vdebes\KataGreed;

class Greed
{
    /**
     * @param array{0: int, 1: int, 2: int, 3: int, 4: int, 5: int} $dice
     */
    public function score(array $dice): int
    {
        $diceCounts = self::countRollsResults(...$dice);

        if ((array_count_values($diceCounts)[2] ?? 0) >= 3) {
            return 800;
        }

        if ((array_count_values($diceCounts)[1] ?? 0) === 6) {
            return 1200;
        }

        $score = 0;

        $diceValuesCount = array_count_values($diceCounts);
        if (
            ($diceValuesCount[1] ?? 0) === 4
            && (
                !array_key_exists(1, $diceCounts)
                || !array_key_exists(6, $diceCounts)
            )
        ) {
            $score += 600;
            $dice = [array_search(2, $diceCounts)];
            $diceCounts = self::countRollsResults(...$dice);
        }

        foreach ($diceCounts as $diceValue => $diceNumber) {
            $score += self::scoreDiceValue($diceValue, $diceNumber);
        }

        return $score;
    }

    /**
     * Count number of dice for each of the 6 values
     *
     * @return array{1: int, 2: int, 3: int, 4: int, 5: int, 6: int}
     */
    private static function countRollsResults(int ...$rollsResults): array
    {
        $diceCount = array_fill_keys([1, 2, 3, 4, 5, 6], 0);

        $rollsCount = array_count_values($rollsResults);
        foreach ($diceCount as $diceValue => $diceNumber) {
            if (array_key_exists($diceValue, $rollsCount) === false) {
                continue;
            }

            $diceCount[$diceValue] = $rollsCount[$diceValue];
        }

        return $diceCount;
    }

    private static function scoreDiceValue(int $diceValue, int $diceNumber): int
    {
        switch ($diceValue) {
            case 1:
                if ($diceNumber === 1) {
                    return 100;
                }
                if ($diceNumber === 2) {
                    return 200;
                }
                if ($diceNumber >= 3) {
                    return 1000 * self::getDiceNumberBonus($diceNumber);
                }
                break;
            case 5:
                if ($diceNumber === 1) {
                    return 50;
                }
                if ($diceNumber === 2) {
                    return 100;
                }
                // Except for when there's only one die 5, 5 dice scores the same as 2, 3, 4 and 6.
            case 2:
            case 3:
            case 4:
            case 6:
                if ($diceNumber >= 3) {
                    return 100 * $diceValue * self::getDiceNumberBonus($diceNumber);
                }
                break;
        }

        return 0;
    }

    private static function getDiceNumberBonus(int $diceNumber): int
    {
        if ($diceNumber === 3) {
            return 1;
        }

        if ($diceNumber === 4) {
            return 2;
        }

        if ($diceNumber === 5) {
            return 4;
        }

        if ($diceNumber === 6) {
            return 10;
        }

        return 0;
    }
}
