<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'abbreviation'
    ];


    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strtolower($value);
    }

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->BelongsTo(Post::class);
    }
}
