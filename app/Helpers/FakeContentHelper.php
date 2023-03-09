<?php

namespace App\Helpers;


class FakeContentHelper
{

    /**
     * randomWords
     *
     * @var array
     */
    private $randomWords;

    /**
     * __construct
     *
     * @param  string $randomWords
     * @return void
     */
    public function __construct(string $randomWords)
    {
        $this->stringToArray($randomWords);
    }


    /**
     * stringToArray
     *
     * @param  mixed $string
     * @return array
     */
    private function stringToArray(string $string): array
    {
        return $this->randomWords = explode(',', $string);
    }


    /**
     * combine
     *
     * @return array
     */
    public function combine(): array
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
