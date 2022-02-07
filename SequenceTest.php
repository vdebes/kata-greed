<?php

namespace Vdebes\KataGreed;

use PHPUnit\Framework\TestCase;

class SequenceTest extends TestCase
{
    /**
     * @dataProvider invalidDieCountDataProvider
     * @param int[] $rolls
     */
    public function test sequence of 3 to 6 die(array $rolls)
    {
        $this->expectException(\InvalidArgumentException::class);
        new Sequence($rolls);
    }

    public function invalidDieCountDataProvider(): \Generator
    {
        yield ["not enough die" => [1,3]];
        yield ["too many die" => [1,2,3,4,5,6,6]];
    }

    /**
     * @dataProvider invalidDieTypeDataProvider
     * @param int[] $rolls
     */
    public function test die are D6(array $rolls)
    {
        $this->expectException(\InvalidArgumentException::class);
        new Sequence($rolls);
    }

    public function invalidDieTypeDataProvider(): \Generator
    {
        yield ["D20" => [10,7,3,1,20]];
    }
}
