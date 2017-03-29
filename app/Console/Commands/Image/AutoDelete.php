<?php

    namespace App\Console\Commands\Image;

    use App\Image;
    use Illuminate\Console\Command;

    /**
     * Class AutoDelete
     *
     * @package App\Console\Commands\Image
     */
    class AutoDelete extends Command {

        protected $name = 'images:autodelete';

        protected $description = 'Automatically delete images which have an automatic deletion timestamp.';

        /**
         * Create a new console command instance.
         *
         */
        public function __construct() {
            parent::__construct();
        }

        public function fire() {
            $this->info('Looking up images with `deletion_timestamp` < ' . time() .'...');
            $images = Image::where('deletion_timestamp', '<', time())->get();
            $this->info($images->count());
        }

        /**
         * Get the console command arguments.
         *
         * @return array
         */
        protected function getArguments() {
            return [
            ];
        }

        /**
         * Get the console command options.
         *
         * @return array
         */
        protected function getOptions() {
            return [

            ];
        }

    }