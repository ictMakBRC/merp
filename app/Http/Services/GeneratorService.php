<?php

namespace App\Services;

use Illuminate\Support\Str;

class GeneratorService
{
    public static function password($length = 2)
    {
        $numbers = '0123456789';
        $symbols = '!@#$%^&*()';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomNumber = '';
        $randomSymbol = '';
        $randomUppercase = '';
        $randomLowercase = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $numbers[rand(0, strlen($numbers) - 1)];
            $randomSymbol .= $symbols[rand(0, strlen($symbols) - 1)];
            $randomUppercase .= $uppercase[rand(0, strlen($uppercase) - 1)];
            $randomLowercase .= $lowercase[rand(0, strlen($lowercase) - 1)];
        }

        return str_shuffle($randomNumber.$randomSymbol.$randomUppercase.$randomLowercase);
    }

 

   

    public static function getNumber($length)
    {
        $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function generateStringCode()
    {
        $characters = 'ABCDEFGHJKLMNOPQRSTUVWXYZ';
        $tracker = mt_rand(100, 9999)
        .$characters[rand(0, strlen($characters) - 3)];

        return str_shuffle($tracker);
    }

   

    public static function generateInitials(string $name)
    {
        $n = Str::of($name)->wordCount();
        $words = explode(' ', $name);

        if (count($words) <= 2) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) == 3) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) == 4) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr($words[2], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) == 5) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr($words[2], 0, 1, 'UTF-8').
                mb_substr($words[3], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) == 6) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr($words[2], 0, 1, 'UTF-8').
                mb_substr($words[3], 0, 1, 'UTF-8').
                mb_substr($words[4], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) == 7) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr($words[2], 0, 1, 'UTF-8').
                mb_substr($words[3], 0, 1, 'UTF-8').
                mb_substr($words[4], 0, 1, 'UTF-8').
                mb_substr($words[5], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) == 8) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr($words[2], 0, 1, 'UTF-8').
                mb_substr($words[3], 0, 1, 'UTF-8').
                mb_substr($words[4], 0, 1, 'UTF-8').
                mb_substr($words[5], 0, 1, 'UTF-8').
                mb_substr($words[6], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) >= 9) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8').
                mb_substr($words[1], 0, 1, 'UTF-8').
                mb_substr($words[2], 0, 1, 'UTF-8').
                mb_substr($words[3], 0, 1, 'UTF-8').
                mb_substr($words[4], 0, 1, 'UTF-8').
                mb_substr($words[5], 0, 1, 'UTF-8').
                mb_substr($words[6], 0, 1, 'UTF-8').
                mb_substr($words[7], 0, 1, 'UTF-8').
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        }

        return self::makeInitialsFromSingleWord($name);
    }

    /**
     * Make initials from a word with no spaces
     *
     * @return string
     */
    protected static function makeInitialsFromSingleWord(string $name)
    {
        $n = Str::of($name)->wordCount();
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= $n) {
            return mb_substr(implode('', $capitals[1]), 0, $n, 'UTF-8');
        }

        return mb_strtoupper(mb_substr($name, 0, $n, 'UTF-8'), 'UTF-8');
    }



  
}
