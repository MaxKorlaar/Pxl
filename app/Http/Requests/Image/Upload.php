<?php

    namespace App\Http\Requests\Image;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class Upload
     *
     * @package App\Http\Requests\Image
     */
    class Upload extends FormRequest {
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
                'file' => 'required|file|image',
                //'name' => 'string|nullable|max:256'
            ];
        }
    }
