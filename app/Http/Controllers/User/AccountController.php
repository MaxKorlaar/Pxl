<?php

    namespace App\Http\Controllers\User;

    use App\Http\Controllers\Controller;

    use App\Http\Requests\User\DeleteAccount;
    use App\Http\Requests\User\Enable2FA;
    use App\Http\Requests\User\UpdateAccount;
    use App\User;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;

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
            $account = Auth::user();

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
            $account = Auth::user();
            if ($account == null) {
                throw new ModelNotFoundException();
            }
            if ($account->delete()) {
                return redirect(route('home'));
            } else {
                return 500;
            }
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getDeleteView() {
            $account = Auth::user();
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
            $account = Auth::user();
            if ($account == null) {
                throw new ModelNotFoundException();
            }
            return view('user.account', [
                'user' => $account
            ]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function get2faSetupView() {
            $account = Auth::user();

            if ($account->hasTwoFactorAuth()) return back();

            $secret = $account->generate2faSecret();
            Session::flash('2fa_secret', $secret);
            $qrCodeUrl = $account->get2faQRCode($secret);

            return view('user.account.2fa.setup', [
                'user'      => $account,
                'secret'    => $secret,
                'qrCodeUrl' => $qrCodeUrl
            ]);
        }

        /**
         * @param Enable2FA $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function finish2faSetup(Enable2FA $request) {
            $account = Auth::user();
            if (!Session::has('2fa_secret')) {
                return back()->withErrors([
                    'key' => trans('user.account.2fa.missing_secret')
                ]);
            }

            $secret = Session::get('2fa_secret');

            if (\Google2FA::verifyKey($secret, $request->key)) {
                $account->twoFactorToken = $secret;
                $account->saveOrFail();

                $qrCodeUrl = $account->get2faQRCode($secret);
                return view('user.account.2fa.confirm', [
                    'user'      => $account,
                    'secret'    => $secret,
                    'qrCodeUrl' => $qrCodeUrl
                ]);
            } else {
                return back()->withErrors([
                    'key' => trans('user.account.2fa.invalid_key')
                ]);
            }

        }

        /**
         * @return \Illuminate\Http\RedirectResponse
         */
        public function disable2fa() {
            $account                 = Auth::user();
            $account->twoFactorToken = null;
            $account->saveOrFail();
            return back()->with('success', trans('user.account.2fa.has_been_disabled'));
        }

    }
