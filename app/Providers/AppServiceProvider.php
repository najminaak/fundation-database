<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryImpl;
use App\Repository\UserData\UserDataRepository;
use App\Repository\UserData\UserDataRepositoryImpl;
use App\Repository\Event\EventRepository;
use App\Repository\Event\EventRepositoryImpl;
use App\Service\UserData\UserDataService;
use App\Service\UserData\UserDataServiceImpl;
use App\Service\Event\EventPhotoService;
use App\Service\Event\EventPhotoServiceImpl;
use App\Repository\Event\EventPhotoRepository;
use App\Repository\Event\EventPhotoRepositoryImpl;
use Laravel\Passport\Passport;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserDataRepositoryInterface::class, UserDataRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(UserDataRepositoryInterface::class,UserDataImpl::class);
        $this->app->bind(UserDataService::class,UserDataServiceImpl::class);    // Implementasi
        $this->app->bind(EventPhotoService::class, EventPhotoServiceImpl::class);
        $this->app->bind(EventPhotoRepository::class, EventPhotoRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        Passport::tokensCan([
            'entrepreneur' => 'entrepreneur',
            'organizer' => 'organizer',
            'admin' => 'admin',
        ]);
    }
}
