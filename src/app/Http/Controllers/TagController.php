<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Services\AchievementWakeupService;
use Carbon\Carbon;

class TagController extends Controller
{
    public function show(Tag $tag, AchievementWakeupService $service)
    {
        $tag->loadCount('posts');

        // メインタグ取得
        $mainTags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        // タグに紐づく投稿取得
        $posts = $tag->posts()
            ->with(['user', 'tags'])
            ->orderByDesc('posts.id')
            ->cursorPaginate(10);

        // 全ユーザーの早起き達成回数取得
        $monthlyCounts = $service->getMonthlyAchievementCountsAll($posts);

        // 月間早起き達成回数ランキング取得
        $monthlyRanking = $service->getMonthlyRankingWithRank();

        // 現在の月を取得
        $currentMonth = Carbon::now()->month;

        return view('tags.show', compact('mainTags', 'tag', 'posts', 'monthlyCounts', 'monthlyRanking', 'currentMonth'));
    }

    public function load(Tag $tag)
    {
        $posts = $tag->posts()
            ->with(['user', 'tags'])
            ->orderByDesc('posts.id')
            ->cursorPaginate(10);

        return view('posts._list', compact('posts'));
    }
}
