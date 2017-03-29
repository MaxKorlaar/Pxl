<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;
    use App\Image;
    use Auth;
    use Request;

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
            $imagesPagination = Image::whereUserId($account->id)->orderBy('id', 'desc')->paginate(20);

            return view('user.gallery', [
                'user'       => $account,
                'pagination' => $imagesPagination
            ]);
        }

        /**
         * @param Request $request
         * @param         $imageUrl
         *
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
         */
        public function deleteImage(Request $request, $imageUrl) {
            $user = Auth::user();

            /** @var Image $image */
            $image = Image::whereUrlName($imageUrl)->where('user_id', '=', $user->id)->get()->first();

            if ($image == null) {
                return response([
                    'success' => false,
                    'error'   => trans('gallery.image_not_found')
                ]);
            }

            $result = $image->delete();
            if (!$result) {
                return response([
                    'success' => false,
                    'error'   => trans('gallery.image_could_not_be_deleted')
                ]);
            }

            return response([
                'success' => true,
                'message' => trans('gallery.image_deleted')
            ]);
        }

        /**
         * @param Request $request
         * @param         $imageUrl
         */
        public function setImageDeletionTimestamp(Request $request, $imageUrl) {

        }

    }
