<?php

namespace App\Models;

use App\Helpers\ParseStringHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'content',
        'abbreviation'
    ];


    /**
     * setContentAttribute
     *
     * @param  string $value
     * @return void
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strtolower($value);
    }

    /**
     * setAbbreviationAttribute
     *
     * @param  string $value
     * @return void
     */
    public function setAbbreviationAttribute($value)
    {
        $content = explode(' ', $value);
        $parseStringHelper = new ParseStringHelper;
        $this->attributes['abbreviation'] = strtolower($parseStringHelper->firstCharString($content));
    }

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->BelongsTo(Post::class);
    }
}
