<?php

namespace Database\Factories;

use App\Models\admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class adminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'adMa'=>'1111111',
            'adTen'=>'MASTER',
            'adTaikhoan'=>'master',
            'adEmail'=>$this->faker->safeemail,
            'adSdt'=>'0392522094',
            'adMatkhau'=>'123456789',
            'adDiachi'=>'180 cao lo',
            'adTinhtrang'=>0,
            'adQuyen'=>'1',
        ];
    }
}
