<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use JetBrains\PhpStorm\NoReturn;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating Google users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return void
     */
    #[NoReturn] public function handleProviderCallback(): void
    {
        $user = Socialite::driver('google')->stateless()->user();

        Auth::login($user);

        dd($user);
        // $user->token;
    }
}
