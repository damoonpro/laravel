<?php

namespace App\Tools;

class Helpers
{
    public static function stripTags($value)
    {
        return strip_tags($value, '<b><a><em><img><br/><hr/><h1><h2><h3>'
            .'<h4><h5><h6><blockquote><pre><p><ol><li><strong><i><u><mark><span><ul>'
            .'<br><hr><div><table><tbody><tr><td><thead><tfoot><code>');
    }

    public static function toEnglish($string)
    {
        $newNumbers = range(0, 9);

        $persianDecimal = ['&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;'];
        $arabicDecimal = ['&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        $string = str_replace($persian, $newNumbers, $string);

        $string = trim($string);
        $string = str_replace(array('ي', 'ك', 'ة'), array('ی', 'ک', 'ه'), $string);

        return $string;
    }

    public static function responseWithMessage(string $message, array $data =[], int $response_code = 200, string $status = "Success" )
    {
        return response()->json(self::arrayPure([
            'message' => $message,
            'data' => $data,
            'status' => $status
        ]),
            $response_code
        );
    }

    public static function responseWithError(string $message, int $response_code , array $errors = []){
        return response()->json(self::arrayPure([
            'message' => $message,
            'errors' => $errors,
            'status' => 'Failed'
        ]),
            $response_code);
    }

    public static function arrayPure(array $array, bool $toCollection = false, bool $sensitive = false){
        $array = collect($array)->map(function ($item){
            if(empty($item))
                return null;
            return $item;
        })->filter(function($item) use($sensitive) {
            if(is_int($item) and $item == 0)
                return 'false';
            if($sensitive and is_bool($item) and ! $item)
                return 'false';
            return $item;
        });

        return $toCollection ? $array : $array->toArray() ;
    }
}
