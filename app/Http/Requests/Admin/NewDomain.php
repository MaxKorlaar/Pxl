<?php

    namespace App\Http\Requests\Admin;

    use Auth;
    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class NewDomain
     *
     * @package App\Http\Requests\Admin
     */
    class NewDomain extends FormRequest {
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
                'domain'     => 'required|string|max:255',
                'protocol' => 'required|in:http,https'
            ];
        }
    }
