<?php
namespace duncanrmorris\invoicemodule;

use Illuminate\Support\ServiceProvider;

class InvoicesServiceProvider extends ServiceProvider

{
    
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','invoicemodule');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/assets' => public_path('/invoicemodule'),
        ], 'public');
    }

    public function register()
    {
        
    }
}

