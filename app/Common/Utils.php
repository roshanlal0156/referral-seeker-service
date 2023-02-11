<?php

namespace App\Common;

use Illuminate\Support\Collection;

class Utils
{

    /**
     * Replace variables in String
     *
     * @param String $text
     * @param $variables
     * @return String
     */
    public static function replaceVariablesInString($text, $variables)
    {
        foreach ($variables as $key => $value) {
            $text = str_replace("{{$key}}", $value, $text);
        }
        return $text;
    }

    /**
     * Check if collection contains all keys
     *
     * @param Collection $data
     * @param array $keys
     * @return bool
     */
    public static function containsAll(Collection $data, array $keys)
    {
        foreach ($keys as $key) {
            if (!$data->has($key)) {
                return false;
            }
        }
        return true;
    }
}
