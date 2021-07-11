<?php

use App\Models\Area;
use App\Models\Category;
use App\Models\Classified;
use App\Models\Country;
use App\Models\Governate;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Classified::class, function (Faker $faker) {
    return [
        'name_ar' => $faker->name,
        'name_en' => $faker->name,
        'description_ar' => $faker->paragraph,
        'description_en' => $faker->paragraph,
        'mobile' => $faker->bankAccountNumber,
        'image' => env('APP_MODE') . '-' . $faker->numberBetween(1, 42) . '.jpeg',
        'price' => $faker->randomFloat(3, 10, 200),
        'address' => $faker->name,
        'area' => $faker->name,
        'block' => $faker->randomDigit,
        'street' => $faker->randomDigit,
        'building' => $faker->randomDigit,
        'floor' => $faker->randomDigit,
        'apartment' => $faker->randomDigit,
        'rooms' => $faker->randomDigit,
        'bathroom' => $faker->randomDigit,
        'years_old' => $faker->randomDigit,
        'keywords' => $faker->name,
        'path' => $faker->name,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'years_experience' => $faker->name,
        'video_url_one' => 'https://www.youtube.com/embed/GhyKqj_P2E4',
        'video_url_two' => 'https://www.youtube.com/embed/GhyKqj_P2E4',
        'video_url_three' => 'https://www.youtube.com/embed/GhyKqj_P2E4',
        'video_url_four' => 'https://www.youtube.com/embed/GhyKqj_P2E4',
        'video_url_five' => 'https://www.youtube.com/embed/GhyKqj_P2E4',
        'active' => $faker->boolean(true),
        'on_home' => $faker->boolean,
        'is_real_estate' => $faker->boolean,
        'is_negotiable' => $faker->boolean,
        'is_available' => $faker->boolean,
        'is_paid' => $faker->boolean,
        'is_exclusive' => $faker->boolean,
        'is_featured' => $faker->boolean,
        'has_balcony' => $faker->boolean,
        'only_whatsapp' => $faker->boolean,
        'user_id' => User::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'country_id' => function ($array) {
            return User::whereId($array['user_id'])->first()->country()->first()->id;
        },
        'governate_id' => function ($array) {
            return Governate::where('country_id', $array['country_id'])->get()->random()->id;
        },
        'area_id' => function ($array) {
            return Area::where('country_id', $array['country_id'])->get()->random()->id;
        },
        'views' => $faker->randomDigit,
        'expired_at' => $faker->dateTimeBetween('now', '1 year'),
    ];
});
