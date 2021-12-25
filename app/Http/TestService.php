<?php

namespace App\Http\Services;

class TestService
{
    /**
     * @param array $array
     */
    public static function test(array $array)
    {
        dd($array);
    }
}