<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'detail',
    ];

    /**
     * 投稿者
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * タグ（多対多）
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->using(PostTag::class);
    }

    /**
     * コメント
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
