<?php

    namespace App\Http\Requests\User;

    use Auth;
    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class UpdatePreferences
     *
     * @package App\Http\Requests\User
     */
    class UpdatePreferences extends FormRequest {

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
                'embed_name'                    => 'string|nullable|max:255',
                'embed_name_url'                => 'url|nullable|max:1024',
                'twitter_username'              => 'string|nullable|max:16',
                'prefers_preview_link'          => 'boolean',
                'default_domain'                => 'required|integer|min:1',
                'default_deletion_time.minutes' => 'required|integer|min:0|max:59',
                'default_deletion_time.hours'   => 'required|integer|min:0|max:23',
                'default_deletion_time.days'    => 'required|integer|min:0|max:30',
                'default_deletion_time.months'  => 'required|integer|min:0|max:11',
                'default_deletion_time.years'   => 'required|integer|min:0|max:5'
            ];
        }
    }
