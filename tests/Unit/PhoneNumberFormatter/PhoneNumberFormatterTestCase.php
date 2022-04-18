<?php

namespace Tests\Unit\PhoneNumberFormatter;

use ExemplarCode\PhoneNumberFormatter\PhoneNumberFormatter;
use Tests\Unit\UnitTestCase;

class PhoneNumberFormatterTestCase extends UnitTestCase
{
    /**
     * @test
     *
     * @dataProvider phone_numbers_data_provider
     */
    public function it_formats_the_phone_numbers_correctly(string $expected, string $actual): void
    {
        $formatter = $this->makePhoneNumberFormatter();
        $value = $formatter->format($actual);

        $this->assertEquals($expected, $value);
    }

    public function phone_numbers_data_provider():array
    {
        return [
            ['123-456-7890', '123-456-7890'],
            ['123-456-7890', '(123) 456-7890'],
            ['123-456-7890', '1234567890'],
            ['123-456-7890', '12sample34567890'],
            ['123-456-9978', '123456&997890'],
        ];
    }

    private function makePhoneNumberFormatter() : PhoneNumberFormatter
    {
        return new PhoneNumberFormatter();
    }
}
