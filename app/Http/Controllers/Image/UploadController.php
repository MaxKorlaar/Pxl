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
         * @param Upload $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function uploadImage(Upload $request) {
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

            dd($image->getUrlToImage());

            return back()->with('success', trans('upload.success.with_url', ['url' => $user->prefers_preview_link ? $image->getUrlToImagePreview() : $image->getUrlToImage()]));
            //dd($request->file('file'), $request->file('file')->extension());
        }

    }
