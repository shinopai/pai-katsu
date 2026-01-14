<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\AchievementWakeupService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user, AchievementWakeupService $service)
    {
        // 現在の月
        $currentMonth = Carbon::now()->month;

        // 月間早起き達成回数を取得
        $count = $service->getMonthlyAchievementCount($user->id, Carbon::now());

        // 全ユーザーの早起き達成回数取得
        $monthlyCounts = $service->getMonthlyAchievementCountsAll(Post::orderByDesc('id')->get());

        return view('users.show', compact('user', 'currentMonth', 'count', 'monthlyCounts'));
    }
}
