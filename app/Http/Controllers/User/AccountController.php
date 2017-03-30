<?php

    namespace App\Http\Controllers\User;

    use App\Domain;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\User\DeleteAccount;
    use App\Http\Requests\User\Enable2FA;
    use App\Http\Requests\User\UpdateAccount;
    use App\Http\Requests\User\UpdatePreferences;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        public function getPreferencesView() {
            $account = Auth::user();

            if ($account->default_deletion_time != null) {

                $ref = new \DateTimeImmutable();
                $end = $ref->setTimestamp($ref->getTimestamp() + $account->default_deletion_time);

                $deletionTimeInterval = $ref->diff($end);
                $defaultDeletionTime  = [
                    'minutes' => $deletionTimeInterval->i,
                    'hours'   => $deletionTimeInterval->h,
                    'days'    => $deletionTimeInterval->d,
                    'months'  => $deletionTimeInterval->m,
                    'years'   => $deletionTimeInterval->y
                ];
            } else {
                $defaultDeletionTime = [
                    'minutes' => 0,
                    'hours'   => 0,
                    'days'    => 0,
                    'months'  => 0,
                    'years'   => 0,
                ];
            }

            /** @var Collection $domains */
            $domains = $account->domains()->getResults();

            if ($account->default_domain != null) {
                $domain = Domain::find($account->default_domain);
                if ($domain != null) {
                    $domains->add($domain); // Add domain to list of available domains, even though the user does not own it, if it is on their account
                }
            }

            return view('user.preferences', [
                'user'                  => $account,
                'domains'               => $domains,
                'default_deletion_time' => $defaultDeletionTime
            ]);
        }

        /**
         * @param UpdatePreferences $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function updatePreferences(UpdatePreferences $request) {
            $account = Auth::user();

            $i = $request->default_deletion_time['minutes'];
            $h = $request->default_deletion_time['hours'];
            $d = $request->default_deletion_time['days'];
            $m = $request->default_deletion_time['months'];
            $y = $request->default_deletion_time['years'];

            $deletionTimeInterval = new \DateInterval("P{$y}Y{$m}M{$d}DT{$h}H{$i}M");
            $ref                  = new \DateTimeImmutable();
            $end                  = $ref->add($deletionTimeInterval);

            $account->fill($request->only(['embed_name', 'embed_name_url', 'twitter_username']));
            $account->prefers_preview_link = $request->has('prefers_preview_link');

            $account->default_deletion_time = ($end->getTimestamp() - $ref->getTimestamp() == 0) ? null : $end->getTimestamp() - $ref->getTimestamp();

            /** @var Domain $domain */
            $domain = Domain::find($request->default_domain);
            if ($domain == null || ($domain->user != $account->id && $account->default_domain != $domain->id)) {
                // Check if the user is not already associated with a domain they do not own, an admin could have set it for them
                return back()->withErrors([
                    'default_domain' => trans('user.preferences.domain_not_found')
                ]);
            }
            $account->default_domain = $domain->id;
            $account->saveOrFail();
            return back()->with('success', trans('user.preferences.updated'));
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

        /**
         * @return \Illuminate\Http\RedirectResponse
         */
        public function resetToken() {
            $account               = Auth::user();
            $account->upload_token = $account->id . str_random(60);
            $account->delete_token = $account->id . str_random(60);
            $account->saveOrFail();
            return back()->with('success', trans('user.account.upload_token_reset'));
        }

    }
