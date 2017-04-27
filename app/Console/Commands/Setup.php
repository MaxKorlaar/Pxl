<?php

    namespace App\Console\Commands;

    use App\User;
    use Illuminate\Console\Command;

    /**
     * Class Setup
     *
     * @package App\Console\Commands
     */
    class Setup extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'pxl:setup';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Create an admin user.';

        /**
         * Create a new command instance.
         *
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return void
         */
        public function handle() {
            $user = new User();
            $user->username = 'admin_' . str_random(4);
            $password = str_random(20);
            $user->setPassword($password);
            $user->rank    = 'admin';
            $user->email = 'admin@example.com';
            $user->last_ip = '-';
            $user->active  = true;
            $user->saveOrFail();
            $user->embed_name            = 'pxl_admin';
            $user->upload_token          = $user->id . str_random(60);
            $user->delete_token          = $user->id . str_random(60);
            $user->default_deletion_time = null;
            $user->saveOrFail();
            $this->info('Admin account created: ' . $user->username . ' with the following password: ' . $password);
            $this->info('Important: You should change your username, password and email under \'My account\'. Please do so after logging in.
            It is important to change the email address, so password resets can be performed if required');
        }
    }
