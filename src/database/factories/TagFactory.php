<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
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
            ])
        ];
    }
}
