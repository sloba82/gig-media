<?php
namespace App\Helpers;

class ParseStringHelper
{
    /**
     * firstCharString
     *
     * @param  mixed $combination
     * @return String
     */
    public function firstCharString(array $combination): String
    {
        $abbreviation = '';
        foreach ($combination as $firstChar) {
            $abbreviation .= substr($firstChar, 0, 1);
        }

        return $abbreviation;
    }
}
