<?php

namespace App\Providers;

use App\Helpers\RolePermission;
use App\Http\Grants\PhoneGrant;
use Carbon\Carbon;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\UserAddress' => 'App\Policies\UserAddressPolicy',
    ];

    public function register()
    {
        parent::register();
        app()->afterResolving(AuthorizationServer::class, function (AuthorizationServer $server) {
            $grant = $this->makeGrant();
            $server->enableGrantType($grant, Passport::tokensExpireIn());
        });
        Passport::tokensExpireIn(Carbon::now()->addMonth());
        Passport::refreshTokensExpireIn(Carbon::now()->addYear());
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user, $ability) {
            return $user->hasRole(RolePermission::ROLE_SUPER_ADMIN) ? true : $user->hasPermissionTo($ability, 'web');
        });
    }

    private function makeGrant(): PhoneGrant
    {
        return new PhoneGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class),
        );
    }
}
