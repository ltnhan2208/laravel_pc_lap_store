<?php

namespace Database\Factories;

use App\Models\khachhang;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class khachhangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = khachhang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'khMa'=>rand(100,10000000),
            'khTen'=>$this->faker->name,
            'khSdt'=>rand(1000,10000000),
            'khDiachi'=>'180 cao lo p4 q8',
            'khQuyen'=>'0',
            'khNgaysinh'=>date_create(),
            'khTaikhoan'=>$this->faker->name,
            'khMatkhau'=>md5('123456789'),
            'khGioitinh'=>0,
            'khNgaythamgia'=>date_create(),
            'khEmail'=>$this->faker->safeemail,
            'khXtemail'=>1,
        ];
    }
}
