<?php namespace Sinclair\MagicViews;

use Illuminate\Support\ServiceProvider;

class MagicViewsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadItems();

        $this->setWhatPublishes();

        $this->bootViewComposers();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ ];
    }

    private function bootViewComposers()
    {
        view()->composer('magic-views::crud.index', 'Sinclair\MagicViews\ViewComposers\IndexViewComposer');

        view()->composer([
            'magic-views::crud.shared.form'
        ], 'Sinclair\MagicViews\ViewComposers\FormViewComposer');

        view()->composer('magic-views::crud.show', 'Sinclair\MagicViews\ViewComposers\ShowViewComposer');

        view()->composer('magic-views::includes.breadcrumbs', 'Sinclair\MagicViews\ViewComposers\BreadcrumbViewComposer');
        view()->composer('magic-views::crud.*', 'Sinclair\MagicViews\ViewComposers\LayoutViewComposer');
    }

    private function setWhatPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../views'                  => base_path('resources/views/vendor/magic-views'),
            __DIR__ . '/../../translations'           => base_path('resources/lang/vendor/magic-views'),
            __DIR__ . '/../../config/magic-views.php' => config_path('magic-views.php'),
        ]);
    }

    private function loadItems()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'magic-views');

        $this->loadTranslationsFrom(__DIR__ . '/../../translations', 'magic-views');
    }

}
