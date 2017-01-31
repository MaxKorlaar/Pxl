<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    /**
     * Class User
     *
     * @package App
     */
    class User extends Authenticatable {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'username', 'email', 'password', '2fa_token'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token', '2fa_token', 'last_ip'
        ];

        /**
         * Get the format for database stored dates.
         *
         * @return string
         */
        protected function getDateFormat() {
            return 'U';
        }

        /**
         * @return bool
         */
        function isActive() {
            return $this->active == 1;
        }

        /**
         * @return bool
         */
        function isAdmin() {
            return $this->rank == 'admin';
        }
    }
