<?php

    namespace App;

    use App\Notifications\ResetPassword;
    use Google2FA;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    /**
     * Class User
     *
     * @package App
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @mixin \Eloquent
     * @property int                                                                                                            $id
     * @property string                                                                                                         $username
     * @property string                                                                                                         $email
     * @property string                                                                                                         $password
     * @property string                                                                                                         $twoFactorToken
     * @property string                                                                                                         $remember_token
     * @property string                                                                                                         $last_ip
     * @property bool                                                                                                           $active
     * @property string                                                                                                         $rank
     * @property int                                                                                                            $last_login
     * @property \Carbon\Carbon                                                                                                 $created_at
     * @property \Carbon\Carbon                                                                                                 $updated_at
     * @method static \Illuminate\Database\Query\Builder|\App\User where2faToken($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereActive($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereLastIp($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereLastLogin($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereRank($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
     */
    class User extends Authenticatable {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'username', 'email', 'password', 'twoFactorToken'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token', 'twoFactorToken', 'last_ip', 'last_login'
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
         * @return bool
         */
        function hasTwoFactorAuth() {
            return $this->twoFactorToken != null;
        }

        /**
         * @return string
         *
         */
        public function generate2faSecret() {
            return Google2FA::generateSecretKey(32, $this->id);
        }

        /**
         * @param           $key
         *
         * @return bool
         */
        public function verifyKey($key) {
            return Google2FA::verifyKey($this->twoFactorToken, $key);
        }

        /**
         * @param null $secret
         *
         * @return string
         */
        public function get2faQRCode($secret = null) {
            return Google2FA::getQRCodeGoogleUrl(config('app.name'), $this->username, $secret != null ? $secret : $this->twoFactorToken, 250);
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
