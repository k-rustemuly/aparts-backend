<?php

declare(strict_types=1);

namespace Buildit\Helpers;

final class PhoneNumber
{

    /**
     * 77782284032 -> +7(778)228-40-32
     */
    public static function unformat($phoneNumber): string
    {
        $phoneNumber = preg_replace('/\D/', '', (string) $phoneNumber);
        $formattedNumber = preg_replace('/^7(\d{3})(\d{3})(\d{2})(\d{2})$/', '+7($1)$2-$3-$4', $phoneNumber);
        return $formattedNumber;
    }

    /**
     * +7(778)228-40-32 -> 77782284032
     */
    public static function format($phoneNumber): string
    {
        $phoneNumber = preg_replace('/\D/', '', (string) $phoneNumber);
        return $phoneNumber;
    }
}
