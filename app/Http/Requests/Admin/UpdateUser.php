<?php

    namespace App\Http\Requests\Admin;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class UpdateUser
     *
     * @package App\Http\Requests\Admin
     */
    class UpdateUser extends FormRequest {
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
                'username'     => 'required|max:255|min:2',
                'email'        => 'required|max:255|email',
                'rank'         => 'required|in:admin,member',
                'enabled'      => 'boolean',
                '2fa_enabled'  => 'boolean',
                'new_password' => 'nullable|confirmed|required_with:current_password|min:6'
            ];
        }
    }
