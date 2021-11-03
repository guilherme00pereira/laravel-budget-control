<?php

namespace App\Providers;

use App\View\Composers\NavigationComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('real', function ($value) {
            return "<?php echo number_format($value, 2, ',', '.'); ?>";
        });
        View::composer('navigation', NavigationComposer::class);
    }
}
