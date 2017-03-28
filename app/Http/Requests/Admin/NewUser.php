<?php

    namespace App\Http\Requests\Admin;

    use Auth;
    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class NewUser
     *
     * @package App\Http\Requests\Admin
     */
    class NewUser extends FormRequest {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize() {
            $user = Auth::user();
            if ($user == null) return false;
            return $user->isAdmin();
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'username' => 'required|max:255|min:2|unique:users',
                'email'    => 'required|max:255|email|unique:users'
            ];
        }
    }
