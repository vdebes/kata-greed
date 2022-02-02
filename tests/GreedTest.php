<?php

use PHPUnit\Framework\TestCase;
use Vdebes\KataGreed\Greed;

class GreedTest extends TestCase
{
    public function testGreed(): void
    {
        self::assertIsObject(new Greed());
    }

    /**
     * @param array{0: int, 1: int, 2: int, 3: int, 4: int, 5: int} $dice
     *
     * @dataProvider getDiceResultTestCases
     */
    public function testGreedScoring(array $dice, int $expectedScore): void
    {
        $greed = new Greed();

        self::assertSame($expectedScore, $greed->score($dice));
    }

    /**
     * @return Generator<string, array{0: array{0: int, 1: int, 2: int, 3: int, 4: int, 5: int}, 1: int}, void, void>
     */
    public function getDiceResultTestCases(): \Generator
    {
        yield '[233446]: nothing' => [
            [2, 3, 3, 4, 4, 6],
            0,
        ];

        yield '[133446]: one 1' => [
            [1, 3, 3, 4, 4, 6],
            100,
        ];
        yield '[113446]: two 1' => [
            [1, 1, 3, 4, 4, 6],
            200,
        ];

        yield '[334456]: one 5' => [
            [3, 3, 4, 4, 5, 6],
            50,
        ];
        yield '[334556]: two 5' => [
            [3, 3, 4, 5, 5, 6],
            100,
        ];

        yield '[111226]: three 1' => [
            [1, 1, 1, 2, 2, 6],
            1000,
        ];
        yield '[111225]: three 1, one 5' => [
            [1, 1, 1, 2, 2, 5],
            1050,
        ];
        yield '[1111255]: three 1, two 5' => [
            [1, 1, 1, 2, 5, 5],
            1100,
        ];

        yield '[222366]: three 2' => [
            [2, 2, 2, 3, 6, 6],
            200,
        ];
        yield '[112226]: three 2, two 1' => [
            [1, 1, 2, 2, 2, 6],
            400,
        ];
        yield '[122266]: three 2, one 1' => [
            [1, 2, 2, 2, 6, 6],
            300,
        ];
        yield '[122256]: three 2, one 1, one 5' => [
            [1, 2, 2, 2, 5, 6],
            350,
        ];
        yield '[222566]: three 2, one 5' => [
            [2, 2, 2, 5, 6, 6],
            250,
        ];
        yield '[222556]: three 2, two 5' => [
            [2, 2, 2, 5, 5, 6],
            300,
        ];

        yield '[223336]: three 3' => [
            [2, 2, 3, 3, 3, 6],
            300,
        ];
        yield '[112333]: three 3, two 1' => [
            [1, 1, 2, 3, 3, 3],
            500,
        ];
        yield '[122333]: three 3, one 1' => [
            [1, 2, 2, 3, 3, 3],
            400,
        ];
        yield '[123335]: three 3, one 1, one 5' => [
            [1, 2, 3, 3, 3, 5],
            450,
        ];
        yield '[223335]: three 3, one 5' => [
            [2, 2, 3, 3, 3, 5],
            350,
        ];
        yield '[233355]: three 3, two 5' => [
            [2, 3, 3, 3, 5, 5],
            400,
        ];

        yield '[224446]: three 4' => [
            [2, 2, 4, 4, 4, 6],
            400,
        ];
        yield '[114446]: three 4, two 1' => [
            [1, 1, 4, 4, 4, 6],
            600,
        ];
        yield '[124446]: three 4, one 1' => [
            [1, 2, 4, 4, 4, 6],
            500,
        ];
        yield '[144456]: three 4, one 1, one 5' => [
            [1, 4, 4, 4, 5, 6],
            550,
        ];
        yield '[244456]: three 4, one 5' => [
            [2, 4, 4, 4, 5, 6],
            450,
        ];
        yield '[444556]: three 4, two 5' => [
            [4, 4, 4, 5, 5, 6],
            500,
        ];

        yield '[223555]: three 5' => [
            [2, 2, 3, 5, 5, 5],
            500,
        ];
        yield '[112555]: three 5, two 1' => [
            [1, 1, 2, 5, 5, 5],
            700,
        ];
        yield '[122555]: three 5, one 1' => [
            [1, 2, 2, 5, 5, 5],
            600,
        ];

        yield '[223666]: three 6' => [
            [2, 2, 3, 6, 6, 6],
            600,
        ];
        yield '[112666]: three 6, two 1' => [
            [1, 1, 2, 6, 6, 6],
            800,
        ];
        yield '[122666]: three 6, one 1' => [
            [1, 2, 2, 6, 6, 6],
            700,
        ];
        yield '[125666]: three 6, one 1, one 5' => [
            [1, 2, 5, 6, 6, 6],
            750,
        ];
        yield '[225666]: three 6, one 5' => [
            [2, 2, 5, 6, 6, 6],
            650,
        ];
        yield '[255666]: three 6, two 5' => [
            [2, 5, 5, 6, 6, 6],
            700,
        ];

        yield '[111126]: four 1' => [
            [1, 1, 1, 1, 2, 6],
            2000,
        ];
        yield '[111125]: four 1, one 5' => [
            [1, 1, 1, 1, 2, 5],
            2050,
        ];
        yield '[111155]: four 1, two 5' => [
            [1, 1, 1, 1, 5, 5],
            2100,
        ];

        yield '[222266]: four 2' => [
            [2, 2, 2, 2, 6, 6],
            400,
        ];
        yield '[112222]: four 2, two 1' => [
            [1, 1, 2, 2, 2, 2],
            600,
        ];
        yield '[122226]: four 2, one 1' => [
            [1, 2, 2, 2, 2, 6],
            500,
        ];
        yield '[122225]: four 2, one 1, one 5' => [
            [1, 2, 2, 2, 2, 5],
            550,
        ];
        yield '[222256]: four 2, one 5' => [
            [2, 2, 2, 2, 5, 6],
            450,
        ];
        yield '[222255]: four 2, two 5' => [
            [2, 2, 2, 2, 5, 5],
            500,
        ];

        yield '[223333]: four 3' => [
            [2, 2, 3, 3, 3, 3],
            600,
        ];
        yield '[113333]: four 3, two 1' => [
            [1, 1, 3, 3, 3, 3],
            800,
        ];
        yield '[123333]: four 3, one 1' => [
            [1, 2, 3, 3, 3, 3],
            700,
        ];
        yield '[133335]: four 3, one 1, one 5' => [
            [1, 3, 3, 3, 3, 5],
            750,
        ];
        yield '[233335]: four 3, one 5' => [
            [2, 3, 3, 3, 3, 5],
            650,
        ];
        yield '[333355]: four 3, two 5' => [
            [3, 3, 3, 3, 5, 5],
            700,
        ];

        yield '[224444]: four 4' => [
            [2, 2, 4, 4, 4, 4],
            800,
        ];
        yield '[114444]: four 4, two 1' => [
            [1, 1, 4, 4, 4, 4],
            1000,
        ];
        yield '[124444]: four 4, one 1' => [
            [1, 2, 4, 4, 4, 4],
            900,
        ];
        yield '[144445]: four 4, one 1, one 5' => [
            [1, 4, 4, 4, 4, 5],
            950,
        ];
        yield '[244445]: four 4, one 5' => [
            [2, 4, 4, 4, 4, 5],
            850,
        ];
        yield '[444455]: four 4, two 5' => [
            [4, 4, 4, 4, 5, 5],
            900,
        ];

        yield '[225555]: four 5' => [
            [2, 2, 5, 5, 5, 5],
            1000,
        ];
        yield '[115555]: four 5, two 1' => [
            [1, 1, 5, 5, 5, 5],
            1200,
        ];
        yield '[125555]: four 5, one 1' => [
            [1, 2, 5, 5, 5, 5],
            1100,
        ];

        yield '[226666]: four 6' => [
            [2, 2, 6, 6, 6, 6],
            1200,
        ];
        yield '[116666]: four 6, two 1' => [
            [1, 1, 6, 6, 6, 6],
            1400,
        ];
        yield '[126666]: four 6, one 1' => [
            [1, 2, 6, 6, 6, 6],
            1300,
        ];
        yield '[156666]: four 6, one 1, one 5' => [
            [1, 5, 6, 6, 6, 6],
            1350,
        ];
        yield '[256666]: four 6, one 5' => [
            [2, 5, 6, 6, 6, 6],
            1250,
        ];
        yield '[556666]: four 6, two 5' => [
            [5, 5, 6, 6, 6, 6],
            1300,
        ];

        yield '[111112]: five 1' => [
            [1, 1, 1, 1, 1, 2],
            4000,
        ];
        yield '[111115]: five 1, one 5' => [
            [1, 1, 1, 1, 1, 5],
            4050,
        ];
        yield '[122222]: five 2, one 1' => [
            [1, 2, 2, 2, 2, 2],
            900,
        ];
        yield '[222225]: five 2, one 5' => [
            [2, 2, 2, 2, 2, 5],
            850,
        ];
        yield '[222226]: five 2' => [
            [2, 2, 2, 2, 2, 6],
            800,
        ];
        yield '[133333]: five 3, one 1' => [
            [1, 3, 3, 3, 3, 3],
            1300,
        ];
        yield '[333335]: five 3, one 5' => [
            [3, 3, 3, 3, 3, 5],
            1250,
        ];
        yield '[333336]: five 3' => [
            [3, 3, 3, 3, 3, 6],
            1200,
        ];
        yield '[144444]: five 4, one 1' => [
            [1, 4, 4, 4, 4, 4],
            1700,
        ];
        yield '[444445]: five 4, one 5' => [
            [4, 4, 4, 4, 4, 5],
            1650,
        ];
        yield '[444446]: five 4' => [
            [4, 4, 4, 4, 4, 6],
            1600,
        ];
        yield '[155555]: five 5, one 1' => [
            [1, 5, 5, 5, 5, 5],
            2100,
        ];
        yield '[555556]: five 5' => [
            [5, 5, 5, 5, 5, 6],
            2000,
        ];
        yield '[166666]: five 6, one 1' => [
            [1, 6, 6, 6, 6, 6],
            2500,
        ];
        yield '[666665]: five 6, one 5' => [
            [6, 6, 6, 6, 6, 5],
            2450,
        ];
        yield '[266666]: five 6' => [
            [2, 6, 6, 6, 6, 6],
            2400,
        ];

        yield '[112345]: small straight, one 1' => [
            [1, 1, 2, 3, 4, 5],
            700,
        ];
        yield '[123455]: small straight, one 5' => [
            [1, 2, 3, 4, 5, 5],
            650,
        ];
        yield '[122345]: small straight' => [
            [1, 2, 2, 3, 4, 5],
            600,
        ];
        yield '[234556]: small straight, one 5' => [
            [2, 3, 4, 5, 5, 6],
            650,
        ];
        yield '[234566]: small straight' => [
            [2, 3, 4, 5, 6, 6],
            600,
        ];

        yield '[112233]: three pairs' => [
            [1, 1, 2, 2, 3, 3],
            800,
        ];
        yield '[112244]: three pairs' => [
            [1, 1, 2, 2, 4, 4],
            800,
        ];
        yield '[112255]: three pairs' => [
            [1, 1, 2, 2, 5, 5],
            800,
        ];
        yield '[112266]: three pairs' => [
            [1, 1, 2, 2, 6, 6],
            800,
        ];
        yield '[223344]: three pairs' => [
            [2, 2, 3, 3, 4, 4],
            800,
        ];
        yield '[223355]: three pairs' => [
            [2, 2, 3, 3, 5, 5],
            800,
        ];
        yield '[223366]: three pairs' => [
            [2, 2, 3, 3, 6, 6],
            800,
        ];
        yield '[334455]: three pairs' => [
            [3, 3, 4, 4, 5, 5],
            800,
        ];
        yield '[335566]: three pairs' => [
            [3, 3, 5, 5, 6, 6],
            800,
        ];
        yield '[445566]: three pairs' => [
            [4, 4, 5, 5, 6, 6],
            800,
        ];

        yield '[111111]: six 1' => [
            [1, 1, 1, 1, 1, 1],
            10000,
        ];
        yield '[222222]: six 2' => [
            [2, 2, 2, 2, 2, 2],
            2000,
        ];
        yield '[333333]: six 3' => [
            [3, 3, 3, 3, 3, 3],
            3000,
        ];
        yield '[444444]: six 4' => [
            [4, 4, 4, 4, 4, 4],
            4000,
        ];
        yield '[555555]: six 5' => [
            [5, 5, 5, 5, 5, 5],
            5000,
        ];
        yield '[666666]: six 6' => [
            [6, 6, 6, 6, 6, 6],
            6000,
        ];

        yield '[123456]: straight' => [
            [1, 2, 3, 4, 5, 6],
            1200,
        ];
    }
}
