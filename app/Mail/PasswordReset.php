<?php

    namespace App\Mail;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    /**
     * Class PasswordReset
     *
     * @package App\Mail
     */
    class PasswordReset extends Mailable {
        use Queueable, SerializesModels;
        protected $email;
        protected $token;

        /**
         * Create a new message instance.
         *
         * @param $email
         * @param $token
         */
        public function __construct($email, $token) {
            $this->email   = $email;
            $this->token   = $token;
            $this->subject = trans('email.password_reset.title');
            return $this;
        }


        /**
         * Build the message.
         *
         * @return $this
         */
        public function build() {
            return $this->view('emails.password_reset', ['reset_link' => route('auth/reset_password', ['email' => $this->email, 'token' => $this->token])]);
        }
    }
