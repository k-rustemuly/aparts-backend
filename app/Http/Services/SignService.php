<?php

namespace App\Http\Services;

use App\Http\Resources\SignInResource;
use Illuminate\Support\Facades\Auth;

class SignService
{

    /**
     * @param array<string,string> $credentials
     *
     * @return App\Http\Resources\SignInResource|null
     */
    public function signIn(array $credentials)
    {
        if(Auth::guard()->attempt($credentials)) {
            $user = auth()->user();
            return new SignInResource($user);
        }
        return null;
    }

}
