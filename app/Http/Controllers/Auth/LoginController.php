<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Http\Request;

    /**
     * Class LoginController
     *
     * @package App\Http\Controllers\Auth
     */
    class LoginController extends Controller {
        /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

        use AuthenticatesUsers;

        /**
         * Where to redirect users after login.
         *
         * @var string
         */
        protected $redirectTo = '/user/gallery';

        /**
         * Create a new controller instance.
         *
         */
        public function __construct() {
            $this->middleware('guest', ['except' => 'logout']);
        }

        /**
         * Get the failed login response instance.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendFailedLoginResponse(Request $request) {
            if($request->ajax()) {
                return response(['success' => false, 'error' => trans('auth.failed')], 403);
            } else {
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([
                        $this->username() => trans('auth.failed'),
                    ]);
            }

        }
        /**
         * @return string
         */
        public function username() {
            return 'username';
        }
    }
