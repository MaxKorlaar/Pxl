<?php

    namespace App\Http\Controllers\Image;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Image\Upload;
    use App\Image;
    use App\User;

    /**
     * Class UploadController
     *
     * @package App\Http\Controllers\Image
     */
    class UploadController extends Controller {

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getFormView() {
            return view('image.upload', []);
        }

        /**
         * @param Upload $request
         */
        public function uploadImage(Upload $request) {
            $image = Image::processNew($request->file('file'));

            $image->uploaded_from = $request->ip();
            /** @var User $user */
            $user             = $request->user();
            $image->user_id   = $user->id;
            $image->domain_id = $user->default_domain;
            $result           = $image->storeImage('uploads'); // This also saves the image to the database
            dd($image->getUrlToImage());
            //dd($request->file('file'), $request->file('file')->extension());
        }

    }
