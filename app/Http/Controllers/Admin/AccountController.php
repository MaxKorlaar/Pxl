<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\DeleteAccount;
    use App\Http\Requests\NewYacht;
    use App\Http\Requests\UpdateAccount;
    use App\User;
    use App\Yacht;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;

    /**
     * Class AccountController
     *
     * @package App\Http\Controllers\Admin
     */
    class AccountController extends Controller {


        /**
         * Create a new controller instance.
         *
         */
        public function __construct() {

        }

        /**
         * @param UpdateAccount $request
         *
         * @return array
         */
        public function update(UpdateAccount $request) {
            $account = \Auth::getUser();

            if ($request->has('new_password')) {
                if (!$request->has('current_password')) {
                    return back()->withInput()->withErrors([
                        'current_password' => trans('validation.required_with', ['attribute' => trans('validation.attributes.current_password'), 'values' => trans('validation.attributes.new_password')])
                    ]);
                } else {
                    if ($account->verifyPassword($request->get('current_password'))) {
                        $account->setPassword($request->get('new_password'));
                    } else {
                        return back()->withInput()->withErrors([
                            'current_password' => trans('admin.account.current_password_invalid')
                        ]);
                    }
                }
            }
            $account->fill($request->only(['username', 'email']));
            $account->saveOrFail();

            return back()->with('success', trans('admin.account.updated'));
        }

        /**
         * @param DeleteAccount $request
         *
         * @return array
         */
        function delete(DeleteAccount $request) {
            // Keuze is gemaakt :-(
            $account = \Auth::getUser();
            if ($account == null) {
                throw new ModelNotFoundException();
            }
            if($account->delete()) {
                redirect(route('home'));
            }

        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getDeleteView() {
            $account = \Auth::getUser();
            if ($account == null) {
                throw new ModelNotFoundException();
            }
            return view('admin.account.delete', [
                'user' => $account->jsonSerialize()
            ]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getView() {
            $account = \Auth::getUser();
            if ($account == null) {
                throw new ModelNotFoundException();
            }
            return view('admin.account', [
                'user' => $account->jsonSerialize()
            ]);
        }

    }
