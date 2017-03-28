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

    }
