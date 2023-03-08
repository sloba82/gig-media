<?php
namespace App\Helpers;

use PhpParser\Node\Expr\Cast\String_;

class ParseStringHelper
{
    public function firstCharString(array $combination): String
    {
        $abbreviation = '';
        foreach ($combination as $firstChar) {
            $abbreviation .= substr($firstChar, 0, 1);
        }

        return $abbreviation;
    }
}
