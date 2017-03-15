<?php

    namespace App;

    use App\Notifications\ResetPassword;
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

        /**
         * @param $password
         *
         * @return string
         */
        function setPassword($password) {
            return $this->password = bcrypt($password);
        }


        /**
         * Send the password reset notification.
         *
         * @param  string $token
         * @param         $email
         */
        public function sendPasswordResetNotification($token, $email = null) {
            if ($email == null) $email = $this->email;
            $this->notify(new ResetPassword($token, $email));
        }
        /**
         * @param $password
         *
         * @return bool
         */
        function verifyPassword($password) {
            return \Hash::check($password, $this->password);
        }

    }
