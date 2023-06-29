<?php

declare(strict_types=1);

namespace Buildit\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class BuilditServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::bind('buildit', function () {
            return new \Buildit\Routing\Buildit(app('router'));
        });
    }
}
