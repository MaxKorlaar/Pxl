<?php

    namespace App\Http\Controllers\Admin;

    use App\Domain;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\NewUser;
    use App\Http\Requests\Admin\UpdateUser;
    use App\User;
    use Illuminate\Http\Request;

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

            if ($user->default_deletion_time != null) {

                $ref = new \DateTimeImmutable();
                $end = $ref->setTimestamp($ref->getTimestamp() + $user->default_deletion_time);

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
            return view('admin.users.edit', [
                'user'                  => $user,
                'domains'               => Domain::all(),
                'upload_token_masked'   => substr($user->upload_token, 0, 10) . '**********',
                'default_deletion_time' => $defaultDeletionTime

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
                $user->setPassword($request->new_password);
            }

            if ($user->hasTwoFactorAuth()) {
                if (!$request->has('2fa_status')) {
                    $user->twoFactorToken = null; // Clear 2fa from account
                }
            }

            $user->fill($request->only(['username', 'email', 'embed_name', 'embed_name_url', 'twitter_username']));
            $user->rank                 = $request->rank;
            $user->active               = $request->has('enabled');
            $user->prefers_preview_link = $request->has('prefers_preview_link');

            $i = $request->default_deletion_time['minutes'];
            $h = $request->default_deletion_time['hours'];
            $d = $request->default_deletion_time['days'];
            $m = $request->default_deletion_time['months'];
            $y = $request->default_deletion_time['years'];

            $deletionTimeInterval = new \DateInterval("P{$y}Y{$m}M{$d}DT{$h}H{$i}M");
            $ref                  = new \DateTimeImmutable();
            $end                  = $ref->add($deletionTimeInterval);

            $user->default_deletion_time = ($end->getTimestamp() - $ref->getTimestamp() == 0) ? null : $end->getTimestamp() - $ref->getTimestamp();

            /** @var Domain $domain */
            $domain = Domain::find($request->default_domain);
            if ($domain == null) {
                return back()->withErrors([
                    'default_domain' => trans('user.preferences.domain_not_found')
                ]);
            }
            $user->default_domain = $domain->id;

            $user->saveOrFail();
            return back()->with('success', trans('admin.users.edit.updated'));
        }

        /**
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getNewUserView(Request $request) {
            return view('admin.users.new', []);
        }

        /**
         * @param NewUser $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function newUser(NewUser $request) {
            $user = new User;
            $user->fill($request->only(['email', 'username']));
            $password = str_random(16);
            $user->setPassword($password);
            $user->rank    = 'member';
            $user->last_ip = '-';
            $user->active  = true;
            $user->saveOrFail();
            $user->embed_name   = $request->username;
            $user->upload_token = $user->id . str_random(60);
            $user->delete_token = $user->id . str_random(60);
            $user->default_deletion_time = null;
            $user->saveOrFail();
            return back()->with('success', trans('admin.users.new.created', ['user' => $user->username, 'password' => $password]));
        }

        /**
         * @param Request $request
         * @param User    $user
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function resetToken(Request $request, User $user) {
            $user->upload_token = $user->id . str_random(60);
            $user->delete_token = $user->id . str_random(60);
            $user->saveOrFail();
            return back()->with('success', trans('admin.users.edit.upload_token_reset'));
        }


        /**
         * @param Request $request
         * @param User    $user
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getDeleteView(Request $request, User $user) {
            return view('admin.users.delete', [
                'user' => $user
            ]);
        }


        /**
         * @param Request $request
         * @param User    $user
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function deleteUser(Request $request, User $user) {
            $user->delete();
            return redirect(route('admin/users'))->with('success', trans('admin.users.deleted'));
        }
    }
