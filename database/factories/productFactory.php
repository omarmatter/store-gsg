<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class productFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = category::inRandomOrder()
            ->limit(1)
            ->first(['id']);

        $status = ['active', 'draft'];

        $name = $this->faker->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => $category? $category->id : null,
            'description' => $this->faker->words(200, true),
            'image_path' => $this->faker->imageUrl(),
            'status' => $status[rand(0, 1)],
            'price' => $this->faker->randomFloat(2, 50, 2000),
            'quantity' => $this->faker->randomFloat(0, 0, 30),
        ];
    }
}
