<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'detail' => $this->faker->sentence(15)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $names = $this->faker->randomElements([
                '早起き',
                '朝活',
                '眠い',
                '継続',
                '成功',
                '失敗',
                '習慣化',
                'モーニングルーティン',
                '健康',
                '生産性向上',
                'ストイック',
                'チャレンジ'
            ], rand(1, 3));

            $tags = collect($names)->map(
                fn($name) => Tag::firstOrCreate(['name' => $name])
            );

            $post->tags()->attach($tags->pluck('id'));
        });
    }
}
