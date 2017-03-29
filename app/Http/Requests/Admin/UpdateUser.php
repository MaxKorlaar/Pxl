<?php

    namespace App\Http\Requests\Admin;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Request;

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
                'id'                   => 'bail|required|integer',
                'username'             => 'required|max:255|min:2|unique:users,username,' . Request::get('id'),
                'email'                => 'required|max:255|email|unique:users,email,' . Request::get('id'),
                'rank'                 => 'required|in:admin,member',
                'enabled'              => 'boolean',
                '2fa_enabled'          => 'boolean',
                'new_password'         => 'nullable|confirmed|required_with:current_password|min:6',
                'embed_name'           => 'string|nullable|max:255',
                'embed_name_url'       => 'url|nullable|max:1024',
                'twitter_username'     => 'string|nullable|max:16',
                'prefers_preview_link' => 'boolean',
                'default_domain'       => 'required|integer|min:1',
                'default_deletion_time.minutes' => 'required|integer|min:0|max:59',
                'default_deletion_time.hours'   => 'required|integer|min:0|max:23',
                'default_deletion_time.days'    => 'required|integer|min:0|max:30',
                'default_deletion_time.months'  => 'required|integer|min:0|max:11',
                'default_deletion_time.years'   => 'required|integer|min:0|max:3'
            ];

        }
    }
