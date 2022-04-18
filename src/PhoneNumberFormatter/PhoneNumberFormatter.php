<?php

namespace ExemplarCode\PhoneNumberFormatter;

class PhoneNumberFormatter
{
    /**
     * Takes a phone number in any form and formats it
     * according to the 3-3-4 US block standard `(XXX)- XXX - XXXX`,
     * using the delimiter specified.
     *
     * Assumes foreign phone numbers and country codes are out of scope.
     *
     * @param mixed $phone_number
     * @param string $delimiter
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function format($phone_number, string $delimiter = '-'): string
    {
        // get only digits
        $sanitized_input = filter_var($phone_number, FILTER_SANITIZE_NUMBER_INT);
        $integers_only = preg_replace('/[^0-9]/', '', $sanitized_input);

        return implode($delimiter, [
            substr($integers_only, 0, 3),
            substr($integers_only, 3, 3),
            substr($integers_only, 6, 4),
        ]);
    }
}
