<?php

    namespace App\Http\Controllers\Help;

    use App\Http\Controllers\Controller;
    use Auth;
    use Illuminate\Http\Request;

    /**
     * Class HelpController
     *
     * @package App\Http\Controllers\Help
     */
    class HelpController extends Controller {

        /**
         * @param Request|\Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getSetupHelpView(Request $request) {
            $account = Auth::user();
            return view('help.setup', [
                'user' => $account
            ]);
        }

        /**
         * @param $userID
         * @param $uploadToken
         *
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
         */
        public function getShareXConfiguration($userID, $uploadToken) {

            $configuration = [
                'Name'            => 'Pxl Custom Uploader - ' . config('app.name'),
                'DestinationType' => 'ImageUploader',
                'RequestType'     => 'POST',
                'RequestURL'      => route('api/upload'),
                'FileFormName'    => 'file',
                'Arguments'       => [
                    'user'         => $userID,
                    'upload-token' => $uploadToken
                ],
                'Headers'         => [
                    'Accept' => 'application/json'
                ],
                'ResponseType'    => 'Text',
                'URL'             => '$json:url$',
                'DeletionURL'     => '$json:delete_url$'
            ];

            return response($configuration);

        }

    }
