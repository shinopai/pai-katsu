<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\AchievementWakeup;
use Illuminate\Database\Seeder;

class AchievementWakeupSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::take(5)->get();
        $startOfMonth = now()->startOfMonth();

        foreach ($users as $index => $user) {
            // ランキング差を出す
            $achievementDays = 10 - ($index * 2); // 10,8,6,4,2日

            for ($i = 0; $i < $achievementDays; $i++) {
                $date = $startOfMonth->copy()->addDays($i);

                // ① 投稿を作成
                $post = Post::create([
                    'user_id'    => $user->id,
                    'detail'    => "テスト投稿" . ($i + 1) . "日目",
                    'created_at' => $date->copy()->setTime(6, 0), // 朝投稿想定
                    'updated_at' => $date->copy()->setTime(6, 0),
                ]);

                // ② 早起き達成を作成
                AchievementWakeup::firstOrCreate(
                    [
                        'user_id'       => $user->id,
                        'achieved_date' => $date->toDateString(),
                    ],
                    [
                        'post_id'    => $post->id,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]
                );
            }
        }
    }
}
