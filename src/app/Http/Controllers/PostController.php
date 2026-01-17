<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\AchievementWakeup;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Services\AchievementWakeupService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request, AchievementWakeupService $service)
    {
        // メインタグ取得
        $mainTags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        // 最初に表示する投稿10件を取得
        $posts = Post::with(['user', 'tags'])
            ->orderByDesc('id')
            ->cursorPaginate(10);

        // 全ユーザーの早起き達成回数取得
        $monthlyCounts = $service->getMonthlyAchievementCountsAll($posts);

        // 月間早起き達成回数ランキング取得
        $monthlyRanking = $service->getMonthlyRankingWithRank();

        // 現在の月を取得
        $currentMonth = Carbon::now()->month;

        return view('posts.index', compact('mainTags', 'posts', 'monthlyCounts', 'monthlyRanking', 'currentMonth'));
    }

    // 投稿一覧追加取得
    public function load(Request $request, AchievementWakeupService $service)
    {
        $posts = Post::with(['user', 'tags'])
            ->orderByDesc('id')
            ->cursorPaginate(10);

        // 全ユーザーの早起き達成回数取得
        $monthlyCounts = $service->getMonthlyAchievementCountsAll($posts);

        return view('posts._list', compact('posts', 'monthlyCounts'));
    }

    // 新規投稿フォーム
    public function create()
    {
        return view('posts.create');
    }

    // 新規投稿保存
    public function store(
        StorePostRequest $request,
        AchievementWakeupService $service
    ) {
        $post = Post::create([
            'user_id'     => Auth::id(),
            'detail'      => $request->detail
        ]);

        $user = Auth::user();

        // 早起き判定
        $achieved = $this->tryCreateAchievementWakeup($user, $post);

        if ($achieved) {
            $count = $service->getMonthlyAchievementCount($user->id, now());

            // セッションに早起き達成フラグをセット
            session()->flash('wakeup_achieved', [
                'count' => $count,
                'month' => now()->month
            ]);
        }

        // タグ処理
        if ($request->filled('tags')) {
            $tagIds = [];

            $tags = collect(preg_split('/[,\s、，]+/u', $request->tags))
                ->map(fn($tag) => trim($tag))
                ->filter()
                ->unique()
                ->values();

            $tagIds = $tags->map(function ($name) {
                return Tag::firstOrCreate(['name' => $name])->id;
            });

            $post->tags()->sync($tagIds);
        }

        return redirect()->route('posts.show', $post)->with('success', '新規投稿を作成しました');
    }

    // 投稿詳細
    public function show(Post $post, AchievementWakeupService $service)
    {
        $count = $service->getMonthlyAchievementCount($post->user->id, now());

        $post->loadCount('comments');

        return view('posts.show', compact('post', 'count'));
    }

    // 早起き判定
    private function tryCreateAchievementWakeup(User $user, Post $post): bool
    {
        $now = now();

        $targetTimeToday = today()->setTimeFromTimeString($user->wakeup_time);

        $targetTime = $now->lessThan($targetTimeToday)
            ? $targetTimeToday
            : $targetTimeToday->copy()->addDay();

        $startTime = $targetTime->copy()->subHours(3);
        $achievedDate = $targetTime->toDateString();

        $alreadyAchieved = AchievementWakeup::where('user_id', $user->id)
            ->where('achieved_date', $achievedDate)
            ->exists();

        if ($alreadyAchieved) {
            return false;
        }

        // テストモード判定(時間の範囲を無視して達成扱いにする)
        if (config('app.wakeup_test_mode')) {
            AchievementWakeup::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'achieved_date' => $achievedDate
            ]);

            return true;
        }

        if ($now->between($startTime, $targetTime)) {
            AchievementWakeup::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'achieved_date' => $achievedDate
            ]);

            return true;
        }

        return false;
    }
}
