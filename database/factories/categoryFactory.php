<?php

namespace Database\Factories;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class categoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = DB::table('categories')
        ->inRandomOrder()
        ->limit(1)
        ->first(['id']);

    $status = ['active', 'draft'];

    $name = $this->faker->name();

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'parent_id' => $category? $category->id : null,
        'description' => $this->faker->words(200, true),
        'image_path' => $this->faker->imageUrl(),
        'status' => $status[rand(0, 1)],
    ];
    }
}
