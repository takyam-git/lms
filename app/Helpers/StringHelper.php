<?php

namespace App\Helpers;

class StringHelper
{
    public const SYMBOLS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const UPPER_SYMBOLS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const UPPER_ALPHA_SYMBOLS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    function random(int $size = 10, $symbols = self::SYMBOLS): string
    {
        $parsed = str_split($symbols);
        $id = '';
        for ($i = 0; $i < $size; $i++) {
            $id .= $parsed[array_rand($parsed)];
        }
        return $id;
    }
}
