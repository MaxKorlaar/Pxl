<?php

    namespace App\Http\Requests\User;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class DeleteAccount
     *
     * @package App\Http\Requests
     */
    class DeleteAccount extends FormRequest {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize() {
            return \Auth::check();
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                //
            ];
        }
    }
