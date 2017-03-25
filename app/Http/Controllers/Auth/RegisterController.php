<?php

    namespace App\Http\Controllers\Auth;

    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Http\Request;

    /**
     * Class RegisterController
     *
     * @package App\Http\Controllers\Auth
     */
    class RegisterController extends Controller {
        /*
        |--------------------------------------------------------------------------
        | Register Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles the registration of new users as well as their
        | validation and creation. By default this controller uses a trait to
        | provide this functionality without requiring any additional code.
        |
        */

        use RegistersUsers;

        /**
         * Where to redirect users after registration.
         *
         * @var string
         */
        protected $redirectTo = '/';

        /**
         * Create a new controller instance.
         *
         */
        public function __construct() {
            $this->middleware('guest');
            $this->redirectTo = route('user/gallery');
        }

        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array $data
         *
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data) {
            return Validator::make($data, [
                'username' => 'required|max:255|min:2|unique:users',
                'email'    => 'required|email|max:255|confirmed|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
        }


        /**
         * Handle a registration request for the application.
         *
         * @param \Illuminate\Http\Request|Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function register(Request $request) {
            $this->validator($request->all())->validate(); //Automatically redirects back including errors and old fields

            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        }

        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array $data
         *
         * @return User
         */
        protected function create(array $data) {
            $user           = new User;
            $user->username = $data['username'];
            $user->email    = $data['email'];
            $user->rank     = 'member';
            $user->setPassword($data['password']);
            $user->last_ip    = Request::capture()->ip();
            $user->last_login = time();
            $user->save();
            return $user;
        }
    }
