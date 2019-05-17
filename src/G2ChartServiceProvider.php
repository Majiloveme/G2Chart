<?php

namespace Encore\G2Chart;

use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;
class G2ChartServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(G2Chart $extension)
    {
        if (! G2Chart::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'G2chart');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/G2chart')],
                'G2chart'
            );
        }


        Admin::booting(function () {
            Admin::js('vendor/laravel-admin-ext/G2chart/data-set.min.js');
            Admin::js('vendor/laravel-admin-ext/G2chart/g2.min.js');
        });

    }
}