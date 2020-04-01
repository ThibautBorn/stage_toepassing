<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Internship;
use Faker\Generator as Faker;

$factory->define(Internship::class, function (Faker $faker) {
    return [
        'title' =>$faker->sentence,
        'description' =>$faker->paragraph,
        'company_id'=>random_int(1,3),
        'wanted_profile'=>$faker->paragraph,
        'additional_information'=>$faker->sentence,
        'first_semester_possibility'=>$faker->boolean,
        'project_possibility'=>$faker->boolean,
        'mentor_name'=>$faker->name,
        'mentor_mail'=>$faker->companyEmail,
        'mentor_function'=>$faker->jobTitle,
        'mentor_phone'=>$faker->phoneNumber,
    ];
});
