<?php

namespace Vdebes\KataGreed\Rule;

class Triple
{
    private array $occurencesRemainingToProcess;

    /**
     * @return array<int, int>
     */
    public function getPoints(array $occurences): array
    {
        $triples = [];
        $search = [1, 2, 3, 4, 5, 6];
        foreach ($occurences as $value => $occurenceCount) {
            if ($occurenceCount >= 3 && in_array($value, $search) === true) {
                $occurenceLeft = $occurenceCount % 3;
                /** @var int $occurenceMultiplier */
                $occurenceMultiplier = ($occurenceCount - $occurenceLeft) / 3;

                $triples[$value] = $value * $occurenceMultiplier * 100;
                if ($value === 1) {
                    $triples[$value] = $occurenceMultiplier * 1000;
                }

                $occurences[$value] = $occurenceLeft;
            }
        }

        $this->occurencesRemainingToProcess = $occurences;

        return $triples;
    }

    /**
     * @return array<int, int>
     */
    public function getOccurencesRemainingToProcess(): array
    {
        return $this->occurencesRemainingToProcess;
    }
}
