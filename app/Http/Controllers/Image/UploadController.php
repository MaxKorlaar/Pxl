<?php

    namespace App\Http\Controllers\Image;

    use App\Domain;
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

            return view('image.upload', [
                'max_upload_size' => $this->getMaxUploadSize(),
                'max_files' => ini_get('max_file_uploads')
            ]);
        }


        /**
         * @return string
         */
        public function getMaxUploadSize() {
            $postMax = ini_get('post_max_size');
            $uploadMax = ini_get('upload_max_filesize');
            return $uploadMax < $postMax ? $uploadMax : $postMax;
        }

        /**
         * @param \App\Http\Requests\Api\Image\Upload|Upload $request
         *
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
         */
        public function uploadImage(\App\Http\Requests\Api\Image\Upload $request) {
            /** @var User $user */
            $user   = $request->user();
            $domain = Domain::find($user->default_domain);
            if (config('pxl.force_2fa') && !$user->hasTwoFactorAuth()) {
                return response(['succes' => false, 'error' => trans('upload.failed.no_2fa_but_required')],422);
            }
            if ($domain == null) {
                return response(['success' => false, 'error' => trans('upload.failed.no_default_domain')], 422);
            }

            $image                = Image::processNew($request->file('file'));
            $image->uploaded_from = $request->ip();

            $image->user_id   = $user->id;
            $image->domain_id = $domain->id;

            if ($user->default_deletion_time != null) {
                $image->deletion_timestamp = time() + $user->default_deletion_time;
            } else {
                $image->deletion_timestamp = null;
            }

            if ($request->has('name')) $image->name = $request->name;
            $result = $image->storeImage('uploads'); // This also saves the image to the database
            if (!$result) {
                response(['success' => false, 'error' => trans('upload.failed.could_not_save_image')], 422);
            }

            if ($request->get('return', false) == 'json_on_error') {
                return response($user->prefers_preview_link ? $image->getUrlToImagePreview() : $image->getUrlToImage(), 200);
            } else {
                return response([
                    'success'     => true,
                    'url'         => $user->prefers_preview_link ? $image->getUrlToImagePreview() : $image->getUrlToImage(),
                    'image_url'   => $image->getUrlToImage(),
                    'preview_url' => $image->getUrlToImagePreview(),
                    'name'        => $image->name,
                    'delete_url'  => route('user/gallery')//TODO Link directly to some kind of confirmation prompt
                ], 200);
            }

        }

        /**
         * @param Upload $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function uploadImagesFromSite(Upload $request) {
            /** @var User $user */
            $user   = $request->user();
            $domain = Domain::find($user->default_domain);

            if (config('pxl.force_2fa') && !$user->hasTwoFactorAuth()) {
                // User does not have 2FA enabled
                return back()->withErrors([
                    'error' => trans('upload.failed.no_2fa_but_required')
                ]);
            }
            if ($domain == null) {
                // User does not have a (valid) default domain - Cancel request
                return back()->withErrors([
                    'error' => trans('upload.failed.no_default_domain')
                ]);
            }
            $images = $request->file('images');

            $success = [];

            foreach ($images as $requestImage) {
                $image                = Image::processNew($requestImage);
                $image->uploaded_from = $request->ip();

                $image->user_id = $user->id;
                if ($user->default_deletion_time != null) {
                    $image->deletion_timestamp = time() + $user->default_deletion_time;
                } else {
                    $image->deletion_timestamp = null;
                }
                $image->domain_id = $domain->id;
                $result           = $image->storeImage('uploads'); // This also saves the image to the database

                if (!$result) {
                    return back()->withErrors([
                        'error' => trans('upload.failed.could_not_save_image')
                    ]);
                }
                $success[] = trans('upload.success.with_url', ['url' => $user->prefers_preview_link ? $image->getUrlToImagePreview() : $image->getUrlToImage()]);
            }

            return back()->with('success', $success);
        }

    }
