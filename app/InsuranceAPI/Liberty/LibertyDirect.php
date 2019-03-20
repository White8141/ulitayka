<?php
/**
 * Created by PhpStorm.
 * User: CTAC
 * Date: 11.03.2019
 * Time: 12:11
 */

namespace App\InsuranceAPI\Liberty;

class LibertyDirect
{
    private static $libertyCurrency = [
        'EUR' => 14,
        'USD' => 1,
        'RUB' => 0
    ];

    public static function getCurrencyUID($currency)
    {
        return self::$libertyCurrency[$currency] ?? 14;
    }
}