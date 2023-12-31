<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->text(20);

        return [
            'name' => $name,
            'slug' => str_replace(' ', '-', strtolower($name)),
            'parent_id' => 0,
        ];
    }
}
