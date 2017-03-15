<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\NewYacht;
    use App\User;
    use App\Yacht;
    use Illuminate\Http\Request;

    /**
     * Class IndexController
     *
     * @package App\Http\Controllers\Admin
     */
    class IndexController extends Controller {


        /**
         * Create a new controller instance.
         *
         */
        public function __construct() {

        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getView() {
            $yachts = Yacht::all();
            return view('admin.index', [
                'yachts' => $yachts
            ]);
        }

        /**
         * @param NewYacht $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function newYacht(NewYacht $request) {
            $yacht             = new Yacht($request->all());
            $yacht->is_visible = false;
            $yacht->setSlug();
            $yacht->save();
            return redirect()->route('admin/yacht_editor', ['yacht' => $yacht])->with('success', trans('admin.yacht_added'));
        }

    }
