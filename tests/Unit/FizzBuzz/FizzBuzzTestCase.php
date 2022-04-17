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
     * @test
     */
    public function it_throws_exception_when_stop_is_less_than_start():void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->makeFizzBuzz()->fizzBuzz(1, 0);
    }
}
