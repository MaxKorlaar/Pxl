<?php

use Illuminate\Database\Seeder;

    /**
     * Class UsersTableSeeder
     */
    class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create()->each(function ($u) {

        });
    }
}
