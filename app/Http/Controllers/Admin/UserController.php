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

            $usersPagination->hasMorePages();
            $usersPagination->firstItem();
            $usersPagination->nextPageUrl();
            $usersPagination->previousPageUrl();
            $usersPagination->currentPage();
            $usersPagination->getUrlRange(0, $usersPagination->lastPage());


            return view('admin.users', [
                'pagination' => $usersPagination
            ]);

        }
    }
