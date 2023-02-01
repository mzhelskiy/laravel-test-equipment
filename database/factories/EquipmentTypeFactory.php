<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'mask' => $this->faker->regexify('[N]{0,2}[A]{0,4}[X]{1,2}[Z]{0,1}[a]{0,3}'),
        ];
    }
}
