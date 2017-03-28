<?php

    /*
    |--------------------------------------------------------------------------
    | Model Factories
    |--------------------------------------------------------------------------
    |
    | Here you may define all of your model factories. Model factories give
    | you a convenient way to create models for testing and seeding your
    | database. Just tell the factory how a default model should look.
    |
    */

    /** @var \Illuminate\Database\Eloquent\Factory $factory */
    $factory->define(App\User::class, function (Faker\Generator $faker) {
        static $password;

        return [
            'username'       => $faker->userName,
            'email'          => $faker->unique()->safeEmail,
            'password'       => $password ?: $password = bcrypt('secret'),
            'twoFactorToken' => $faker->boolean ? null : str_random(16),
            'last_ip'        => $faker->ipv4,
            'active'         => $faker->boolean,
            'rank'           => $faker->boolean ? 'member' : 'admin',
            'remember_token' => str_random(10),
            'upload_token'   => str_random(60),
            'delete_token'   => str_random(60)
        ];
    });
    $factory->define(App\Domain::class, function (Faker\Generator $faker) {

        return [
            'domain'   => $faker->domainName,
            'user'     => 1,
            'protocol' => $faker->boolean ? 'http' : 'https'
        ];
    });