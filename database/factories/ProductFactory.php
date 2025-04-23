<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->name(),
            "product_image"=>fake()->sentence(),
            "price"=>fake()->numberBetween(30,80),
            "stock_quantity"=>fake()->numberBetween(1,10),
            "expire_date"=>fake()->date(),
            "discount"=>fake()->numberBetween(20,50),
            "final_price"=>fake()->numberBetween(20,50),
            "vendor_id"=>46,
            "sub_category_id"=>1
        ];
    }
}
