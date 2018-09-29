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
            //'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
           // 'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
            'Access-Control-Allow-Headers'     => '*'
        ];

        if ($request->isMethod('OPTIONS'))
        {

            $headers = [
                'Access-Control-Allow-Origin'      => '*',
                'Access-Control-Allow-Methods'     => 'GET,POST,OPTIONS, PUT, DELETE',
               // 'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Max-Age'           => '86400',
                // 'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
                'Access-Control-Allow-Headers'     => '*',
                //'Content-Length'=>'0',
                'Content-Type'=>'application/json'
                // 'Content-Type'=>'text/plain'
            ];
           // header("Content-Length: 0");
           // header("Content-Type: text/plain");
           // return response()->json('{"method":"OPTIONS"}', 200, $headers);
            return response()->json(["method"=>"OPTIONS"], 200, $headers)
                ->setCallback($request->input('callback'));


            //return response()->json([], 200, $headers);
            /*
            return response("",200)
                ->header('Access-Control-Allow-Origin','*')
                ->header('Access-Control-Allow-Methods','POST, GET, OPTIONS, PUT, DELETE')
                ->header('Access-Control-Allow-Credentials','true')
                ->header('Access-Control-Max-Age','86400')
                ->header('Access-Control-Allow-Headers','*')
                ->header('Content-Length','0')
                ->header('Content-Type','text/plain');
            */
        }

        $response = $next($request);
        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }

        return $response;
    }
}