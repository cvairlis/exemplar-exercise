<?php

namespace Tests\Unit\FizzBuzz;

use ExemplarCode\FizzBuzz\FizzBuzz;
use InvalidArgumentException;
use Tests\Unit\UnitTestCase;

class FizzBuzzTestCase extends UnitTestCase
{
    private function makeFizzBuzz(): FizzBuzz
    {
        return new FizzBuzz();
    }

    /**
     */
    public function throws_exception_data_provider():array
    {
        return [
            '$stop < $start' => [100, 99],
            '$start < 0' => [-10, 10],
            '$stop < 0' => [10, -10]

        ];
    }

    /**
     * @test
     *
     * @dataProvider throws_exception_data_provider
     */
    public function it_throws_exception_when_stop_is_less_than_start(int $start, int $stop):void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->makeFizzBuzz()->fizzBuzz($start, $stop);
    }
}
