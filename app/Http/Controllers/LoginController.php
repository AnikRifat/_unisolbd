<?php

namespace App\Http\Controllers;

use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;

class LoginController extends AuthenticatedSessionController
{
    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            if($this->guard->user()->status == 2){
                return app(LoginResponse::class);
            }
            else{
                return back();

            }

        });
    }
}
