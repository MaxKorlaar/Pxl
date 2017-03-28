<?php

    namespace App\Http\Middleware;

    use App\User;
    use Closure;

    /**
     * Class API
     *
     * @package App\Http\Middleware
     */
    class Api {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         * @param  string|null              $guard
         *
         * @return mixed
         */
        public function handle($request, Closure $next, $guard = null) {
            if ($request->has('user') && $request->has('upload-token')) {
                /** @var User $user */
                $user = User::find($request->get('user'));
                if ($user !== null && $user->upload_token == $request->get('upload-token')) {
                    \Auth::onceUsingId($user->id);
                    return $next($request);
                }
                return response(['success' => false, 'error' => 'Invalid credentials'], 403);

            }
            return response(['success' => false, 'error' => 'Missing authentication credentials'], 400);
        }
    }
