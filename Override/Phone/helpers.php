<?php

use Modules\AfricasTalking\Override\Phone\PhoneNumber;

if (! function_exists('phone')) {
    /**
     * Get a PhoneNumber instance or a formatted string.
     *
     * @param string $number
     * @param string|array $country
     * @param string $format
     * @return string|Modules\AfricasTalking\Override\Phone\PhoneNumber
     *
     * @throws \Modules\AfricasTalking\Override\Phone\Exceptions\NumberFormatException
     */
    function phone($number, $country = [], $format = null)
    {
        $phone = PhoneNumber::make($number, $country);

        if (! is_null($format)) {
            return $phone->format($format);
        }

        return $phone;
    }
}
