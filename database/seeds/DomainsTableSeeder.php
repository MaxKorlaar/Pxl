<?php

    use Illuminate\Database\Seeder;

    /**
     *
     * Class DomainsTableSeeder
     */
    class DomainsTableSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            factory(App\Domain::class, 10)->create()->each(function ($u) {

            });
        }
    }
