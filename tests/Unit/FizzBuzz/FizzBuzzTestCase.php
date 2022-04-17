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
    public function it_throws_exception_for_invalid_values_on_start_stop(int $start, int $stop):void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->makeFizzBuzz()->fizzBuzz($start, $stop);
    }

    public function success_calculation_data_provider():array
    {
        return [
            [1, 1, '1'],
            [2, 2, '2'],
            [3, 3, 'Fizz'],
            [6, 6, 'Fizz'],
            [9, 9, 'Fizz'],
            [5, 5, 'Buzz'],
            [10, 10, 'Buzz'],
            [15, 15, 'FizzBuzz'],
            [1, 6, '12Fizz4BuzzFizz'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider success_calculation_data_provider
     */
    public function it_returns_correct_string_sequence(int $start, int $stop, string $expected):void
    {
        $fizz_buzz = $this->makeFizzBuzz()->fizzBuzz($start, $stop);
        $this->assertEquals($fizz_buzz, $expected);
    }
}
