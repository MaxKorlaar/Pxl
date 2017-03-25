<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Requests\Admin\UpdateUser;
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

        /**
         * @param Request $request
         * @param User    $user
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getEditView(Request $request, User $user) {
            return view('admin.users.edit', [
                'user' => $user
            ]);
        }

        /**
         * @param UpdateUser $request
         *
         * @param User       $user
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(UpdateUser $request, User $user) {

            if ($request->has('new_password')) {
                //
            }
            var_dump($request->all());
            $user->fill($request->only(['username', 'email']));
            $user->rank = $request->rank;
            $user->saveOrFail();
            return back()->with('success', trans('admin.users.edit.updated'));
        }
    }
