<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\User;
    use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
    use Request;

    /**
     * Class ForgotPasswordController
     *
     * @package App\Http\Controllers\Auth
     */
    class ForgotPasswordController extends Controller {
        /*
        |--------------------------------------------------------------------------
        | Password Reset Controller
        |--------------------------------------------------------------------------
        |
        | This controller is responsible for handling password reset emails and
        | includes a trait which assists in sending these notifications from
        | your application to your users. Feel free to explore this trait.
        |
        */

        use SendsPasswordResetEmails;

        /**
         * Create a new controller instance.
         *
         */
        public function __construct() {
            $this->middleware('guest');
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function requestResetLinkEmail(Request $request) {
            $this->validate($request, ['email' => 'required|email']);

            $user = User::whereEmail($request->get('email'))->findOrFail();
            /** @var User $user */
            if ($user->isActive()) {
                return $this->sendResetLinkEmail($request);
            } else {
                return $this->sendResetLinkFailedResponse($request, 'auth.account_inactive');
            }
        }
    }
