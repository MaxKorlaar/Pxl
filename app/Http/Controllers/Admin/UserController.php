<?php

    namespace App\Http\Controllers\Admin;

    use App\User;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    /**
     * Class UserController
     *
     * @package App\Http\Controllers\Admin
     */
    class UserController extends Controller {
        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getView() {
            $usersPagination = User::paginate(15);

            return view('admin.users', [
                'users' => $usersPagination->items(),
                't'     => [$usersPagination->nextPageUrl(), $usersPagination->previousPageUrl()]
            ]);

        }
    }
