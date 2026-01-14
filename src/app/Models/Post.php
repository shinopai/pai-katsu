<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * いいね
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * いいねしたユーザー（多対多）
     */
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * 認証ユーザーがいいねしているか
     */
    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;

        return $this->likes()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * この投稿の早起き達成記録
     */
    public function achievementWakeups()
    {
        return $this->hasMany(AchievementWakeup::class);
    }

    /**
     * 子の投稿で早起き達成したユーザー
     */
    public function achievedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'achievement_wakeups'
        );
    }
}
