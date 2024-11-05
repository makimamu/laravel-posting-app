<?php

namespace Database\Factories;

use APP\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use APP\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' => 1, // usersテーブルにidカラムの値が1のユーザーが存在することが前提
        'title' => fake()->realText(20, 5),//日本語のランダムな【タイトル】を生成。20文字を超えない、流れを自然にする5
        'content' => fake()->realText(200, 5),//日本語のランダムな【本文】を生成。

        ];
    }
}
