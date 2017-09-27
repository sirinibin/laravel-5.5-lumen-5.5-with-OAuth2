<?php

namespace App\Providers;

use App\User;
use App\AuthorizationCodes;
use App\AccessTokens;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            $headers=$request->headers->all();

            if(!empty($headers['x-access-token'][0])) {
                return $this->findIdentityByAccessToken($headers['x-access-token'][0]);
            }
            else if ($request->input('access_token')) {
                return $this->findIdentityByAccessToken($request->input('api_token'));
            }

            /*
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
            */
        });
    }
    public function findIdentityByAccessToken($token)
    {
        $access_token = AccessTokens::where(['token' => $token])->first();

        if ($access_token) {
            if ($access_token->expires_at < time()) {

                $response = [
                    'status' => 0,
                    'error' => "Access token expired"
                ];
                response()->json($response, 400, [], JSON_PRETTY_PRINT)->send();
                die;

            }

            return User::where(['id'=>$access_token->user_id])->first();

        } else {
            $response = [
                'status' => 0,
                'error' => "Access token not found"
            ];
            response()->json($response, 400, [], JSON_PRETTY_PRINT)->send();
            die;
        }
    }
}
