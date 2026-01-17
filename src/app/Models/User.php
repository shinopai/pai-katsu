<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'icon',
        'wakeup_time'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'wakeup_time' => 'datetime:H:i'
        ];
    }

    /**
     * 投稿
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
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
     * いいねした投稿
     */
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes')
            ->withTimestamps()
            ->orderBy('likes.created_at', 'desc');
    }

    /**
     * 早起き達成記録
     */
    public function achievementWakeups()
    {
        return $this->hasMany(AchievementWakeup::class);
    }

    /**
     * 早起き達成投稿一覧
     */
    public function achievedPosts()
    {
        return $this->belongsToMany(
            Post::class,
            'achievement_wakeups'
        );
    }

    // 自分がフォローしているユーザー
    public function followings()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'follower_id',
            'following_id'
        )->withTimestamps();
    }

    // 自分をフォローしているユーザー
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'following_id',
            'follower_id'
        )->withTimestamps();
    }

    public function isFollowing(int $userId): bool
    {
        return $this->followings()
            ->where('users.id', $userId)
            ->exists();
    }
}
