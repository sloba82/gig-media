<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $text = $this->faker->name;
        return [
            'post_id' =>1,
            'content' =>  $text,
            'abbreviation' =>  $text
        ];
    }
}
