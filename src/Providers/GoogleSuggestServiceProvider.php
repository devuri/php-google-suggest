<?php

namespace euclid1990\PhpGoogleSuggest\Providers;

use Illuminate\Support\ServiceProvider;
use euclid1990\PhpGoogleSuggest\GoogleSuggest;

/**
 * @package \euclid1990\PhpGoogleSuggest
 */
class GoogleSuggestServiceProvider extends ServiceProvider {

    /**
     * Boot the service provider.
     *
     * @return null
     */
    public function boot()
    {
        // Publish configuration files
        $this->publishes([
            __DIR__ . '/../../config/google_suggest.php' => config_path('google_suggest.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__.'/../../config/google_suggest.php', 'google_suggest'
        );

        // Bind google_suggest
        $this->app->bind('google_suggest', function($app)
        {
            return new GoogleSuggest(
                $app['Illuminate\Config\Repository']
            );
        });
    }
}
