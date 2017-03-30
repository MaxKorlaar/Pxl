<?php

    namespace App\Http\Requests\Image;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class UpdateDeletionTimestamp
     *
     * @package App\Http\Requests\Image
     */
    class UpdateDeletionTimestamp extends FormRequest {
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
                'scheduled_deletion_timestamp' => 'required|integer|min:-1|max:' . (time() + (5 * 31557600)) // Max 5 years into the future?
            ];
        }
    }
