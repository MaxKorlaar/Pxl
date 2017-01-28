<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Support\Facades\Auth;

    class RedirectIfAuthenticated {
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
            if (Auth::guard($guard)->check()) {
                if ($request->ajax()) {
                    return ['success' => true, 'info' => 'Already authenticated', 'location' => route('home')];
                }
                return redirect(route('home')); // If the user is already logged in, redirect them back to the home page
            }

            return $next($request);
        }
    }
