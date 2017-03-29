<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;
    use Auth;

    /**
     * Class GalleryController
     *
     * @package App\Http\Controllers\User
     */
    class GalleryController extends Controller {

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getView() {
            $account = Auth::user();
            $images  = $account->images()->getResults();
            return view('user.gallery', [
                'user'   => $account,
                'images' => $images
            ]);
        }

    }
