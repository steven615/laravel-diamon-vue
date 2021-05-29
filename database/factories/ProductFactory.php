<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->bothify('??#?##?'),
            'name' => $this->faker->name(),
            'description' => $this->faker->text($maxNbChars = 20),
            'image' => $this->faker->lexify('bamboo-watch.jpg'),
            'price' => $this->faker->randomNumber(2),
            'category' => $this->faker->randomElement(['Accessories', 'Clothing', 'Electronics', 'Fitness']),
            'quantity' => $this->faker->randomNumber(2),
            'inventoryStatus' => $this->faker->randomElement(['INSTOCK', 'LOWSTOCK', 'OUTOFSTOCK']),
            'rating' => $this->faker->numberBetween(0, 5)
        ];
    }
}
