<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Create\Create as CreateUserDataDto;
use App\Dto\Create\User\Google as CreateGoogleUserDto;
use App\Http\Controllers\Controller;
use App\Repository\User\Create as CreateUserRepository;
use App\Services\User\Create as CreateUserService;
use App\Strategies\Create\User\Google as GoogleCreateUserStrategy;
use JetBrains\PhpStorm\NoReturn;
use Laravel\Socialite\Facades\Socialite;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    private const GOOGLE_DRIVER = 'google';


    public function __construct(
        private CreateUserRepository $createUserRepository
    )
    {
    }

    /**
     * @param CreateUserDataDto $createUserData
     * @return GoogleCreateUserStrategy
     */
    protected function initStrategy(CreateUserDataDto $createUserData): GoogleCreateUserStrategy
    {
       return new GoogleCreateUserStrategy($this->createUserRepository, $createUserData);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver(self::GOOGLE_DRIVER)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return void
     * @throws UnknownProperties
     */
    #[NoReturn] public function handleProviderCallback(): void
    {
        $userData = Socialite::driver(self::GOOGLE_DRIVER)->stateless()->user();

        $createUserDto = new CreateGoogleUserDto([
            'email' => $userData['email'],
            'provider_id' => $userData['id'],
            'name' => $userData['name'],
        ]);

        $dd = app(CreateUserService::class)->execute($this->initStrategy($createUserDto));

//        Auth::login($userData);

        dd($dd);
        dd($userData);
        // $user->token;
    }


}
