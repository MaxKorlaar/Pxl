<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;
    use App\Image;
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
            $account          = Auth::user();
            $imagesPagination = Image::whereUserId($account->id)->paginate(20);

            return view('user.gallery', [
                'user'   => $account,
                'pagination' => $imagesPagination
            ]);
        }

    }
