<?php
namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'GET,POST,OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
           // 'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
            'Access-Control-Allow-Headers'     => '*'
        ];

        if ($request->isMethod('OPTIONS'))
        {

            $headers = [
                'Access-Control-Allow-Origin'      => '*',
                'Access-Control-Allow-Methods'     => 'GET,POST,OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Max-Age'           => '86400',
                // 'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
                'Access-Control-Allow-Headers'     => '*',
                'Content-Length'=>'2',
                'Content-Type'=>'application/json'
                // 'Content-Type'=>'application/json'
            ];
           // header("Content-Length: 0");
           // header("Content-Type: text/plain");
           // return response()->json('{"method":"OPTIONS"}', 200, $headers);
            return response()->json([], 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }

        return $response;
    }
}