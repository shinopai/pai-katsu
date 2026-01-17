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

    // 月間早起き達成回数ランキングを取得
    public function getMonthlyRankingWithRank()
    {
        $rows = AchievementWakeup::whereBetween(
            'achieved_date',
            [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()]
        )
            ->selectRaw('
                user_id,
                COUNT(*) as achievement_count,
                MAX(achieved_date) as latest_achieved_date,
                MAX(id) as latest_id
            ')
            ->groupBy('user_id')
            ->orderByDesc('achievement_count')
            ->orderByDesc('latest_achieved_date')
            ->orderByDesc('latest_id')
            ->with('user')
            ->limit(5)
            ->get();

        return $this->addRanks($rows);
    }

    private function addRanks($rows)
    {
        $ranked = [];
        $currentRank = 0;
        $prevCount = null;
        $prevDate = null;

        foreach ($rows as $index => $row) {
            if (
                $row->achievement_count !== $prevCount ||
                $row->latest_achieved_date !== $prevDate
            ) {
                // 同率じゃなければ順位更新
                $currentRank = $index + 1;
            }

            $row->rank = $currentRank;

            $prevCount = $row->achievement_count;
            $prevDate  = $row->latest_achieved_date;

            $ranked[] = $row;
        }

        return collect($ranked);
    }
}
