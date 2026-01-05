<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 新規投稿フォーム
    public function create()
    {
        return view('posts.create');
    }

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

            // foreach ($request->tags as $tagName) {
            //     $tag = Tag::firstOrCreate([
            //         'name' => $tagName,
            //     ]);

            //     $tagIds[] = $tag->id;
            // }

            $post->tags()->sync($tagIds);
        }

        return redirect()->route('posts.show', $post)->with('success', '新規投稿を作成しました');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
