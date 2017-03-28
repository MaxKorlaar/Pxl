<?php

    namespace App\Http\Requests\Api\Image;

    use App\Http\Requests\Api\ApiFormRequest;

    /**
     * Class Upload
     *
     * @package App\Http\Requests\Api\Image
     */
    class Upload extends ApiFormRequest {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize() {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'file' => 'required|file|image',
                'name' => 'string|nullable|max:256'
            ];
        }
    }
