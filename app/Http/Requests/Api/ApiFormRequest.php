<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Http\JsonResponse;

    /**
     * Class ApiFormRequest
     *
     * @package app\Http\Requests\Api
     */
    class ApiFormRequest extends FormRequest {
        /**
         * Get the proper failed validation response for the request.
         *
         * @param  array $errors
         *
         * @return JsonResponse|\Illuminate\Http\RedirectResponse
         */
        public function response(array $errors) {

            if ($this->expectsJson() || $this->get('return', false) == 'json') { // Return JSON when expected via 'Accept: application/json' header or ?return=json in the url
                return new JsonResponse($errors, 422);
            }

            return $this->redirector->to($this->getRedirectUrl())
                ->withInput($this->except($this->dontFlash))
                ->withErrors($errors, $this->errorBag);
        }
    }