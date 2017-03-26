<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;

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
            return view('admin.index', [
            ]);
        }

    }