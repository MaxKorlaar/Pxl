<?php

    namespace App\Notifications;

    use App\Mail\PasswordReset;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Notifications\Notification;

    /**
     * Class ResetPassword
     *
     * @package App\Notifications
     */
    class ResetPassword extends Notification {
        use Queueable;


        /**
         * The password reset token.
         *
         * @var string
         */
        public $token;
        public $email;

        /**
         * Create a notification instance.
         *
         * @param  string $token
         * @param         $email
         */
        public function __construct($token, $email) {
            $this->token = $token;
            $this->email = $email;
        }

        /**
         * Get the notification's channels.
         *
         * @param  mixed $notifiable
         *
         * @return array|string
         */
        public function via($notifiable) {
            return ['mail'];
        }

        /**
         * Build the mail representation of the notification.
         *
         * @param  Notifiable $notifiable
         *
         * @return PasswordReset|MailMessage
         */
        public function toMail($notifiable) {
            $reset = new PasswordReset($this->email, $this->token);
            $reset->to($notifiable->email, $notifiable->username);
            return $reset;
        }


    }
