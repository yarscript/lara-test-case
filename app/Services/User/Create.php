<?php

namespace App\Services\User;

use App\Models\User\User;
use App\Repository\BaseRepository;
use App\Repository\User\CreateContract as CreateUserRepositoryContract;
use App\Services\BaseService;
use App\Strategies\Create\BaseCreate as CreateStrategyAbstract;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

/**
 *
 */
class Create extends BaseService
{
    /**
     * BaseCreate a user.
     *
     * @param CreateStrategyAbstract $strategy
     * @return User
     */
    public function execute(CreateStrategyAbstract $strategy): User
    {
        $user = $strategy->execute();
        $user->save();

        return $user;
    }

    /**
     * BaseCreate a user.
     *
     * @param array $data
     * @return User
     */
    private function createUser(array $data): User
    {
        return $this->repository->createUser([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'ip_addr' => $data['ip_address'],
        ]);
    }

    /**
     * Set the regional default parameters.
     *
     * @param User $user
     * @param string|null $ipAddress
     * @return User
     */
    private function setRegionalParameters($user, $ipAddress): User
    {
        $infos = RequestHelper::infos($ipAddress);

        // Associate timezone and currency
        $currencyCode = $infos['currency'];
        $timezone = $infos['timezone'];
        if ($infos['country']) {
            $country = CountriesHelper::getCountry($infos['country']);
        } else {
            $country = CountriesHelper::getCountryFromLocale($user->locale);
        }

        // Timezone
        if (!is_null($timezone)) {
            $user->timezone = $timezone;
        } elseif (!is_null($country)) {
            $user->timezone = CountriesHelper::getDefaultTimezone($country);
        } else {
            $user->timezone = config('app.timezone');
        }

        // Currency
        if ((!is_null($currencyCode)
                && !$this->associateCurrency($user, $currencyCode))
            || !is_null($country)) {
            foreach ($country->getCurrencies() as $currency) {
                if ($this->associateCurrency($user, $currency['iso_4217_code'])) {
                    break;
                }
            }
        }

        // Temperature scale
        if (!is_null($country)) {
            switch ($country->getIsoAlpha2()) {
                case 'US':
                case 'BZ':
                case 'KY':
                    $user->temperature_scale = 'fahrenheit';
                    break;
                default:
                    $user->temperature_scale = 'celsius';
                    break;
            }
        } else {
            $user->temperature_scale = 'celsius';
        }

        return $user;
    }

    /**
     * Associate currency with the User.
     *
     * @param User $user
     * @param string $currency
     * @return bool
     */
    private function associateCurrency($user, $currency): bool
    {
        $currencyObj = Currency::where('iso', $currency)->first();
        if (!is_null($currencyObj)) {
            $user->currency()->associate($currencyObj);

            return true;
        }

        return false;
    }
}
