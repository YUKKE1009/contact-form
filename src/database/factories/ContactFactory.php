<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    // コンストラクタで日本語ロケールの Faker をセット
    public function __construct($count = null, $factoryName = null)
    {
        parent::__construct($count, $factoryName);
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function definition()
    {
        return [
            'categry_id' => $this->faker->numberBetween(1, 5),
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'gender'     => $this->faker->numberBetween(1, 3),
            'email'      => $this->faker->unique()->safeEmail,
            'tel'        => $this->faker->phoneNumber,
            'address'    => $this->faker->address,
            'building'   => $this->faker->optional()->secondaryAddress,
            'detail'      => $this->faker->realText(200, 2), // 日本語の文章
        ];
    }
}
