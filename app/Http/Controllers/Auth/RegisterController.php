<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Create\Create as CreateUserDataDto;
use App\Dto\Create\User\Form as CreateFormUserDto;
use App\Http\Requests\User\Create as UserCreateRequest;
use App\Models\User\User;
use App\Services\User\Create as CreateUserService;
use App\Strategies\Create\User\Form as FormCreateUserStrategy;
use Illuminate\Http\Request;
//use App\Helpers\LocaleHelper;
//use App\Helpers\RequestHelper;
//use App\Jobs\SendNewUserAlert;
//use App\Helpers\InstanceHelper;
//use App\Models\Account\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\View\View;
use App\Repository\User\Create as CreateUserRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Form Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * BaseCreate a new controller instance.
     *
     * @return void
     */
    public function __construct(
        private CreateUserRepository $createUserRepository
    )
    {
        $this->middleware('guest');
    }

    /**
     * @param CreateUserDataDto $createUserData
     * @return FormCreateUserStrategy
     */
    protected function initStrategy(CreateUserDataDto $createUserData): FormCreateUserStrategy
    {
        return new FormCreateUserStrategy($this->createUserRepository, $createUserData);
    }

    /**
     * Show the application registration form.
     *
     * @param Request $request
     * @return View
     */
    public function showRegistrationForm(Request $request): \Illuminate\View\View
    {
        return view('auth.register');
    }

    /**
     * BaseCreate a new user instance after a valid registration.
     *
     * @param  UserCreateRequest  $request
     * @return User|null
     */
    protected function create(UserCreateRequest $request): ?User
    {
        try {
            $createUserDto = new CreateFormUserDto([
                'password' => $request['passpoet'],
                'email' => $request['email'],
                'name' => $request['name'],
            ]);

           $user = app(CreateUserService::class)->execute($this->initStrategy($createUserDto));

            dd($user);
//            $account = User::createDefault(
//                $data['first_name'],
//                $data['last_name'],
//                $data['email'],
//                $data['password'],
//                RequestHelper::ip(),
//                $data['lang']
//            );
            /** @var User */
//            $user = $account->users()->first();

//            if (! $first) {
                // send me an alert
//                SendNewUserAlert::dispatch($user);
//            }

//            return $user;
            return new User();
        } catch (\Exception $e) {
            Log::error($e);

            abort(500, trans('auth.signup_error'));
        }
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if (! is_null($user)) {
            /** @var int $count */
            $count = Account::count();
            if (! config('monica.signup_double_optin') || $count == 1) {
                // if signup_double_optin is disabled, skip the confirm email part
                $user->markEmailAsVerified();
            }
        }
    }
}
