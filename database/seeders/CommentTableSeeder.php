<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Helpers\FakeContentHelper;
use App\Helpers\ParseStringHelper;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ParseStringHelper $parseStringHelper)
    {
        $postsIds = Post::all()->pluck('id')->toArray();

        $randomWords = "Cool,Strange,Funny,Laughing,Nice,Awesome,Great,Horrible,Beautiful,PHP,Vegeta,Italy,Joost";

        $fakeContent = new FakeContentHelper($randomWords);
        $comments = [];
        foreach ($fakeContent->combine() as $combination) {
            if ($combination) {
                $uniqueText = implode(' ', $combination);

                $randomId = array_rand($postsIds, 1);
                $comments[] = [
                    'post_id' => $postsIds[$randomId],
                    'content' =>  strtolower($uniqueText),
                    'abbreviation' =>  strtolower($parseStringHelper->firstCharString($combination)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        Comment::insert($comments);
    }

}
