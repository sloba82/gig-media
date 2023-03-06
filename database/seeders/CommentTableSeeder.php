<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Helpers\FakeContentHelper;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $postsIds = Post::all()->pluck('id')->toArray();

        $randomWords = "Cool,Strange,Funny,Laughing,Nice,Awesome,Great,Horrible,Beautiful,PHP,Vegeta,Italy,Joost";

        $fakeContent = new FakeContentHelper($randomWords);
        $comments = [];
        foreach ($fakeContent->combine() as $combination) {
            if ($combination) {
                $uniqueText = implode(' ', $combination);

                $randomId = array_rand($postsIds,1);
                $comments[] = [
                    'post_id' => $postsIds[$randomId],
                    'content' =>  strtolower($uniqueText),
                    'abbreviation' =>  strtolower($this->firstCharString($combination))
                ];
            }
        }

        Comment::insert($comments);
    }


    private function firstCharString($combination )
    {
        $abbreviation = '';
        foreach ($combination as $firstChar) {
            $abbreviation .= substr($firstChar, 0, 1);
        }

        return $abbreviation;
    }


}
