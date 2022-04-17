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
            [4, 4, '4'],
            [5, 5, 'Buzz'],
            [6, 6, 'Fizz'],
            [7, 7, '7'],
            [8, 8, '8'],
            [9, 9, 'Fizz'],
            [10, 10, 'Buzz'],
            [11, 11, '11'],
            [12, 12, 'Fizz'],
            [13, 13, '13'],
            [14, 14, '14'],
            [15, 15, 'FizzBuzz'],
            [30, 30, 'FizzBuzz'],
            [75, 75, 'FizzBuzz'],
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
        $this->assertEquals($expected, $fizz_buzz);
    }

    public function fizz_data_provider():array
    {
        $array = [];
        for ($i = 1; $i <= 100; $i++) {
            if (($i % 3 == 0) && !($i % 5 == 0)) {
                $array[] = [$i];
            }
        }

        return $array;
    }

    /**
     * @test
     *
     * @dataProvider fizz_data_provider
     */
    public function it_returns_fizz_when_multiplies_of_three_but_not_five(int $value):void
    {
        $this->assertEquals('Fizz', $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }

    public function buzz_data_provider():array
    {
        $array = [];
        for ($i = 1; $i <= 100; $i++) {
            if (!($i % 3 == 0) && ($i % 5 == 0)) {
                $array[] = [$i];
            }
        }

        return $array;
    }

    /**
     * @test
     *
     * @dataProvider buzz_data_provider
     */
    public function it_returns_buzz_when_multiplies_of_five_but_not_three(int $value):void
    {
        $this->assertEquals('Buzz', $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }

    public function fizz_buzz_data_provider():array
    {
        $array = [];
        for ($i = 1; $i <= 100; $i++) {
            if (($i % 3 == 0) && ($i % 5 == 0)) {
                $array[] = [$i];
            }
        }

        return $array;
    }

    /**
     * @test
     *
     * @dataProvider fizz_buzz_data_provider
     */
    public function it_returns_fizzbuzz_when_multiplies_of_three_and_five(int $value):void
    {
        $this->assertEquals('FizzBuzz', $this->makeFizzBuzz()->fizzBuzz($value, $value));
    }
}
