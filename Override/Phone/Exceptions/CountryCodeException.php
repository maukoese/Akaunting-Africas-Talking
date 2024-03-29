<?php namespace Modules\AfricasTalking\Override\Phone\Exceptions;

class CountryCodeException extends \Exception
{
    /**
     * Invalid country code static constructor.
     *
     * @param string $country
     * @return static
     */
    public static function invalid($country)
    {
        return new static('Invalid country code "' . $country . '".');
    }
}
