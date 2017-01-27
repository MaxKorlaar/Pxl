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
            if ($request->ajax()) {
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
         * Redirect the user after determining they are locked out.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendLockoutResponse(Request $request) {
            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );

            $message = trans('auth.throttle', ['seconds' => $seconds]);

            if ($request->ajax()) {
                return response(['success' => false, 'error' => $message], 403);
            } else {
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([$this->username() => $message]);
            }
        }

        /**
         * Get the needed authorization credentials from the request.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return array
         */
        protected function credentials(Request $request) {
            if (filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL)) {
                $request->merge(['email' => $request->input($this->username())]);
                return $request->only('email', 'password');
            }
            return $request->only($this->username(), 'password');
        }

        /**
         * The user has been authenticated.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  mixed                    $user
         *
         * @return mixed
         */
        protected function authenticated(Request $request, $user) {
            if ($request->ajax()) {
                return response(['success' => true, 'redirect' => redirect()->intended($this->redirectPath())->getTargetUrl()], 200);
            }
            return null;
        }

        /**
         * @return string
         */
        public function username() {
            return 'username';
        }
    }
