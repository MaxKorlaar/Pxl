<?php

    namespace App\Http\Controllers\User;

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
     * @package App\Http\Controllers\User
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
         * @return array|\Illuminate\Http\RedirectResponse
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
                            'current_password' => trans('user.account.current_password_invalid')
                        ]);
                    }
                }
            }
            $account->fill($request->only(['username', 'email']));
            $account->saveOrFail();

            return back()->with('success', trans('user.account.updated'));
        }

        /**
         * @param DeleteAccount $request
         *
         * @return array|int
         */
        function delete(DeleteAccount $request) {
            // Keuze is gemaakt :-(
            $account = \Auth::getUser();
            if ($account == null) {
                throw new ModelNotFoundException();
            }
            if($account->delete()) {
                return redirect(route('home'));
            } else {
                return 500;
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
            return view('user.account.delete', [
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
            return view('user.account', [
                'user' => $account->jsonSerialize()
            ]);
        }

    }
