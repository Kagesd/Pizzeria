<?php

namespace App\Providers;

use App\Http\Middleware\IsAdmin;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

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
        RateLimiter::for('api', function(Request $request) {
            return Limit::perMinute(30)->by($request->user()?->id ?: $request->ip())->response(function(Request $request, array $headers) {
                return response()->json([
                    'message' => 'too many attemts'
                ], 429);
            });
        });

        $this->app['router']->aliasMiddleware('admin', IsAdmin::class);
    }
}
