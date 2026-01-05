<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        session()->flash('error', 'ログインしてください');

        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            route('login')
        );
    }
}
