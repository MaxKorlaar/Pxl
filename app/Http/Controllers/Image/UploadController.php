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
            return view('image.upload', []);
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
            if ($domain == null) {
                return response(['success' => false, 'error' => trans('upload.failed.no_default_domain')], 422);
            }

            $image                = Image::processNew($request->file('file'));
            $image->uploaded_from = $request->ip();

            $image->user_id   = $user->id;
            $image->domain_id = $domain->id;
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
                    'delete_url' => 'TODO'//TODO
                ], 200);
            }

        }

        /**
         * @param Upload $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function uploadImageFromSite(Upload $request) {
            /** @var User $user */
            $user   = $request->user();
            $domain = Domain::find($user->default_domain);
            if ($domain == null) {
                // User does not have a (valid) default domain - Cancel request
                return back()->withErrors([
                    'error' => trans('upload.failed.no_default_domain')
                ]);
            }
            $image                = Image::processNew($request->file('file'));
            $image->uploaded_from = $request->ip();

            $image->user_id   = $user->id;
            $image->domain_id = $domain->id;
            $result           = $image->storeImage('uploads'); // This also saves the image to the database

            if (!$result) {
                return back()->withErrors([
                    'error' => trans('upload.failed.could_not_save_image')
                ]);
            }

            return back()->with('success', trans('upload.success.with_url', ['url' => $user->prefers_preview_link ? $image->getUrlToImagePreview() : $image->getUrlToImage()]));
        }

    }
