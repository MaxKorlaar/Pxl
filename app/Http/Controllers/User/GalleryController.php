<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Image\UpdateDeletionTimestamp;
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
            $imagesPagination = Image::whereUserId($account->id)->orderBy('id', 'desc')->paginate(24);

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
         * @param UpdateDeletionTimestamp|Request $request
         * @param                                 $imageUrl
         *
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
         */
        public function setImageDeletionTimestamp(UpdateDeletionTimestamp $request, $imageUrl) {
            $user = Auth::user();

            /** @var Image $image */
            $image = Image::whereUrlName($imageUrl)->where('user_id', '=', $user->id)->get()->first();

            if ($image == null) {
                return response([
                    'success' => false,
                    'error'   => trans('gallery.image_not_found')
                ]);
            }

            if ($request->scheduled_deletion_timestamp < time()) {
                if ($request->scheduled_deletion_timestamp == -1) {
                    $image->deletion_timestamp = null;
                } else {
                    return response([
                        'success' => false,
                        'error'   => trans('gallery.timestamp_in_the_past')
                    ]);
                }
            } else {
                $image->deletion_timestamp = $request->scheduled_deletion_timestamp;
            }

            $result = $image->save();
            if (!$result) {
                return response([
                    'success' => false,
                    'error'   => trans('gallery.deletion_time_could_not_be_saved')
                ]);
            }

            return response([
                'success'           => true,
                'message'           => trans('gallery.deletion_time_updated'),
                'readableTimestamp' => $image->deletion_timestamp == null ? trans('datetime.never') : date(trans('datetime.format.date_and_time'), $image->deletion_timestamp)
            ]);
        }

    }
