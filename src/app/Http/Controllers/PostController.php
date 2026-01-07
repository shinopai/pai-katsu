<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
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

        return view('posts.index', compact('mainTags', 'posts'));
    }

    // 投稿一覧追加取得
    public function load(Request $request)
    {
        $posts = Post::with(['user', 'tags'])
            ->orderByDesc('id')
            ->cursorPaginate(10);

        return view('posts._list', compact('posts'));
    }

    // 新規投稿フォーム
    public function create()
    {
        return view('posts.create');
    }

    // 新規投稿保存
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'user_id'     => Auth::id(),
            'detail'      => $request->detail
        ]);

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
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
