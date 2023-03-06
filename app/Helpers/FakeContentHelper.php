<?php

namespace App\Helpers;


class FakeContentHelper
{

    private $randomWords;

    public function __construct(string $randomWords)
    {
        $this->stringToArray($randomWords);
    }


    private function stringToArray(string $string)
    {
        return $this->randomWords = explode(',', $string);
    }


    public function combine()
    {
        $results = [[]];
        foreach ($this->randomWords as $item) {
            foreach ($results as $combination) {
                $results[] = array_merge([$item], $combination);
            }
        }

        return $results;
    }
}
