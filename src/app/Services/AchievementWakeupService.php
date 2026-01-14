<?php

namespace App\Services;

use App\Models\AchievementWakeup;
use Carbon\Carbon;

class AchievementWakeupService
{
    // 月間早起き達成回数を取得
    public function getMonthlyAchievementCount(int $userId, Carbon $date): int
    {
        return AchievementWakeup::where('user_id', $userId)
            ->whereYear('achieved_date', $date->year)
            ->whereMonth('achieved_date', $date->month)
            ->count();
    }

    // 全ユーザーの月間早起き達成回数一覧を取得
    public function getMonthlyAchievementCountsAll($posts)
    {
        $userIds = $posts->pluck('user_id')->unique();

        return AchievementWakeup::whereIn('user_id', $userIds)
            ->whereYear('achieved_date', now()->year)
            ->whereMonth('achieved_date', now()->month)
            ->selectRaw('user_id, COUNT(*) as count')
            ->groupBy('user_id')
            ->pluck('count', 'user_id');
    }
}
