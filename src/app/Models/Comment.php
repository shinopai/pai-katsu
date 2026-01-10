<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * =====================
     * Mass Assignment
     * =====================
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    /**
     * =====================
     * Relationships
     * =====================
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * =====================
     * Scopes
     * =====================
     */
    // public function scopeLatest($query)
    // {
    //     return $query->orderBy('created_at', 'desc');
    // }

    // public function scopeOldest($query)
    // {
    //     return $query->orderBy('created_at', 'asc');
    // }

    // /**
    //  * =====================
    //  * Accessors
    //  * =====================
    //  */
    // public function getAuthorNameAttribute()
    // {
    //     return $this->user?->name ?? '退会ユーザー';
    // }

    // public function getAuthorIconAttribute()
    // {
    //     return $this->user?->icon_path;
    // }
}
