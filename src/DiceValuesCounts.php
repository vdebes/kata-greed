<?php

namespace Vdebes\KataGreed;

class DiceValuesCounts
{
    /** @var int[] */
    private array $dice;
    /** @var array{1: int, 2: int, 3: int, 4: int, 5: int, 6: int} */
    private array $valuesCount;

    /**
     * @param int[] $dice
     * @param array{1: int, 2: int, 3: int, 4: int, 5: int, 6: int} $valuesCount
     */
    private function __construct(
        array $dice,
        array $valuesCount
    ) {
        $this->dice = $dice;
        $this->valuesCount = $valuesCount;
    }

    public static function buildFromDice(int ...$dice): self
    {
        return new self($dice, self::countDiceValues(...$dice));
    }

    /**
     * @return array{1: int, 2: int, 3: int, 4: int, 5: int, 6: int}
     */
    private static function countDiceValues(int ...$dice): array
    {
        $valuesCount = array_fill_keys([1, 2, 3, 4, 5, 6], 0);

        $diceValuesCount = array_count_values($dice);
        foreach ($valuesCount as $diceValue => $diceNumber) {
            if (array_key_exists($diceValue, $diceValuesCount) === false) {
                continue;
            }

            $valuesCount[$diceValue] = $diceValuesCount[$diceValue];
        }

        return $valuesCount;
    }

    /** @return int[] */
    public function getDice(): array
    {
        return $this->dice;
    }

    public function getNumberOf1(): int
    {
        return $this->valuesCount[1];
    }

    public function getNumberOf2(): int
    {
        return $this->valuesCount[2];
    }

    public function getNumberOf3(): int
    {
        return $this->valuesCount[3];
    }

    public function getNumberOf4(): int
    {
        return $this->valuesCount[4];
    }

    public function getNumberOf5(): int
    {
        return $this->valuesCount[5];
    }

    public function getNumberOf6(): int
    {
        return $this->valuesCount[6];
    }

    public function getNumberOfPairs(): int
    {
        return array_count_values($this->valuesCount)[2] ?? 0;
    }

    public function getNumberOfUniqueDiceValue(): int
    {
        return array_count_values($this->valuesCount)[1] ?? 0;
    }

    public function removeDice(int ...$dice): self
    {
        $existingDice = $this->dice;

        foreach ($dice as $die) {
            $key = array_search($die, $existingDice);
            if ($key === false) {
                throw new \RuntimeException('Cannot remove a missing die.');
            }

            unset($existingDice[$key]);
        }

        return self::buildFromDice(...array_values($existingDice));
    }
}
