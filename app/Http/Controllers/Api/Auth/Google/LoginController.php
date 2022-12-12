<?php

namespace App\Http\Controllers\Api\Auth\Google;

use App\Http\Controllers\Controller;
use JetBrains\PhpStorm\NoReturn;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     */
    public function redirectToProvider(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     */
    #[NoReturn] public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        dd($user);
        // $user->token;
    }
}
