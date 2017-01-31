<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Support\Facades\Auth;

    /**
     * Class RedirectIfAuthenticated
     *
     * @package App\Http\Middleware
     */
    class Admin {
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
            if (Auth::guard($guard)->check() && Auth::user()->isAdmin()) {
                return $next($request);
            }
            return redirect(route('home'))->withErrors(['access_denied']); // todo: check errors
        }
    }
