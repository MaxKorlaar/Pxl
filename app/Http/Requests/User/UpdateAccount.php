<?php

    namespace App\Http\Requests\User;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\Factory as ValidationFactory;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class UpdateAccount
     *
     * @package App\Http\Requests
     */
    class UpdateAccount extends FormRequest {
        protected $dontFlash = [];

        /**
         * Determine if the user is authorized to make this request.
         *
         * @return \App\User|bool
         */
        public function authorize() {
            return Auth::check();
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'username'         => 'required|max:255|min:2|unique:users,username,' . Auth::user()->id,
                'email'            => 'required|max:255|email|unique:users,email,' . Auth::user()->id,
                'current_password' => 'nullable|required_with:new_password|min:6',
                'new_password'         => 'nullable|confirmed|required_with:current_password|min:6'
            ];
        }

    }
