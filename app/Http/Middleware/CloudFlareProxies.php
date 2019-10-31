<?php namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CloudFlareProxies
 * https://gist.github.com/Ingramz/bbb8f4f2634e0701c186
 *
 * @package App\Http\Middleware
 */
class CloudFlareProxies {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // Proxies obtained from https://www.cloudflare.com/ips-v4
        $request->setTrustedProxies([
            '199.27.128.0/21',
            '173.245.48.0/20',
            '103.21.244.0/22',
            '103.22.200.0/22',
            '103.31.4.0/22',
            '141.101.64.0/18',
            '108.162.192.0/18',
            '190.93.240.0/20',
            '188.114.96.0/20',
            '197.234.240.0/22',
            '198.41.128.0/17',
            '162.158.0.0/15',
            '104.16.0.0/12'
        ], Request::HEADER_X_FORWARDED_ALL);

        return $next($request);
    }
}
