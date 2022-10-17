<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'poblacion' => $this->faker->word(),
            'telefono' => $this->faker->regexify('[6-7]{1}[0-9]{8}'),
        ];
    }
}
