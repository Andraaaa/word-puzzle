<?php

namespace App\Providers;

use App\Models\Submission;
use App\Observers\SubmissionObserver;
use App\Repositories\Games\EloquentGames;
use App\Repositories\Games\GameInterface;
use App\Repositories\Submissions\EloquentSubmissions;
use App\Repositories\Submissions\SubmissionInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Users\UserInterface;
use App\Repositories\Users\EloquentUsers;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Submission::observe(SubmissionObserver::class);

        $this->app->bind(UserInterface::class, EloquentUsers::class);
        $this->app->bind(GameInterface::class, EloquentGames::class);
        $this->app->bind(SubmissionInterface::class, EloquentSubmissions::class);
    }
}
