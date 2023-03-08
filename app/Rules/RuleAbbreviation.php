<?php

namespace App\Rules;

use App\Models\Comment;
use App\Helpers\ParseStringHelper;
use Illuminate\Contracts\Validation\Rule;

class RuleAbbreviation implements Rule
{
    private $parseStringHelper;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->parseStringHelper = new ParseStringHelper;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value  )
    {
        $content = explode(' ', $value);
        $abbreviation = strtolower($this->parseStringHelper->firstCharString($content));
        if(Comment::where('abbreviation', $abbreviation)->exists()){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Duplicate record.';
    }
}
