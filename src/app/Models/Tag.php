<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * 投稿（多対多）
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->using(PostTag::class);
    }
}
